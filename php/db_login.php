<?php
	$db_servername="localhost";
	$db_username="root";
	$db_password="";
	$db_database="speed_forum";
	$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_database);
	
	if($conn->connect_error){
		die("Connection failed: ".mysqli_connect_error());
		#echo "it is not work";
	}
	#echo "it is fine";

?>