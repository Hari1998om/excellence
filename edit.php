<?php
	include 'connection.php';
	$data= stripcslashes(file_get_contents("php://input"));
	$mydata= json_decode($data, true);
	$id=$mydata['sid'];

	$editsql="SELECT * FROM form_crud where id={$id}";
	$result=mysqli_query($conn,$editsql);
	$row=mysqli_fetch_array($result);


	echo json_encode($row);

?>
				
			        	