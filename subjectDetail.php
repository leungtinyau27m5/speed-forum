<?php 
	session_start();
	require 'php/sqlQuery.php';
	if(isset($_GET['course'])){
		$subjectQuery = new SQLQuery();
		$subjectDetail = $subjectQuery->searchSubjectDetail($_GET['course']);
	}else{
		$_SESSION['msg']="Please select a valid course, back to the page in 3 second";
		header ("Refresh:5; url=index.php");
		//var_dump($_SESSION['msg']);
	}
	if(!isset($_GET['page'])){$_GET['page']=1;}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css\commonCSS.css">
<link rel="stylesheet" href="css\animation.css">
<!--
xs (for phones - screens less than 768px wide)
sm (for tablets - screens equal to or greater than 768px wide)
md (for small laptops - screens equal to or greater than 992px wide)
lg (for laptops and desktops - screens equal to or greater than 1200px wide)

basic structure of bootstrap grid:
col-(xs/sm/md/lg)-(numbers from 1 up to 12)
e.g: col-sm-4 : size for screen equals or greater than 768px wide and 4*8.33%of the screen
-->
<style>
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
.commentCardHead{
	color: white;
	padding-top :2px;
	padding-bottom: 2px;
}
.commentCardGrade{
	float:right;
	//color:white;
}
.gradeAPlus{
	background-color: green;
}
.gradeA{
	background-color: #009900;
}
.gradeBPlus{
	background-color: #248f24;
}
.gradeB{
	background-color: #29a329;
}
.gradeCPlus{
	background-color: #ffa64d;
}
.gradeC{
	background-color: #ff9933;
}
.gradeDPlus{
	background-color: #ff471a;
	
}
.gradeD{
	background-color: #ff3300;
}
.gradeF{
	background-color: red;
}
</style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
				echo "<h5>Welcome</h5>
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
		}, 3000);
	});
</script>
		<nav class="navbar navbar-expand-lg">
			<a class="navbar-brand" href="">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="subjectview.php">Subject Review</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="speedForum.php">Forum</a>
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
					}else{
						echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#loginModalCenter'><i class='material-icons login-icon'>account_circle</i><h6 class='d-inline-block'>LogIn</h6>";
						echo "</button>";
					}
				?>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModalCenter"><i class="material-icons login-icon">account_circle</i><h6 class="d-inline-block">LogIn</h6></button> -->
			</div>		
			</div>
	<div class="modal fade" id="loginModalCenter" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="color: black;">
				<div id="loginForm">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalCenterTitle">LogIn</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>	
				</div>
				<div class="modal-body">
					<form action="php/login.php" method="POST">
						<div class="card">
						<img class="card-img-top profile-photo" src="img\profile.png" alt="profile-photo">
						<div class="card-body" style="color: black;">
							<p class="card-text">
								<div class="form-group">
									<label for="Myusername">User Name :</label>
									<input required type="text" class="form-control" name="username" id="Myusername" placeholder="My UserName">
									<label class="my-indication" id="indication-username"></label>
								</div>
								<div class="form-group">
									<label for="Mypassword">Password :</label>
									<input type="password" class="form-control" name="password" id="Mypassword" placeholder="My Password">
									<label class="my-indication" id="indication-password"></label>
								</div>
								<div class="form-check">
									<a title="The login status will be last 30days">
									<input name="rememberMe" type="checkbox" class="form-check-input" id="rememberMe">
									</a>
									<label class="form-check-label" for="remeberMe">Remember Me</label>
								</div>
								<div class="form-group" style="margin-top:10px;">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
									<a class="text-danger"id="forget-account" style="float:right;"><label>Forget?</label></a>	
								</div>
							</p>
						</div>
						</div>
					</form>
				</div>
				</div>
				<div id="regForm" style="display:none;">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalCenterTitle">Register</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>	
				</div>
				<div class="modal-body">
					<form action="php/register.php" method="POST">
						<div class="card">
						<div class="card-body" style="color: black;">
							<p class="card-text">
								<div class="form-group">
									<label for="reg_uname">User Name :</label>
									<input onkeyup="validusername();" required type="text" class="form-control" name="reg_uname" id="reg_uname" placeholder="Enter your username">
									<label class="my-indication" id="reg_uname_indi"></label>								
								</div>
								<div class="form-group">
									<label for="reg_upw">Password :</label>
									<input onkeyup="validpassword();" required type="password" class="form-control" name="reg_upw" id="reg_upw" placeholder="******">
									<label class="my-indication" id="reg_upw_indi"></label>								
								</div>
								<div class="form-group">
									<label for="reg_upwc">Confirmed Password :</label>
									<input onkeyup="validconfirmed();" required type="password" class="form-control" name="reg_upwc" id="reg_upwc" placeholder="******">
									<label class="my-indication" id="reg_upwc_indi"></label>									
								</div>
								<div class="form-group">
								<label for="reg_uemail">Email :</label>
									<div class="input-group mb-3">
									<input onkeyup="validemail();" required type="text" class="form-control" name="reg_email" id="reg_email" placeholder="xxxxxxxxxS">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">@student.speed-polyu.edu.hk</span>
										</div>
									</div>
									<label style="float:right;"class="my-indication text-danger">only serve speed's students</label>										
								</div>
								<div class="form-group">
									<label for="reg_usex">Sex :</label>
									<select class="form-control" name="reg_sex" id="reg_sex">
										<option value="M">Male</option>
										<option value="F">Female</option>
										<option selected="selected" value="S">Secret>3<</option>
									</select>
									<label class="my-indication"></label>								
								</div>
								<div class="form-group">
									<button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button disabled id="reg_submit" type="submit" class="btn btn-primary">Submit</button>								
								</div>								
							</p>
						</div>
						</div>
					</form>
				</div>				
				</div>
				<div class="modal-footer">
					<a id="sign-up-button"><label>Sign up?</label></a>				
				</div>
			</div>
		</div>
	</div>	<div class="modal fade" id="loginModalCenter" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="color: black;">
				<div id="loginForm">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalCenterTitle">LogIn</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>	
				</div>
				<div class="modal-body">
					<form action="php/login.php" method="POST">
						<div class="card">
						<img class="card-img-top profile-photo" src="img\profile.png" alt="profile-photo">
						<div class="card-body" style="color: black;">
							<p class="card-text">
								<div class="form-group">
									<label for="Myusername">User Name :</label>
									<input required type="text" class="form-control" name="username" id="Myusername" placeholder="My UserName">
									<label class="my-indication" id="indication-username"></label>
								</div>
								<div class="form-group">
									<label for="Mypassword">Password :</label>
									<input type="password" class="form-control" name="password" id="Mypassword" placeholder="My Password">
									<label class="my-indication" id="indication-password"></label>
								</div>
								<div class="form-check">
									<a title="The login status will be last 30days">
									<input name="rememberMe" type="checkbox" class="form-check-input" id="rememberMe">
									</a>
									<label class="form-check-label" for="remeberMe">Remember Me</label>
								</div>
								<div class="form-group" style="margin-top:10px;">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
									<a class="text-danger"id="forget-account" style="float:right;"><label>Forget?</label></a>	
								</div>
							</p>
						</div>
						</div>
					</form>
				</div>
				</div>
				<div id="regForm" style="display:none;">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalCenterTitle">Register</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>	
				</div>
				<div class="modal-body">
					<form action="php/register.php" method="POST">
						<div class="card">
						<div class="card-body" style="color: black;">
							<p class="card-text">
								<div class="form-group">
									<label for="reg_uname">User Name :</label>
									<input onkeyup="validusername();" required type="text" class="form-control" name="reg_uname" id="reg_uname" placeholder="Enter your username">
									<label class="my-indication" id="reg_uname_indi"></label>								
								</div>
								<div class="form-group">
									<label for="reg_upw">Password :</label>
									<input onkeyup="validpassword();" required type="password" class="form-control" name="reg_upw" id="reg_upw" placeholder="******">
									<label class="my-indication" id="reg_upw_indi"></label>								
								</div>
								<div class="form-group">
									<label for="reg_upwc">Confirmed Password :</label>
									<input onkeyup="validconfirmed();" required type="password" class="form-control" name="reg_upwc" id="reg_upwc" placeholder="******">
									<label class="my-indication" id="reg_upwc_indi"></label>									
								</div>
								<div class="form-group">
								<label for="reg_uemail">Email :</label>
									<div class="input-group mb-3">
									<input onkeyup="validemail();" required type="text" class="form-control" name="reg_email" id="reg_email" placeholder="xxxxxxxxxS">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">@student.speed-polyu.edu.hk</span>
										</div>
									</div>
									<label style="float:right;"class="my-indication text-danger">only serve speed's students</label>										
								</div>
								<div class="form-group">
									<label for="reg_usex">Sex :</label>
									<select class="form-control" name="reg_sex" id="reg_sex">
										<option value="M">Male</option>
										<option value="F">Female</option>
										<option selected="selected" value="S">Secret>3<</option>
									</select>
									<label class="my-indication"></label>								
								</div>
								<div class="form-group">
									<button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button disabled id="reg_submit" type="submit" class="btn btn-primary">Submit</button>								
								</div>								
							</p>
						</div>
						</div>
					</form>
				</div>				
				</div>				
				<div class="modal-footer">
					<a id="sign-up-button"><label>Sign up?</label></a>				
				</div>
			</div>
		</div>
	</div>			
</nav>	

<div class="container">
<?php
		if(isset($_GET['course'])){
		if(sizeof($subjectDetail)==0){
			$information=$subjectQuery->showSubjectInformation($_GET['course']);
			printOutInformation($information);
			echo "<h1 class='text-danger text-center'>There is no relevant Comments</h1>";
		}else{
			printOutInformation($subjectDetail);
		}
		if(isset($_GET['course'])){
			//printOutInformation($subjectDetail);
		}else{
			echo "<h1 class='text-danger'>Please back to previous page to select Course!!</h1>";
		}
		}
		function printOutInformation($array){
			echo "<h1>".$array[0]['subject_code']."</h1>";
			echo "<h3>".$array[0]['subject_name']."</h3></br>";
			echo "<div class='row'><div class='col-sm-5 table-responsive-sm'>";
				echo "<table class='table'>";
					echo "<tr class='text-center'>"; 
						echo "<td>Categories</td>";
						echo "<td>Groupings</td>";
						echo "<td>Level</td>";
						echo "<td>Language</td>";
						echo "</tr>";
						echo "<tr class='text-center'>"; 
						echo "<td>";echo $array[0]['subject_categories'];echo "</td>";
						echo "<td>";echo $array[0]['subject_subgroup'];echo "</td>";
						echo "<td>";echo $array[0]['subject_level'];echo "</td>";
						echo "<td>";echo $array[0]['subject_language'];echo "</td>";	
					echo "</tr>";
				echo "</table>";
			echo "</div>";
			echo "<div class='col-sm-7'>";
				echo "<div id='simpleStatistic' class='row'>";

				echo "</div>";
			echo "</div></div>";
		}
?>
</div>
<div class="modal fade" id="writeComment" role="dalog">
	<div class="modal-dialog modal-lg" style="margin-top:100px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">My Comment</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="php/writeComment.php" method="POST">
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label">Semester</label>
					<div class="col-10">
						<?php
							$sem = array();
							$yearStart = 2015;
							$yearNow = date("Y");
							$counter = $yearStart;
							$index = 0;
							while($counter<$yearNow){
								$sem[$index]=$counter."/".($counter-2000+1)." SEM A";
								$index++;
								$sem[$index]=$counter."/".($counter-2000+1)." SEM B";
								$index++;
								$counter++;
							}
						?>
						<select name="commtSem" class="form-control">
							<?php
								for($i=0; $i<(sizeof($sem)); $i++){
									echo "<option value=\"$sem[$i]\">".$sem[$i]."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label">Tutor</label>
					<div class="col-10">
					<input name="commtTutor" type="text" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label">Grade</label>
					<div class="col-10">
					<select name="commtGrade" class="form-control">
					<?php
						$gradeIndex=0;
						$gradeArray= array();
						for($i=65; $i<=70; $i++){
							if($i!=69 && $i!=70){
								$gradeArray[$gradeIndex]=chr($i)."+";
								$gradeIndex++;
								$gradeArray[$gradeIndex]=chr($i);
								$gradeIndex++;
							}
							if($i==70){
								$gradeArray[$gradeIndex]=chr($i);
							}
						}
						for($i=0; $i<sizeof($gradeArray); $i++){
							echo "<option value=\"$gradeArray[$i]\">".$gradeArray[$i]."</option>";
						}
					?>
					</select>
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label">Workload</label>
					<div class="col-10">
					<select name ="commtWorkload" class="form-control">
						<option value="Very Light">Very Light</option>
						<option value="Light">Light</option>
						<option value="Okay">Okay</option>
						<option value="Heavy">Heavy</option>
						<option value="Very Heavy">Very Heavy</option>
					</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" data-toggle="tooltip" 
				data-replacement="top" title="group project number" class="col-2 col-form-label">GP. No.</label>
					<div class="col-10">
					<input name="commtGP" type="number" class="form-control">
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" data-toggle="tooltip" 
				data-replacement="top" title="Assignment number" class="col-2 col-form-label">Assign. No.</label>
					<div class="col-10">
					<input name="commtAssign" type="number" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" data-toggle="tooltip" 
				data-replacement="top" title="text number" class="col-2 col-form-label">Test</label>
					<div class="col-10">
					<input name="commtTest" type="number" class="form-control">
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" data-toggle="tooltip" 
				data-replacement="top" title="exam number" class="col-2 col-form-label">Exam</label>
					<div class="col-10">
					<input name="commtExam" type="number" class="form-control">
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label">Comment</label>
					<div class="col-10">
					<textarea name="commtContent" class="form-control" rows="7"></textarea>
					</div>
					<input type="hidden" name="identity" value="<?php if(isset($_SESSION['userId']))echo $_SESSION['userId']; else echo "0";; ?>">
					<input type="hidden" name="subjectId" value="<?php echo $_GET['sid'];?>">
				</div>
			</div>
			<div class="modal-footer">
				<button name="commtSubmit" value="submitted" type="submit" class="btn btn-success">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>	
<div class="container text-right">
	<button data-toggle="modal" data-target="#writeComment" class="btn btn-outline-success" type="button">Write a Comment</button>
	<button id="showDetailedStat" type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#courseStat">Course Detailed Statistic</button>
</div>

<div class='modal fade' id='courseStat' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
      		<div class="modal-header">
      			<h5 class="modal-title" id="exampleModalLongTitle">Course Detailed Statistic</h5>
      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		 <div id="detailedCourseStat" class="modal-body">
      		 	
      		 </div>
      		 <div class="modal-footer">
      		 	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		 </div>
      	</div>
	</div>
</div>

<div class="container">
<?php
		if(isset($_GET['course'])){
		$takeOffRows=9;
		$JumpRow=0;
		$start=($_GET['page']-1)*$takeOffRows;
		$commentSize=intval(ceil(((sizeof($subjectDetail))/$takeOffRows)+0.5));
			echo "<div class='row'>";
				echo "<div class='col-md-6'>";
					echo "<div class='col-md-12'>";
					for($JumpRow=$start; $JumpRow<$takeOffRows*$_GET['page']; $JumpRow+=2){
						if(isset($subjectDetail[$JumpRow])){
						$id = $_GET['page']."card".$JumpRow;
						echo "<div class='card animated subjectCard' style='margin-top:30px;'>";
							echo "<div id='$id' class='card-header commentCardHead'>";
								echo "<h5 class='commentCardGrade'>".$subjectDetail[$JumpRow]['grades']."</h5>";
							echo "</div>";
							echo "<div class='card-body' style='overflow-x: scroll;'>";
								echo "<div class='table-responsive-sm'>";
									echo "<table class='table table-hover'>";
										echo "<thead>";
											echo "<tr>";
												echo "<th scope='col'>Year</th>";
												echo "<th scope='col'>Tutor</th>";
												echo "<th scope='col'>workload</th>";
												/*echo "<th scope='col'>Group Project</th>";
												echo "<th scope='col'>Test</th>";
												echo "<th scope='col'>Exam</th>";*/
											echo "</tr>";
										echo "</thead>";
										echo "<tbody>";
											echo "<tr>";
												echo "<td>".$subjectDetail[$JumpRow]['year_finished']."</td>";
												echo "<td>".$subjectDetail[$JumpRow]['tutorName']."</td>";
												echo "<td>".$subjectDetail[$JumpRow]['workload']."</td>";
											echo "</tr>";
										echo "</tbody>";
									echo "</table>";
								echo "</div>";
								echo $subjectDetail[$JumpRow]['comments_content'];
							echo "</div>";
							echo "<div class='card-footer text-right' style='padding: 1px 5px'>";
								echo "<small>&#128337;".$subjectDetail[$JumpRow]['comment_datetime']."</small>";
							echo "</div>";
						echo "</div>";
						}
					}
					echo "</div>";
				echo "</div>";
				echo "<div class='col-md-6'>";
					echo "<div class='col-md-12'>";
						for($JumpRow=$start+1; $JumpRow<$takeOffRows*$_GET['page']; $JumpRow+=2){
							if(isset($subjectDetail[$JumpRow])){
							$id = $_GET['page']."card".$JumpRow;
							echo "<div class='card animated  subjectCard' style='margin-top:30px;'>";
								echo "<div id='$id' class='card-header commentCardHead'>";
									echo "<h5 class='commentCardGrade'>".$subjectDetail[$JumpRow]['grades']."</h5>";
								echo "</div>";						
								echo "<div class='card-body'>";
									echo "<div class='table-responsive-sm'>";
										echo "<table class='table table-hover'>";
											echo "<thead>";
												echo "<tr>";
													echo "<th scope='col'>Year</th>";
													echo "<th scope='col'>Tutor</th>";
													echo "<th scope='col'>workload</th>";
													/*echo "<th scope='col'>Group Project</th>";
													echo "<th scope='col'>Test</th>";
													echo "<th scope='col'>Exam</th>";*/
												echo "</tr>";
											echo "</thead>";
											echo "<tbody>";
												echo "<tr>";
													echo "<td>".$subjectDetail[$JumpRow]['year_finished']."</td>";
													echo "<td>".$subjectDetail[$JumpRow]['tutorName']."</td>";
													echo "<td>".$subjectDetail[$JumpRow]['workload']."</td>";
												echo "</tr>";
											echo "</tbody>";
										echo "</table>";
									echo "</div>";
									echo $subjectDetail[$JumpRow]['comments_content'];
								echo "</div>";
								echo "<div class='card-footer text-right' style='padding: 1px 5px'>";
									echo "<small>&#128337;".$subjectDetail[$JumpRow]['comment_datetime']."</small>";
								echo "</div>";							
							echo "</div>";
							}
						}				
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
?>
</div>
<div class="container">		
<nav aria-label="page navigation">
	<ul class="pagination justify-content-center" style="width:100%;">
	<li class="page-item">
		<a class="page-link text-warning" href="<?php
			$destination="subjectDetail.php?course=".$_GET['course'];
			$destination.="&page=1";
			echo $destination;
		?>"><<</a>
	</li>
	<li class="page-item">
		<a class="page-link" href="<?php 
			$destination="subjectDetail.php?course=".$_GET['course'];
			if($_GET['page']-1>0){
				$destination.="&page=".($_GET['page']-1);
			}else $destination.="&page=".($_GET['page']);
			echo $destination;
		?>"><</a>
	</li>		
<?php
	if(isset($_GET['course'])){
	if($commentSize>7){
		if($_GET['page']>5){
			if($_GET['page']+4>$commentSize){
				for($i=$commentSize-6; $i<=$commentSize; $i++) makePageNumberButton($i);
			}else{
				for($i=$_GET['page']-3;$i<=$_GET['page']; $i++) makePageNumberButton($i);
				for($i=$_GET['page']+1; $i<=$_GET['page']+3; $i++) makePageNumberButton($i);
			}
		}else{
			for($i=1; $i<=7; $i++) makePageNumberButton($i,0);
		}
	}else{
		for($i=1;$i<=$commentSize;$i++) makePageNumberButton($i,0);
	}
	//var_dump($rawSubjectData);
	}
	function makePageNumberButton($number){
		$destination="subjectDetail.php?course=".$_GET["course"]."&page=".$number;
		//var_dump($destination);
		echo "<li id='pageList$number' class='page-item'>";
			echo "<a class='page-link' href='$destination'>".$number."</a>";
		echo "</li>";	
	}
?>
	<li class="page-item">
		<a class="page-link" href="<?php 
			$destination="subjectDetail.php?course=".$_GET['course'];
			if($_GET['page']+1<=$commentSize){
				$destination.="&page=".($_GET['page']+1);
			}else $destination.="&page=".($_GET['page']);
			echo $destination;
		?>">></a>
	</li>
	<li class="page-item">
		<a class="page-link text-warning" href="<?php 
			$destination="subjectDetail.php?course=".$_GET['course'];
			if($commentSize>0) $destination.="&page=$commentSize";
			else $destination.="&page=1";
			echo $destination;
		?>">>></a>
	</li>
	</ul>
</nav>	
</div>
<div class="" style="background-color: #f24040;color:white;">
	<div class="container">
	<div class="row">
		<div class="col-md-4 text-center">
			<h5>Navigation</h5><hr>
			<div id="accordionOne">
				<div class="card">
				<a href="index.php" class="list-group-item">Home</a>
				</div>
				<div class="card">
					<a href="subjectView.php" class="card-header list-group-item list-action" id="headingOne">Subject Review
					</a>
				</div>	
				<div class="card">
						<a href="speedForum.php" class="card-header list-group-item list-action" id="headingTwo">Forum
						</a>
				</div>	
				<div class="card">
					<a href="#" class="card-header list-group-item list-action" id="headingTwo" 
						data-toggle="collapse" data-target="#footerAdvancedMenu" 
						aria-expanded="true" aria-controls="footerAdvancedMenu">Advanced
					</a>
				</div>	
				<li class="list-group-item">
					<form class="form-inline">
						<input class="form-control mr-sm-2" type="search" style="width:70%;" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				</li>	
			</div>
		</div>
		<div class="col-md-4 text-center">
			<h5>Our Words</h5><hr>
					<dl class="row">
						<dt class="col-sm-3">Goals</dt>
						<dd class="col-sm-9">asdfasdfasdfsdaf</dd>
						<dt class="col-sm-3">Expectation</dt>
						<dd class="col-sm-9">asdfasdfasdf</dd>
						<dt class="col-sm-3">Our Words</dt>
						<dd class="col-sm-9">898</dd>
					</dl>
			<div class="col-sm-12">
			asdfasdfasdfasdf
			</div>
		</div>
		<div class="col-md-4">
			<h5 class="text-center">Leave us comments</h5><hr>
			<form action="" method="POST">
				<div class="form-group">
					<label for="leaveCommToUsName">Name</label>
					<input type="text" class="form-control" id="leaveCommToUsName" placeholder="Enter your Name">
					<small id="leaveCommToUsNameHelp" class="form-text">*you could leave it</small>
				</div>
				<div class="form-group">
					<label for="leaveCommToUsEmail">Email</label>
					<input type="email" class="form-control" id="leaveCommToUsEmail" placeholder="Enter your Email">
					<small id="leaveCommToUsEmailHelp" class="form-text">*you could leave it</small>
				</div>
				<div class="form-group">
					<textarea rows="4" class="form-control" id="leaveCommToUsContent">
					</textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div><hr>
	<div class="text-center" style="padding-bottom: 8px;">
		<ul class="list-unstyled list-inline">
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Facebook" class="fa" src="img\facebook.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Google-Plus" class="fa" src="img\google-plus.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Instagram" class="fa" src="img\instagram.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Tiwtter" class="fa" src="img\twitter.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Youtube" class="fa" src="img\youtube.png"></a>
			</li>			
		</ul>	
	</div>
	</div>
</div>
<script src="js/reg_valid.js"></script>
<script>
var switchForm=false;
$(document).ready(function(){
	$activePageButton=<?php echo $_GET['page'];?>;
	$currentPageName="#pageList"+$activePageButton;
	$($currentPageName).addClass("active");
	$('[data-toggle="tooltip"]').tooltip(); 
	
	
	var comments = <?php echo json_encode($subjectDetail); ?>;
	var takeOffRows = <?php echo $takeOffRows; ?>;
	var start = <?php echo ($_GET['page']-1)*$takeOffRows; ?>;
	var end = <?php echo $takeOffRows*$_GET['page'];?>;
	var getid;
	var pageNum = <?php echo (sizeof($subjectDetail)/$takeOffRows)+0.5; ?>;
	pageNum=Math.ceil(pageNum);
	for (var j=1; j<=pageNum; j++){
		for(var i=start; i<comments.length; i++){
			$getid="#"+j+"card"+i;
			if(comments[i]['grades']=="A+"){
				$($getid).addClass("gradeAPlus"); 
			}else if(comments[i]['grades']=="A"){
				$($getid).addClass("gradeA");
			}else if(comments[i]['grades']=="B+"){
				$($getid).addClass("gradeBPlus");
			}else if(comments[i]['grades']=="B"){
				$($getid).addClass("gradeB"); 
			}else if(comments[i]['grades']=="C+"){
				$($getid).addClass("gradeCPlus");
			}else if(comments[i]['grades']=="C"){
				$($getid).addClass("gradeC");
			}else if(comments[i]['grades']=="D+"){
				$($getid).addClass("gradeDPlus");
			}else if(comments[i]['grades']=="D"){
				$($getid).addClass("gradeD");
			}else if(comments[i]['grades']=="F"){
				$($getid).addClass("gradeF");
			}
			
				/*switch(comments[i]['grades']){
				case "C": $($getid).addClass("gradeC"); break;
				case "D+": $($getid).addClass("gradeDPlus"); break;
				case "D": $($getid).addClass("gradeD"); break;
				case "F": $($getid).addClass("gradeF"); break;
				}*/
				// break problem, also break the for loop.
		}
	}
	var randomStyle = Math.floor((Math.random() * 10) + 1);
	var subjectCard = $(".subjectCard");
	//alert(subjectCard);
	switch(randomStyle){
		case 1: subjectCard.addClass("fadeIn"); break;
		case 2: subjectCard.addClass("pulse"); break;
		case 3: subjectCard.addClass("bounceIn"); break;
		case 4: subjectCard.addClass("fadeInUp"); break;
		case 5: subjectCard.addClass("jackInTheBox"); break;
		case 6: subjectCard.addClass("swing"); break;
		case 7: subjectCard.addClass("slideInUp"); break;
		case 8: subjectCard.addClass("slideInDown"); break;
		case 9: subjectCard.addClass("zoomIn"); break;
		case 10: subjectCard.addClass("lightSpeedIn"); break;
	}
});
$("#larger-text").click(function() {
	$("body").css("fontSize", "+=2px");
});
	$("#sign-up-button").click(function(){
			//window.alert(switchForm);
		if(switchForm==false){
			switchForm=true;
			//window.alert(switchForm);
			$("#regForm").css("display","block");
			$("#loginForm").css("display","none");
			//$("#loginForm").animate("opacity","1")
			$("#sign-up-button").find("label").css("color","green");
			$("#sign-up-button").find("label").html("login Now");
		}else{
			switchForm=false;
			//window.alert(switchForm);
			$("#loginForm").css("display","block");
			$("#regForm").css("display","none");
			$("#sign-up-button").find("label").css("color","orange");
			$("#sign-up-button").find("label").html("Sign up?");
		}
	});
$(document).ready(function(){
	var subjectComment = <?php echo json_encode($subjectDetail); ?>;
	var countingBaseOnGrade = [];
	for(var i=0; i<9; i++)	countingBaseOnGrade[i]=0;
	for(var i=0; i<subjectComment.length; i++){
		//alert(subjectComment[i]['grades']);
		switch(subjectComment[i]['grades']){
			case "A+": countingBaseOnGrade[0]++; break;
			case "A": countingBaseOnGrade[1]++; break;
			case "B+": countingBaseOnGrade[2]++; break;
			case "B": countingBaseOnGrade[3]++; break;
			case "C+": countingBaseOnGrade[4]++; break;
			case "C": countingBaseOnGrade[5]++; break;
			case "D+": countingBaseOnGrade[6]++; break;
			case "D": countingBaseOnGrade[7]++; break;
			case "F": countingBaseOnGrade[8]++; break;
		}
	}
	var max = Math.max.apply(Math, countingBaseOnGrade);
	var totalComment = subjectComment.length;
	var number = [];
	for(var i=0; i<countingBaseOnGrade.length; i++)
		number[i] = Math.round((countingBaseOnGrade[i]/totalComment)*100);
	$("#simpleStatistic").append("<div class='col-sm-12'><h6 class='text-danger'>Total Replies: (" + subjectComment.length + ") </h6></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>A+ (" + countingBaseOnGrade[0] + ") (" + number[0] + "%) <div class='progress'><div class='progress-bar gradeAPlus' role='progressbar' style='width: " + number[0] + "%' aria-valuenow='" + number[0] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>A (" + countingBaseOnGrade[1] + ") (" + number[1] + "%)  <div class='progress'><div class='progress-bar gradeA' role='progressbar' style='width: " + number[1] + "%' aria-valuenow='" + number[1] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>B+ (" + countingBaseOnGrade[2] + ") (" + number[2] + "%)  <div class='progress'><div class='progress-bar gradeBPlus' role='progressbar' style='width: " + number[2] + "%' aria-valuenow='" + number[2] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>B (" + countingBaseOnGrade[3] + ") (" + number[3] + "%)  <div class='progress'><div class='progress-bar gradeB' role='progressbar' style='width: " + number[3] + "%' aria-valuenow='" + number[3] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>C+ (" + countingBaseOnGrade[4] + ") (" + number[4] + "%)  <div class='progress'><div class='progress-bar gradeCPlus' role='progressbar' style='width: " + number[4] + "%' aria-valuenow='" + number[4] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>C (" + countingBaseOnGrade[5] + ") (" + number[5] + "%)  <div class='progress'><div class='progress-bar gradeC' role='progressbar' style='width: " + number[5] + "%' aria-valuenow='" + number[5] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>D+ (" + countingBaseOnGrade[6] + ") (" + number[6] + "%)  <div class='progress'><div class='progress-bar gradeDPlus' role='progressbar' style='width: " + number[6] + "%' aria-valuenow='" + number[6] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>D (" + countingBaseOnGrade[7] + ") (" + number[7] + "%)  <div class='progress'><div class='progress-bar gradeD' role='progressbar' style='width: " + number[7] + "%' aria-valuenow='" + number[7] + "' aria-valuemax='" + max + "'></div></div></div>");
	$("#simpleStatistic").append("<div class='col-sm-6'>F (" + countingBaseOnGrade[8] + ") (" + number[8] + "%)  <div class='progress'><div class='progress-bar gradeF' role='progressbar' style='width: " + number[8] + "%' aria-valuenow='" + number[8] + "' aria-valuemax='" + max + "'></div></div></div>");	
	


	$("#showDetailedStat").on("click", function(){
		for(var i=0; i<subjectComment.length; i++){
			
		}
		$("#detailedCourseStat").append();
	});	


});
</script>
</body>
</html>	