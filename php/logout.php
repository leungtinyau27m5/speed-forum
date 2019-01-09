<?php
	if(isset($_COOKIE['uid']) and isset($_COOKIE['username'])){
	session_start();
	session_unset();
	session_destroy();
	unset($_COOKIE['uid']);
	unset($_COOKIE['user']);
	setcookie("uid",null,-1,"/");
	setcookie("username",null,-1,"/");
	//echo "<script>window.history.back();</script>";
	echo "<script>alert('You have logged out');</script>";
	//sleep(2);
	header ("refresh:0.5;url=../index.php");
	//
	}
?>