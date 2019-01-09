<?php
	session_start();
	include 'sqlQuery.php';
	$loginCurrentUser = new loginUser();
	$loginCurrentUser->getUsername($_POST['username'], $_POST['password']);	
	//var_dump($loginCurrentUser->result);
	if($loginCurrentUser->result){
		if($loginCurrentUser->result['user_password']!=$_POST['password']){
			$_SESSION['msg']="Invalid Password!";
		}else{
			$cookie_valueUsername=$loginCurrentUser->result['username'];
			$cookie_valueUserId=$loginCurrentUser->result['uid'];
			setcookie("username", $cookie_valueUsername, time() + (86400*30),"/");
			setcookie("uid", $cookie_valueUserId, time() + (86400*30),"/");
			$_SESSION['user']=$loginCurrentUser->result['username'];
			$_SESSION['userId']=$loginCurrentUser->result['uid'];
			$_SESSION['msg']="0";
		}
	}else{
		$_SESSION['msg']="Invalid User Name!";
	}	
	echo "<script>window.history.back();</script>";
	//header ('Location: ..\index.php');
?>