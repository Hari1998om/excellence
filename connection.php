
<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "test";

//Create Connection
$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);

//Check Connection
if ($conn) {
	//echo "Successfull connected ...";	
}
else
{
	echo "connection is not connected.." ;
}
?>
