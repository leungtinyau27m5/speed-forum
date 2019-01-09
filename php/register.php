<?php
	session_start();
	include 'db_login.php';
	
	$username= $_POST['reg_uname'];
	$password= $_POST['reg_upw'];
	$passwordc= $_POST['reg_upwc'];
	$email= $_POST['reg_email'];
	$sex= $_POST['reg_sex'];
	$datetime= date("Y-m-d");
	$_SESSION['usernameERR']="";
	$sql="SELECT * FROM userinfo WHERE username='$username'";
	$result= mysqli_query($conn, $sql);
	
	#echo "$datetime";
	
	
	if(!$row=mysqli_fetch_assoc($result)){
		$sql_insert="INSERT INTO userinfo (username, user_password, sex, email)
VALUES ('$username', '$password', '$sex', '$email')";
		$conn->query($sql_insert);
	/*	$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':sex', $sex);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':datetime', $datetime);
	*/	
	}else{
		$_SESSION['usernameERR']="$username is used";
		echo $_SESSION['usernameERR'];
	}
	echo "<script>window.history.back();</script>";
?>
