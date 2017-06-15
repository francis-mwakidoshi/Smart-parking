<?php
session_start();
require 'mysqlConnect.php';
?>
<?php
if(isset($_POST['register'])){
  $name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
  $password_confirm=mysqli_real_escape_string($con,$_POST['password_confirm']);

	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		echo"<script>alert('your email is not valid!')</script>";
		exit();
	}

	if(strlen($password)<8){
		echo"<script>alert('please select a password of 8 letters minimum')</script>";
		exit();
	}

	$sel_email="select * from users where email='$email'";
	$run_email=mysqli_query($con,$sel_email);
	$check_email=mysqli_num_rows($run_email);

	if($check_email==1){
		echo"<script>alert('This email is already registered,try another one!')</script>";
		exit();
	}
	else{
		$_SESSION['email']=$email;
		$insert="INSERT INTO `users` (`id`, `name`, `email`, `password`,`password_confirm`) VALUES (NULL, '$name', '$email', '$password', '$password_confirm')";
		$run_insert=mysqli_query($con,$insert);
		if($run_insert){
			echo"<script>alert('registration successful,welcome!')</script>";
      echo"<script>window.open('home.php','_self')</script>";


		}
}
}
?>
