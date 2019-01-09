<?php
	session_start();
	include 'php/sqlQuery.php';
	if(isset($_POST)){
		$post = new post();
		$categoriesOOn=false;
		$orderOn=false;
		$requestData = $_POST['data'];
		if($requestData['categories']!="") $categoriesOOn=true;
		if($requestData['order']!="") $orderOn=true;
		if($orderOn){
			if($requestData['order']=="mostLike")
				$orderItem="like";
			else if($requestData['order']=="mostPopular")
				$orderItem="post_numberOfvisits";
			else if($requestData['order']=="mostRecent")
				$orderItem="post_datetime";
		}else
			$orderItem="post_datetime";		
		$responData = $post->listPostBaseOnRequest($categoriesOOn, $requestData['categories'], $orderItem);
		$sortedData = array();
		//$sortedData[0] = $responData[0];
	}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body{

}
.postCard{
	cursor:pointer;
}
.postCard:hover{
	opacity: 0.85;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.modal-dialog{
	z-index:999;
}
.modal-header{
	z-index: 999;
}
.navbar{
	z-index:99;
}
.vbottom{
}
.container .postCard{
	margin-top: 5px;
}
</style>
</head>
<body>
<div class="container" >
	<?php
		for($i=0; $i<sizeof($responData); $i++){
			$destination="post".$responData[$i]['pid'];
			echo "<div class='card postCard' id=\"$destination\" data-toggle='modal' data-target='.bd-example-modal-lg'>";
				echo "<div class='card-body'>";
					$sexIndex = $responData[$i]['sex'];
					if($sexIndex=="M") $userNameStyle = "text-primary";
					else if($sexIndex=="F") $userNameStyle = "text-danger";
					else $userNameStyle = "text-secondary";
					echo "<h6 class='card-title mb-2 $userNameStyle'>".$responData[$i]['username']."<small class='text-muted text-light'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$responData[$i]['post_datetime']."</small></h6>";
					echo "<h5 class='card-title post-title'>".$responData[$i]['post_title']."</h5>";
					echo "<p class='card-text'>";
						echo $responData[$i]['content'];
					echo "</p>";
					echo "<div class='row vbottom' style='margin-top:15px;'>";
						echo "<small title='likes' style='padding:0 5px 0 5px;'
						class='text-center'><a data-toggle='tooltip' data-placement='top' title='like' href='#' class='card-link'><i style='margin-right:10px;' class='em em-hearts'></i>".$responData[$i]['like']."</a></small>";
						echo "<small  title='visits' style='padding:0 5px 0 5px;'
						class='text-center'><a data-toggle='tooltip' data-placement='top' title='visits' href='#' class='card-link'><i style='margin-right:10px;' class='em em-1234'></i>".$responData[$i]['post_numberOfvisits']."</a></small>";
						echo "<small title='replies' style='padding:0 5px 0 5px;'
						class='text-center'><a data-toggle='tooltip' data-placement='top' title='replies' href='#' class='card-link'><i style='margin-right:10px;' class='em em-abcd'></i>".$responData[$i]['repliesNumber']."</a></small>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	?>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="viewPost"> 
      </div>  
    </div>
  </div>
</div>
</body>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});	
$(document).ready(function(){
	$(".postCard").each(function(){
		$(this).on("click", function(){
			var value = $(this).attr('id');
			value = value.substring(4,value.length);
			var postName = $(this).find(".post-title").text();
			$("#exampleModalLongTitle").text(postName);
				$.post("postView.php",
				{
					postId: value
				},function(result){
					$("#viewPost").html(result);
				});
		});
	});
    (function($){
        $(window).on("load",function(){
            $(".content").mCustomScrollbar();
        });
    })(jQuery);	
});
</script>
</html>