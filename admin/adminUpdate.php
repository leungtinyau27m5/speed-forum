<?php
	session_start();
	include '../php/sqlQuery.php';
	$admin = new admin();
	if(!isset($_POST['addCourse']))
		$tempArray = explode("," ,$_POST['data']);
	if(isset($_POST) && isset($_COOKIE['uid']) && $_COOKIE['uid']=='1'){
		if(isset($_POST['destination']) && $_POST['destination']=="userinfo"){
			switch($_POST['type']){
				case "update": $admin->adminAction($_POST['destination'], $tempArray); break;
				case "delete": $admin->userDelete($_POST['destination'], $tempArray); break;
			}
		}elseif(isset($_POST['destination']) && $_POST['destination']=="subject"){
			switch($_POST['type']){
				case "update": $admin->subjectUpdate($_POST['destination'], $tempArray); break;
				case "delete": $admin->subjectDelete($_POST['destination'], $tempArray); break;
			}
		}elseif(isset($_POST['destination']) && $_POST['destination']=="replies"){
			switch($_POST['type']){
				case "update":  $admin->repliesUpdate($_POST['destination'], $tempArray); break;
				case "delete": $admin->repliesDelete($_POST['destination'], $tempArray); break;
			}
		}elseif(isset($_POST['destination']) && $_POST['destination']=="comments"){
			switch($_POST['type']){
				case "update": $admin->commentsUpdate($_POST['destination'], $tempArray); break;
				case "delete": $admin->commentsDelete($_POST['destination'], $tempArray); break;
			}
		}elseif(isset($_POST['addCourse'])){
			$subjectArray=array();
			$subjectArray['scode'] = $_POST['subject_code'];
			$subjectArray['sname'] = $_POST['subject_name'];
			$subjectArray['scategories'] = $_POST['subject_categories'];
			$subjectArray['ssubject'] = $_POST['subject_subgroup'];
			$subjectArray['slevel'] = $_POST['subject_level'];
			$subjectArray['slanguage'] = $_POST['subject_language'];

			$admin->addNewCourse($subjectArray);
			header("location:multiEdit.php");
		}elseif(isset($_POST['destination']) && $_POST['destination']=="logbook"){
			for($i=0; $i<sizeof($tempArray); $i++){
				if($tempArray[$i]==" ")
					unset($tempArray[$i]);
			}
			$admin->recovery($tempArray);
		}
	}
?>