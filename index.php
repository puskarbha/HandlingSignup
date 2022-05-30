
<?php
//scrip to conect to the database
$servername ="localhost";
$username ="root";
$password ="";
$database ="timepass_db";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn) {
    echo"Connection error.";
    die("Connection failed: " . mysqli_connect_error());
    
  }
?>


<!-- Script to insert database on post request-->
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $email=$_POST['f_email'];
   $name=$_POST['f_name'];
   $password=$_POST['f_pass'];
  $cpassword=$_POST['f_cpass'];
  //Firstly check whether two passwords matches
  if($password==$cpassword)
  {
            //converting password into hash form
        $hashed_pass = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_email`, `user_name`, `user_password`, `timestamp`) VALUES ( '$email', '$name', '$hashed_pass', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if($result){
          echo"<h1>Signup successfully.</h1>";
       
        exit();
        }
}
else{
  echo"<h1>password doesnot match</h1>";
  exit();
}
  }
   
?>
<form   method="post">
    <b><u>Please sighup to continue:</u></br></br>
        <b>Email address:</b>
        <input id="f_email" name="f_email" type="email"></br></br>
        <b>Full name:</b>
        <input id="f_name" name="f_name"></br></br>
        <b>Password:</b>
        <input id="f_pass" name="f_pass" type="password" ></br></br>
        <b>Confirm Password:</b>
        <input id="f_cpass" name="f_cpass" type="password"></br></br>
        <button>signup</button>
</form>