<?php
session_start();
include 'connection.php';
	$data= stripcslashes(file_get_contents("php://input"));
	$mydata= json_decode($data, true);
	$id=$mydata['id'];
	$name=$mydata['name'];
	$email=$mydata['email'];
	$designation=$mydata['designation'];
	$salary=$mydata['salary'];
	$date=$mydata['date'];
	$captcha=$mydata['captcha'];

	if (!empty($name) && !empty($email) && !empty($designation) && !empty($salary) && !empty($date)) {
		if ($_SESSION['CODE']==$captcha) {
			$inserData="INSERT INTO form_crud (id,name,email,designation,salary,date)VALUES('$id','$name','$email','$designation','$salary','$date') ON DUPLICATE KEY UPDATE name='$name',email='$email',designation='$designation',salary='$salary',date='$date'";
		if (mysqli_query($conn,$inserData)==TRUE) {
			echo "Record saved successfully";
		}else{
			echo "Unable to save Record";
		}
	}else{
			echo "Please Enter valid captcha";
		}
		
		
		
	}else{
		echo "Fill All Fields";
	}
	 


?>