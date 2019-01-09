<?php
	include 'php/sqlQuery.php';
	if(isset($_POST)){
		$post = new post();
		if($_POST['type']=="updateLike")
			$upDateReplies = $post->updateLike($_POST['postId'], $_POST['repliesId'], $_POST['userId']); 
		if($_POST['type']=="deleteLike")
			$upDateReplies = $post->deleteLike($_POST['postId'], $_POST['repliesId'], $_POST['userId']); 
		if($_POST['type']=="writeComment")
			$post->submitReplies($_POST['postId'], $_POST['userId'], $_POST['content'], 0);
		if($_POST['type']=="uploadPost")
			$post->uploadPost($_POST['uid'], $_POST['catId'], $_POST['title'], $_POST['content']);
	}/*
	$post = new post();
	$result = $post->uploadPost(1, 1, "LET ME HAVE A TEST", "IT IS TEST CONTENT");
	var_dump($result);
	*/
?>