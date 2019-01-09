<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";

try{
	$conn = new PDO ("mysql:host=$servername;dbname=speed_forum", $db_username, $db_password);
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}
?>