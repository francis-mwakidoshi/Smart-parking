<?php
require 'mysqlConnect.php';
?>
<?php
if(isset($_POST['sub'])){
	$location=mysqli_real_escape_string($con,$_POST['location']);
	$street = mysqli_real_escape_string($con,$_POST['street']);
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$slot=mysqli_real_escape_string($con,$_POST['slot']);

	   if($location==''&& $street==''&& $name=='' && $slot==''){
		echo"<script>alert('please fill all field')</script>";
		echo"<script>window.open('blank.php','_self')</script>";
		exit();
	 }

	else{

		$insert="INSERT INTO `parkings` (`id`, `location`, `street`, `name`, `slot`) VALUES (NULL, '$location', '$street', '$name', '$slot');";
		$run_insert=mysqli_query($con,$insert);
		if($run_insert){
			echo"<script>alert('Successful added!')</script>";
			echo"<script>window.open('blank.php','_self')</script>";

		}
		else{
			echo"<script>alert('Error please try again')</script>";
			echo"<script>window.open('blank.php','_self')</script>";
		}
}}

?>
