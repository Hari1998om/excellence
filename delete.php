<?php
    include 'connection.php';
	$data= stripcslashes(file_get_contents("php://input"));
	$mydata= json_decode($data, true);
	$id=$mydata['sid'];

	if (!empty($id)) {
		$delquery="DELETE from form_crud where id={$id} ";
		if (mysqli_query($conn,$delquery)==TRUE) {
			echo "Record Deleted Successfully";
		}else{
			echo "Unable to Deleted Record";
		}
	}
?>