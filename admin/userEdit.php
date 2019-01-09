<?php
	session_start();
	include '../php/sqlQuery.php';
	$authorized = false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1){
		$authorized = true;
	} 
	if($authorized){
		$admin = new admin();
		$userList = $admin->userList();
	}
	if(isset($_GET['userid'])){

	}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="..\bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<link rel="stylesheet" href="..\css\commonCSS.css">
<link rel="stylesheet" href="..\css\animation.css">
<link rel="stylesheet" href="..\css\adminStyle.css">
<style>
body{
	background-color: #EFEFEF;
}
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 16px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
i{
	margin-right: 10px;
}
i:hover{
	cursor: pointer;
	opacity: 0.7;
	filter: blur(1px);
}
a:link{
	text-decoration: none;
	color: white;
}
a:visited{
	text-decoration: none;
	color: white;
}
a:hover{

}
td:hover{
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	cursor: pointer;
}

</style>	
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div id='mySidenav' class='sidenav'>
	<a id='closeNav' href="javascript:void(0)" class="closebtn" onclick="closeNav();">&times;</a>
	<a href='../admin.php'>Home DashBoard</a>
	<a href='userEdit.php'>User</a>
	<a href='multiEdit.php'>Edit DashBoard</a>
</div>
<div id='main'>
<nav class="navbar navbar-expand-lg">
	<span id='openNav' style='cursor:pointer;color:white;margin-right:20px;' click="openNav()">&#9776;</span>
	<a class="navbar-brand" href="../index.php">Navbar</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../subjectview.php">Subject Review</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../speedForum.php">Forum</a>
					</li>
					<?php
						if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1)
							echo "<li class='nav-item'><a class='nav-link btn btn-warning' href='admin.php'>Admin DashBoard</a></li>";
					?>					
				</ul>
		<div class="col-sm-1" style="margin-right: 20px;">
			<?php
				if(isset($_COOKIE['uid'])){
					echo "<form action='php/logout.php' method='POST'>";
					echo "<button type='submit' class='btn btn-danger' data-toggle='modal' data-target='logoutModal'><i class='material-icons login-icon'>all_out</i><h6 class='d-inline-block'>LogOut</h6>";
						echo "</form>";
				}
			?>
		</div>		
	</div>		
</nav>
<div style='padding:100px;'>
	<div class='table-responsive' style='max-height: 750px'>
		<?php
			echo "<table class='table table-striped table-dark'>";
				echo "<tr>";
					echo "<td scope='col'>#Tools</td>";
					echo "<th scope='col'>#</th>";
				foreach($userList[0] as $key=>$value){
					echo "<th scopr='col'>". $key ."</th>";
				}
				echo "</tr>";
			for($i=0; $i<sizeof($userList); $i++){
				$idname = "uid".$userList[$i]['uid'];
				echo "<tr id=\"$idname\">";
				echo "<td class='tools'><i class='fas fa-pencil-alt editRow'></i><i class='fas fa-minus deleteRow'></i></td>";
				echo "<td>". ($i+1) . "</td>";
				foreach($userList[$i] as $key=>$value){
					$uid = $userList[$i]['uid'];
					if($key=='uid') echo "<td class='targetData unchanged'>". $value ."</td>";
					else echo "<td class='targetData' ><a href=userEdit.php?userid=$uid>". $value ."</a></td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		?>
	</div>	
	<div class='row' style='margin-bottom: 1%;'>
				<div id="footprint" class='col-lg-12' style='height: 600px;background-color: white;padding: 25px;'>
			<div class='text-center'>
				<h5>
					<?php
						if(isset($_GET['userid'])){
							for($i=0; $i<sizeof($userList); $i++){
								if($_GET['userid']==$userList[$i]['uid'])
								echo $userList[$i]['username']."'s ";
							}
						}
					?>
					Footprint
					<?php
						if(isset($_GET['footprint'])){
							echo "<small classs='text-muted'>".$_GET['footprint']."</small>";
						}
					?>
				</h5>
				<div class="row col-lg-3" style='padding: 5px 5px 5px 25px;'>
					<?php
					if(isset($_GET['userid'])){
						echo "<select id='footprintFilter' class='form-control'>";
							echo "<option></option>";
							echo "<option value='comment'>Comment</option>";
							echo "<option value='replies'>Replies</option>";
							echo "<option value='like'>Like</option>";
							echo "<option value='post'>Post</option>";
							echo "</select>";
					}else{
						echo "<h6>Select A USER First</h6>";
					}
					?>
				</div>
				<div class='col-lg-10 table-responsive' style='margin:auto;height: 400px;'>
					<?php
						if(isset($_GET['userid'])){
							if(isset($_GET['footprint'])){
								$string = $_GET['footprint'];
								switch($string){
									case "comment": comment(); break;
									case "replies": replies(); break;
									case "like": like(); break;
									case "post": post(); break;
								}
							}
						}
						function comment(){
							$admin = new admin();
							$postComment = $admin->footprintComment($_GET['userid']);
							echo "<table class='table table-striped table-hover'>";
								echo "<thead>";
								echo "<tr>";
									echo "<td scope='col'>Subject Code</td>";
									echo "<td scope='col'>Subject Name</td>";
									echo "<td scope='col'>Subject categories</td>";
									echo "<td scope='col'>Content</td>";
									echo "<td scope='col'>Date</td>";
								echo "</tr>";
								echo "</thead>";
								for($i=0; $i<sizeof($postComment); $i++){
									echo "<tr>";
									echo "<td>". $postComment[$i]['subject_code'] ."</td>";
									echo "<td>". $postComment[$i]['subject_name'] ."</td>";
									echo "<td>". $postComment[$i]['subject_categories'] ."</td>";
									echo "<td>". $postComment[$i]['comments_content'] ."</td>";
									echo "<td>". $postComment[$i]['comment_datetime'] ."</td>";
									echo "</tr>";
								}
							echo "</table>";
						}
						function replies(){
							$admin = new admin();
							$replies = $admin->footprintReplies($_GET['userid']);
							echo "<table class='table table-striped table-hover'>";
								echo "<thead>";
								echo "<tr>";
									echo "<td scope='col'>post</td>";
									echo "<td scope='col'>replies content</td>";
									echo "<td scope='col'>date</td>";
								echo "</tr>";
								echo "</thead>";
								for($i=0; $i<sizeof($replies); $i++){
									echo "<tr>";
									echo "<td>". $replies[$i]['post_title'] ."</td>";
									echo "<td>". $replies[$i]['content'] ."</td>";
									echo "<td>". $replies[$i]['replies_datetime'] ."</td>";
									echo "</tr>";
								}
							echo "</table>";
						}
						function like(){
							$admin = new admin();
							$likes = $admin->footprintLike($_GET['userid']);
							echo "<table class='table table-striped table-hover'>";
								echo "<thead>";
								echo "<tr>";
									echo "<td scope='col'>post</td>";
									echo "<td scope='col'>replies content</td>";
								echo "</tr>";
								echo "</thead>";
							for($i=0; $i<sizeof($likes); $i++){
								echo "<tr>";
									echo "<td>". $likes[$i]['post_title'] ."</td>";
									echo "<td>". $likes[$i]['content'] ."</td>";
									echo "</tr>";
								}
							echo "</table>";
						}
						function post(){
							$admin = new admin();
							$posts = $admin->footpinrtPost($_GET['userid']);
							echo "<table class='table table-striped table-hover'>";
								echo "<thead>";
								echo "<tr>";
									echo "<td scope='col'>post</td>";
									echo "<td scope='col'>visits number</td>";
									echo "<td scope='col'>Posted time</td>";
								echo "</tr>";
								echo "</thead>";
								for($i=0; $i<sizeof($posts); $i++){
									echo "<tr>";
									echo "<td>". $posts[$i]['post_title'] ."</td>";
									echo "<td>". $posts[$i]['post_numberOfvisits'] ."</td>";
									echo "<td>". $posts[$i]['post_datetime'] ."</td>";
									echo "</tr>";
								}
							echo "</table>";
						}
					?>
				</div>
			</div>
		</div>	
	</div>
</div>
</div>
<script>
var rowValue = "";
$("body").on("change", "#footprintFilter", function(){
	var tempValue = $(this).val();
	var pathname = window.location.href; 
	var searchResult = pathname.search("&footprint=");
	if(searchResult!=-1){
		pathname = pathname.substring(0, searchResult);
		pathname += "&footprint=" + tempValue;
		window.location.href = pathname;
	}else{
		pathname += "&footprint="+tempValue;
		window.location.href = pathname;
	}
});
$('body').on('click', '.editRow', function(){
	$(".editRow").each(function(){
		$(this).on("click", function(){
			var targetRow = $(this).closest("tr");
			var makeButton = "<i class='far fa-save saveUpdate'></i><i class='fas fa-ban cancelUpdate'></i>";
			var allTD = targetRow.find(".targetData");

			targetRow.find(".tools").html(makeButton);

			allTD.each(function(){
				var value = $(this).text();
				rowValue += value + ",";
				if($(this).hasClass("unchanged")){
					var temp = "<input disabled class='form-control targetData' type='text' value='" + value + "'>";
					$(this).html(temp);
				}else{
					var temp = "<input class='form-control targetData' type='text' value='" + value + "'>";
					$(this).html(temp);
				}
			});
		});
	});
});
$('body').on('click', '.cancelUpdate', function(){
	$(".cancelUpdate").each(function(){
		location.reload();
	});
});
$('body').on('click', '.deleteRow', function(){
	$(".deleteRow").each(function(){
		$(this).on("click", function(){
			var targetRow = $(this).closest("tr");
			var allTD = targetRow.find(".targetData");
			var updatedData = "";
			allTD.each( function(){
				var value = $(this).text();
				var txt = value+",";
				updatedData +=  txt;
			});
			$.post("adminUpdate.php",{
				destination: "userinfo",
				type: "delete",
				data: updatedData
			},function(result){ 
				//alert(result);
			});
			targetRow.fadeOut("slow", function(){
			});
		});
	});
});
$('body').on('click', '.saveUpdate', function(){
	$(".saveUpdate").each(function(){
		var targetRow = $(this).closest("tr");
		var makeButton = "<i class='fas fa-pencil-alt editRow'></i><i class='fas fa-minus deleteRow'></i>";
		var allTD = targetRow.find(".targetData");
		targetRow.find(".tools").html(makeButton);
		var updatedData = "";
		allTD.each( function(){
			var value = $(this).find(".targetData").val();
			var txt = value+",";
			updatedData += txt;
			$(this).html(value);
		});
		$.post("adminUpdate.php",{
			destination: "userinfo",
			type: "update",
			data: updatedData
		},function(result){ 
			
		});
	});
});

$("#openNav").on("click", function(){
	$("#mySidenav").css("width", "200px");
	$("#main").css("margin-left", "200px");
	$("body").css("background-color", "rgba(0,0,0,0.4)");
});
$("#closeNav").on("click", function(){
	$("#mySidenav").css("width", "0");
	$("#main").css("margin-left", "0");
	$("body").css("background-color", "#EFEFEF");
});
$("body").on("click", function(){
	if($("#mySidenav").width()=="200"){
		$("#mySidenav").css("width", "0");
		$("#main").css("margin-left", "0");
		$("body").css("background-color", "#EFEFEF");		
	}
});
</script>
</body>
</html>
