<?php
	session_start();
	include '../php/sqlQuery.php';
	$authorized = false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1){
		$authorized = true;
	} 
	if($authorized){
		$admin = new admin();
		$userCol = $admin->showColumn("userinfo");
		$repliesCol = $admin->showColumn("replies");
		$commentsCol = $admin->showColumn("comments");
		$subjectCol = $admin->showColumn("subject");

		$subjectTable = $admin->logbookRequest("subject");
		$userTable = $admin->logbookRequest("userinfo");
		$commentTable = $admin->logbookRequest("comments");
		$repliesTable = $admin->logbookRequest("replies");
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="..\bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<link rel="stylesheet" href="..\css\commonCSS.css">
<link rel="stylesheet" href="..\css\animation.css">
<link rel="stylesheet" href="..\css\adminStyle.css">
<style>
body{
	background-color: #E0E0E0;
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
.tools i{
	margin-right:10px;
}
.tools i:hover{
	cursor: pointer;
	filter: blur(1px);
}
#addSubject:hover{
	cursor: pointer;
	filter: blur(1px);
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
	<a href='userEdit.php'>User</a>
	<a href='multiEdit.php'>Edit DashBoard</a>
	<a href='#'>Log Book</a>
</div>
<div id='main'>
	<nav class="navbar navbar-expand-lg">
		<span id='openNav' style='cursor:pointer;color:white;margin-right:20px;' click="openNav()">&#9776;</span>
		<a class="navbar-brand" href="">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="../index.php">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../subjectview.php">Subject Review</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../speedForum.php">Forum</a>
				</li>
				<?php
					if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1)
						echo "<li class='nav-item'><a class='nav-link btn btn-warning'  href='admin.php'>Admin DashBoard</a></li>";
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
	<div class='row' style="padding: 35px;">
		<div class="col-lg-6" style='max-height: 500px;'>
			<div class="card">
				<div class="card-header">
					User Table
				</div>
				<div class="card-body" style="overflow-x: scroll; max-height: 450px;">
					<?php
						echo "<table class='table table-hover table-striped table-dark'>";
							echo "<thead>";
								echo "<tr>";
									echo "<th>#Tools</th>";
									echo "<th>Target_table</th>";
									echo "<th>Action</th>";
								for($i=0; $i<sizeof($userCol); $i++){
									echo "<th>".$userCol[$i]['Field']."</th>";
								}
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
								for($i=0; $i<sizeof($userTable); $i++){
									echo "<tr>";
									echo "<td class='tools'><i style='color: lightgreen' class='fas fa-redo'></i></td>";
									foreach($userTable[$i] as $value){
										echo "<td class='targetData'>".$value."</td>";
									}
									echo "</tr>";
								}
							echo "</tbody>";
						echo "</table>";
					?>
				</div>
			</div>	
		</div>	
		<div class="col-lg-6" style='max-height: 500px;'>
			<div class="card">
				<div class="card-header">
					Comments Table
				</div>
				<div class="card-body" style="overflow-x: scroll; max-height: 450px;">
					<?php
						echo "<table class='table table-hover table-striped table-dark'>";
							echo "<thead>";
								echo "<tr>";
									echo "<th>#Tools</th>";
									echo "<th>Target_table</th>";
									echo "<th>Action</th>";
								for($i=0; $i<sizeof($commentsCol); $i++){
									echo "<th>".$commentsCol[$i]['Field']."</th>";
								}
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
								for($i=0; $i<sizeof($commentTable); $i++){
									echo "<tr>";
									echo "<td class='tools'><i style='color: lightgreen' class='fas fa-redo'></i></td>";
									foreach($commentTable[$i] as $value){
										$txt = wordwrap($value, 24, "</br>", true);
										echo "<td class='targetData'>".$txt."</td>";
									}
									echo "</tr>";
								}
							echo "</tbody>";
						echo "</table>";
					?>					
				</div>
			</div>	
		</div>	
	</div>	
	<div class='row' style="padding: 35px;">
		<div class="col-lg-6" style='max-height: 500px;'>
			<div class="card">
				<div class="card-header">
					Replies
				</div>
				<div class="card-body" style="overflow-x: scroll; max-height: 450px;">
					<?php
						echo "<table class='table table-hover table-striped table-dark'>";
							echo "<thead>";
								echo "<tr>";
									echo "<th>#Tools</th>";
									echo "<th>Target_table</th>";
									echo "<th>Action</th>";
								for($i=0; $i<sizeof($repliesCol); $i++){
									echo "<th>".$repliesCol[$i]['Field']."</th>";
								}
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
								for($i=0; $i<sizeof($repliesTable); $i++){
									echo "<tr>";
									echo "<td class='tools'><i style='color: lightgreen' class='fas fa-redo'></i></td>";
									foreach($repliesTable[$i] as $value){
										$txt = wordwrap($value, 24, "</br>", true);
										echo "<td class='targetData'>".$txt."</td>";
									}
									echo "</tr>";
								}
							echo "</tbody>";
						echo "</table>";
					?>
				</div>
			</div>	
		</div>	
		<div class="col-lg-6" style='max-height: 500px;'>
			<div class="card">
				<div class="card-header">
					Subject
				</div>
				<div class="card-body" style="overflow-x: scroll; max-height: 450px;">
					<?php
						echo "<table class='table table-hover table-striped table-dark'>";
							echo "<thead>";
								echo "<tr>";
									echo "<th>#Tools</th>";
									echo "<th>Target_table</th>";
									echo "<th>Action</th>";
								for($i=0; $i<sizeof($subjectCol); $i++){
									echo "<th>".$subjectCol[$i]['Field']."</th>";
								}
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
								for($i=0; $i<sizeof($subjectTable); $i++){
									echo "<tr>";
									echo "<td class='tools'><i style='color: lightgreen' class='fas fa-redo'></i></td>";
									foreach($subjectTable[$i] as $value){
										$txt = wordwrap($value, 24, "</br>", true);
										echo "<td class='targetData'>".$txt."</td>";
									}
									echo "</tr>";
								}
							echo "</tbody>";
						echo "</table>";
					?>
				</div>
			</div>	
		</div>	
	</div>		
</div>
<script>
$('body').on('click', '.fa-redo', function(){

			var targetRow = $(this).closest("tr");
			var allTD = targetRow.find(".targetData");
			var updatedData = "";
				allTD.each( function(){
					var value = $(this).html();
					var txt = value+",";
					updatedData += txt;
				});
			targetRow.fadeOut("slow", function(){
			});	
			$.post("adminUpdate.php",{
				destination: "logbook",
				type: "recovery",
				data: updatedData
			},function(result){ 
				alert(result);
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