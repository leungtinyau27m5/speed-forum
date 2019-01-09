<?php
	session_start();
	include '../php/sqlQuery.php';
	$authorized = false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1){
		$authorized = true;
	} 
	if($authorized){
		$admin = new admin();
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

<?php
	if(isset($_SESSION['msg'])&&$_SESSION['msg']!="0"){
		callWarningMsg($_SESSION['msg']);
	}
	if(isset($_SESSION['msg']) && $_SESSION['msg']=="0"){
		callWelcomeMsg();
	}
	function callWarningMsg($msg){
	echo "<div class='modal fade' id='loginAlert' tabindex='-1' role='dialog' aria-labelledby='loginAlertTitle' aria-hidden='true'>";
		echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
			echo "<div class='modal-content'>";
				echo "<div class='modal-header alert-danger'>";
				echo "<h5>";
				echo $msg;
				echo "</h5>";
				echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	unset($_SESSION['msg']);
	}
	function callWelcomeMsg(){
	echo "<div class='modal fade' id='loginAlert' tabindex='-1' role='dialog' aria-labelledby='loginAlertTitle' aria-hidden='true'>";
		echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
			echo "<div class='modal-content'>";
				echo "<div class='modal-header alert-success'>";
				echo "<h5>Succeed</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	unset($_SESSION['msg']);
	}	
?>
<script>
	$(document).ready(function(){
		$("#loginAlert").modal("show");
		setTimeout(function() {
		$('#loginAlert').modal('hide');
		}, 2400);
	});
</script>

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
	<div class="row" style="padding:35px;">
		<div class="card col-lg-6">
			<div class="card-header">
				Replies
			</div>
			<div class="card-body">
				<div id="replies_form">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="content">Content Search</label>
							<input type="text" class="form-control replies" id="content">
						</div>
					</div>
				</div>
				<div class="table-responsive" style="height: 450px;">
					<?php
						if($authorized){
							$requestReplies = $admin->requestReplies();
							echo "<table id='repliesTR' class='table table-hover table-striped table-dark'>";
								echo "<thead>";
									echo "<tr>";
										echo "<td col='scope'>#Tools</td>";
										echo "<td col='scope'>#</td>";
										echo "<td col='scope'>Post Title</td>";
										echo "<td col='scope'>Username</td>";
										echo "<td col='scope'>Content</td>";
										echo "<td col='scope'>Date</td>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody id='replies_table'>";
									for($i=0; $i<sizeof($requestReplies); $i++){
										echo "<tr>";
											echo "<td class='tools'><i style='color: orange' class='fas fa-pencil-alt editRow'></i><i style='color: red;' class='fas fa-minus deleteRow'></i></td>";
											echo "<td class='targetData unchanged'>".$requestReplies[$i]['replies_id']."</td>";
											echo "<td class='targetData'>".$requestReplies[$i]['post_title']."</td>";
											echo "<td class='targetData unchanged'>".$requestReplies[$i]['username']."</td>";
											echo "<td class='targetData'>".$requestReplies[$i]['content']."</td>";
											echo "<td class='targetData unchanged'>".$requestReplies[$i]['replies_datetime']."</td>";
										echo "</tr>";
									}
								echo "</tbody>";
							echo "</table>";
						}
					?>
				</div>
			</div>
		</div>
		<div class="card col-lg-6">
			<div class="card-header">
				Comments
			</div>
			<div class="card-body">
				<div id="comments_form">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="content">Content Search</label>
							<input type="text" class="form-control comments">
						</div>
					</div>
				</div>
				<div class="table-responsive" style="height: 450px;">
					<?php
						if($authorized){
							$requestComments = $admin->requestComments();
							echo "<table id='commentsTR' class='table table-hover table-striped table-dark'>";
								echo "<thead>";
									echo "<tr>";
										echo "<td col='scope'>#Tools</td>";
										echo "<td col='scope'>#</td>";
										echo "<td col='scope'>subject code</td>";
										echo "<td col='scope'>subject name</td>";
										echo "<td col='scope'>tutor name</td>";
										echo "<td col='scope'>content</td>";
										echo "<td col='scope'>date</td>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody id='comments_table'>";
									for($i=0; $i<sizeof($requestComments); $i++){
										echo "<tr>";
											echo "<td class='tools'><i style='color: orange' class='fas fa-pencil-alt editRow'></i><i style='color: red;' class='fas fa-minus deleteRow'></i></td>";
											echo "<td class='targetData unchanged'>".$requestComments[$i]['cid']."</td>";
											echo "<td class='targetData unchanged'>".$requestComments[$i]['subject_code']."</td>";
											echo "<td class='targetData unchanged'>".$requestComments[$i]['subject_name']."</td>";
											echo "<td class='targetData'>".$requestComments[$i]['tutorName']."</td>";
											$txt = wordwrap($requestComments[$i]['comments_content'], 24, "</br>", true);
											echo "<td class='targetData'>".$txt."</td>";
											echo "<td class='targetData unchanged'>".$requestComments[$i]['comment_datetime']."</td>";
										echo "</tr>";
									}
								echo "</tbody>";
							echo "</table>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<div style="padding:35px;">
	<div class="card" style="">
		<div class="card-header">
			Subjects &nbsp;&nbsp;&nbsp;&nbsp;
			<i id="addSubject" data-toggle="modal" data-target="#addingSubject"
			style="color: green;" class="fas fa-plus-circle"></i>
		</div>
		<div class="card-body">
			<div class="table-responsive" style="height: 500px;">
			<?php
				if($authorized){
					$requestSubjects = $admin->requestSubjects();
					echo "<table id='subjectsTR' class='table table-hover table-striped table-dark'>";
							echo "<thead>";
								echo "<tr>";
									echo "<td scope='col'>#Tools</td>";
									echo "<td col='scope'>#</td>";
									echo "<td col='scope'>subject code</td>";
									echo "<td col='scope'>subject name</td>";
									echo "<td col='scope'>Categories</td>";
									echo "<td col='scope'>SubGroup</td>";
									echo "<td col='scope'>Level</td>";
									echo "<td col='scope'>Language</td>";
								echo "</tr>";
							echo "</thead>";
							echo "<tbody id='subjects_table'>";
								for($i=0; $i<sizeof($requestSubjects); $i++){
									echo "<tr>";
										echo "<td class='tools'><i style='color: orange' class='fas fa-pencil-alt editRow'></i><i style='color: red;' class='fas fa-minus deleteRow'></i></td>";
										echo "<td class='targetData unchanged'>".$requestSubjects[$i]['sid']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_code']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_name']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_categories']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_subgroup']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_level']."</td>";
										echo "<td class='targetData'>".$requestSubjects[$i]['subject_language']."</td>";
										//echo "<td>".$requestSubjects[$i]['comment_datetime']."</td>";
									echo "</tr>";
								}
							echo "</tbody>";
					echo "</table>";
				}
			?>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="addingSubject" tabindex="-1" role="dialog" aria-labelledby="addingSubjectTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Adding New Subject</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="adminUpdate.php" method="POST">
				<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="subject_code">Subject Code</label>
								<input type="text" class="form-control" name="subject_code">
							</div>
							<div class="form-group col-md-12">
								<label for="subject_name">Subject Name</label>
								<input type="text" class="form-control" name="subject_name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="subject_categories">Subject Categories</label>
								<input type="text" class="form-control" name="subject_categories">
							</div>
							<div class="form-group col-md-6">
								<label for="subject_subgroup">Sub Group</label>
								<input type="text" class="form-control" name="subject_subgroup">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="subject_level">Level</label>
								<input type="text" class="form-control" name="subject_level">
							</div>
							<div class="form-group col-md-6">
								<label for="subject_language">Teaching Language</label>
								<input type="text" class="form-control" name="subject_language">
							</div>
						</div>
				</div>
				<input type="hidden" name="addCourse">
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-success">Submit</button>
					<button type="button" class="btn btn-outline-danger">cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
var repliesFromData = [];
var rowValue = "";
$('body').on('click', '.editRow', function(){
	$(".editRow").each(function(){
		$(this).on("click", function(){
			var targetRow = $(this).closest("tr");
			var makeButton = "<i style='color:green' class='far fa-save saveUpdate'></i><i style='color:red' class='fas fa-ban cancelUpdate'></i>";
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

$('body').on('click', '.saveUpdate', function(){
	$(".saveUpdate").each(function(){
		var targetRow = $(this).closest("tr");
		var makeButton = "<i style='color: orange' class='fas fa-pencil-alt editRow'></i><i style='color: red;' class='fas fa-minus deleteRow'></i>";
		var allTD = targetRow.find(".targetData");
		targetRow.find(".tools").html(makeButton);
		var updatedData = "";
		allTD.each( function(){
			var value = $(this).find(".targetData").val();
			var txt = value+",";
			updatedData += txt;
			$(this).html(value);
		});
		var tobdyId = targetRow.parent().attr("id");
		switch(tobdyId){
			case "subjects_table":  
				$.post("adminUpdate.php",{

					destination: "subject",
					type: "update",
					data: updatedData

				},function(result){ 
				});
			break;
			case "comments_table":  
				$.post("adminUpdate.php",{

					destination: "comments",
					type: "update",
					data: updatedData

				},function(result){ 
				});
			break;
			case "replies_table":   
				$.post("adminUpdate.php",{

					destination: "replies",
					type: "update",
					data: updatedData

				},function(result){ 
					//alert(result);
				});
			break;
		}
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
			targetRow.fadeOut("slow", function(){
			});

			var tobdyId = targetRow.parent().attr("id");
			switch(tobdyId){
				case "subjects_table":  
					$.post("adminUpdate.php",{

						destination: "subject",
						type: "delete",
						data: updatedData

					},function(result){ 
						//alert(result);
					});
				break;
				case "comments_table":  
					$.post("adminUpdate.php",{

						destination: "comments",
						type: "delete",
						data: updatedData

					},function(result){ 
						//alert(result);
					});
				break;
				case "replies_table":   
					$.post("adminUpdate.php",{

						destination: "replies",
						type: "delete",
						data: updatedData

					},function(result){ 
						//alert(result);
					});
				break;
			}			
		});
	});
});

$(".replies").keyup(function(){
	var idname = $(this).attr("id");
	var inputValue = $(this).val().toLowerCase();
	repliesFromData.push(idname+":"+inputValue);
	$("#replies_table tr").filter(function(){
		$(this).toggle($(this).text().toLowerCase().indexOf(inputValue) > -1)
	});
});
$(".comments").keyup(function(){
	var idname = $(this).attr("id");
	var inputValue = $(this).val().toLowerCase();
	repliesFromData.push(idname+":"+inputValue);
	$("#comments_table tr").filter(function(){
		$(this).toggle($(this).text().toLowerCase().indexOf(inputValue) > -1)
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