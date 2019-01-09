<?php 
	session_start();
	include 'php/sqlQuery.php';
?>
<!DOCTYPE html>
<html>
<head>
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<meta charset="UTF-8">
<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/path/to/jquery.mCustomScrollbar.css" />
<link rel="stylesheet" href="css\commonCSS.css">
<link rel="stylesheet" href="emoji/css/emojionearea.min.css">
<style>
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
.media:hover{
	opacity: 0.85;
	box-shadow: 0 0px 0px 0 rgba(0,0,0,0.2), 0 0px 20px 0 rgba(0,0,0,0.19);
}
.media{
	min-height:15vh;
	padding:25px;
}
.modal-body{
	overflow-y :scroll;
	height: 75vh;
}
</style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="emoji/js/emojionearea.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/jquery.scrollto@2.1.2/jquery.scrollTo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
	if(isset($_POST)){
		$data = $_POST;
		$post = new post();
		$repliesListing = $post->listReplies($data['postId']);
		$post->updateVisit($data['postId']);
	}
?>
<?php
	echo "<div class='modal-body' id='modalName'>";
		echo "<div id='cardTop'></div>";
		for($i=0; $i<sizeof($repliesListing); $i++){ 
			echo "<hr><div class='media'>";
				if($repliesListing[$i]['sex']=="M"){
					echo "<i class='mr-3 em em-boy'></i>";
					$userNameStyle = "text-primary";
				}else if($repliesListing[$i]['sex']=="F"){
					echo "<i class='mr-3 em em-girl'></i>";
					$userNameStyle = "text-danger";
				}else{
					echo "<i class='mr-3 em em-sleuth_or_spy'></i>";
					$userNameStyle = "text-secondary";
				}
				echo "<div class='media-body'>";
				echo "<h5 class='mt-0 $userNameStyle'>".$repliesListing[$i]['username']."<small class='text-muted text-light'><i>  Posted on: ".$repliesListing[$i]['replies_datetime']."</i></small></h5>";

				echo $repliesListing[$i]['content'];
				if($i!=0){
					$ridCheck = $post->checkLiked($data['postId'], $repliesListing[$i]['rid'], $_COOKIE['uid']);
					$temp = $repliesListing[$i]['rid'];
					$ridCountLike = $post->getLikeCouting($data['postId'], $repliesListing[$i]['rid']); 
					echo "<div style='float:right' class='text-right'><div class='row'>";
					if(!empty($ridCountLike))
					echo "<h6 style='margin-right:10px;margin-top:10px;' class='align-bottom'>".$ridCountLike[0]["count(likeId)"]."</h6>";
					else
					echo "<h6 style='margin-right:10px;margin-top:10px;' class='align-bottom'>0</h6>";						
					if($ridCheck)
						echo "<button type='button' value=\"$temp\" class='btn btn-warning addlike' data-toggle='tooltip' data-placement='top' title='give a like'><i class='em em-heart'></i></button>";
					else 
						echo "<button type='button' value=\"$temp\" class='btn btn-outline-warning addlike' data-toggle='tooltip' data-placement='top' title='give a like'><i class='em em-heart'></i></button>";
					echo "</div></div>";
				}
					echo "</div>";
			echo "</div><hr>";
		}
	echo "</div>";
?>
<div class="modal-footer">
	<button id="writeReply" type="button" class="btn btn-outline-success" data-toggle='tooltip' data-placement='top' title='give a reply'><i class='em em-writing_hand'></i></button>
	<?php
	$likeCheck = $post->checkLiked($data['postId'], 1, $_COOKIE['uid']);  
		if($likeCheck)
			echo "<button type='button' class='btn btn-warning addlike' data-toggle='tooltip' data-placement='top' value='1' title='give a like'><i class='em em-heart'></i></button>";
		else 
			echo "<button type='button' class='btn btn-outline-warning addlike' data-toggle='tooltip' data-placement='top' value='1' title='give a like'><i class='em em-heart'></i></button>";
	?> 
</div>
<script>
var switchForm=false;
var postId = <?php echo $data['postId']; ?>;
var userId = readCookie('uid');
var commentDisplay=false;
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
$('body').on('load', '[data-toggle="tooltip"]', function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});

$('body').on('mouseover', '.writingComment', function(){
	$(".writingComment").emojioneArea();
});

$("#writeReply").on("click",function(){
	if(commentDisplay==false){
		$("#modalName").append("<div class='form-group'><label for='yourComment'>Your Comment</label><textarea class='form-control writingComment' id='writingComment' rows='5'></textarea></div><div class='form-group'><button id='postReplies' style='float:right;margin-top:20px;' type='submit' class='btn btn-outline-success'>Submit</button><button id='backToTop' type='button' style='float:right;margin-top:20px;margin-right: 20px;' class='btn btn-outline-secondary'>TOP</button></div>");
		commentDisplay=true;
		$("#modalName").animate({
			scrollTop: $("#writingComment").offset().top
		},1000);
	}else{
		$("#modalName").animate({
			scrollTop: $("#writingComment").offset().top
		},1000);
	}
});


$('body').on('click', '#backToTop', function(){
	$("#modalName").animate({
		scrollTop: $("#cardTop").offset().top
	},1000);	
});

$('body').on('click', '#postReplies', function(){
	var textContent = $("#writingComment").val();
	if(textContent.length>1){
		$.post("submitReplies.php",{
			postId: postId,
			userId: userId,
			content: textContent,
			type: "writeComment"
		},function(){ 
			location.reload();
		});
	}else{
		alert("please input your words!");
	}
});


$(".addlike").each(function(){
	$(this).on("click", function(){
		var likeOnOff = $(this).attr("class");
		var replyId = $(this).attr("value");
		likeOnOff = likeOnOff.search("btn-warning");
		if(likeOnOff!=-1){
			$(this).attr("class", "btn btn-outline-warning addlike");
			$(this).attr("title", "give a like");
			$.post("submitReplies.php",{
				postId: postId,
				repliesId: replyId,
				userId: userId,
				type: "deleteLike"
			},function(result){
			});
		}else{
			$(this).attr("title", "liked");
			$(this).attr("class", "btn btn-warning addlike");
			$.post("submitReplies.php",{
				postId: postId,
				repliesId: replyId,
				userId: userId,
				type: "updateLike"
			},function(result){
			});
		}
	});
});

</script>
</body>
</html>	