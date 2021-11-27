<?php 
include 'connection.php';

$retrievedata="SELECT * FROM form_crud";
$result=mysqli_query($conn,$retrievedata);
if (mysqli_num_rows($result)>0) {
	$data=array();
	while ($row=mysqli_fetch_array($result)) {
		$data[] =$row;
	}
}
 	echo json_encode($data);
?>