<?php
	session_start();
	if(isset($_POST['commtSubmit'])){
		include 'db_login.php';
		include 'sqlQuery.php';
		/*
		$commtsem = $_POST['commtSem'];
		$commtTutor = $_POST['Tutor'];
		$commtGrade = $_POST['commtGrade'];
		$commtWorkload = $_POST['commtWorkload'];
		$commtGP = $_POST['commtGP'];
		$commtAssign = $_POST['commtAssign'];
		$commtTest = $_POST['commtTest'];
		$commtExam = $_POST['commtExam'];
		$commtContent = $_POST['commtContent'];
		$identity = $_POST['identity'];
		$commtsid = $_POST['subjectId'];
		*/
		$commentContent = array(
			'commtSem'=>$_POST['commtSem'],
			'commtTutor'=>$_POST['commtTutor'],
			'commtGrade'=>$_POST['commtGrade'],
			'commtWorkload'=>$_POST['commtWorkload'],
			'commtGP'=>$_POST['commtGP'],
			'commtAssign'=>$_POST['commtAssign'],
			'commtTest'=>$_POST['commtTest'],
			'commtExam'=>$_POST['commtExam'],
			'commtContent'=>$_POST['commtContent'],
			'identity'=>$_POST['identity'],
			'commtSid'=>$_POST['subjectId']
		);
		//var_dump($commentContent);
		$writeStatement = new SQLQuery();
		$writeStatement->writeCommentToTable($commentContent);
		echo "<script>alert('Comment Update Succeed!');</script>";
		//sleep(2);
		echo "<script>window.history.back();</script>";
	}
	
?>