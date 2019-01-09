<?php 
	session_start();
	include 'php/sqlQuery.php';
	$getSubjectList = new SQLQuery();
	$subjectArray=array();
	//$rawSubjectData = $getSubjectList->searchSubjectList();
	if(!isset($_GET['subjectPage'])){
		$_GET['subjectPage']=1;
	}
	if(isset($_GET['filtering'])){
		if ($_GET['lang_select']=="" and $_GET['subject_category']=="" and $_GET['subject_level']==""){
			$rawSubjectData = $getSubjectList->searchSubjectList();
		}
		else {
			$rawSubjectData = $getSubjectList->filterSubjectList($_GET['lang_select'], $_GET['subject_category'], $_GET['subject_level']);
		}
	}else 	$rawSubjectData = $getSubjectList->searchSubjectList();
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
a:link{
	text-decoration:none;
	color:black;
}
a:visited{
	color:black;
}
.card a:hover{
	opacity: 0.85;
	box-shadow: 0 -4px 16px 0 rgba(0,0,0,0.2), 0 -4px 5px 0 rgba(0,0,0,0.19);
}
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
table a:link{
	color: blue;
	text-decoration: underline;
}
table a:visited{
	color: blue;
	text-decoration: underline;
}
.fade-in-effect{
	opacity: 0;
}
.card-footer:hover{
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.subjectCard {
  -webkit-animation-duration: 1.5s;
  -webkit-animation-delay: 0s;

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
		}, 1200);
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
<!--<?php //var_dump($rawSubjectData);?>-->
<div class="container">
	<div class="row">
	<h6 class="col-4">Language</h6>
	<h6 class="col-4">Category</h6>
	<h6 class="col-4">Subject Level</h6>
	</div>
	<form method="GET" action="subjectview.php">
		<div class="row form-group">
			<div class="col-4">
				<select name="lang_select" class="custom-select">
					<option selected value="">Language Select</option>
					<option value="English">English</option>
					<option value="Chinese">Chinese</option>
				</select>
			</div>
			<div class="col-4">
				<select name="subject_category" class="custom-select">
					<option selected value="">Category Select</option>
					<?php 
						$subjectTable="subject";
						$subjectCategory = $getSubjectList->distinctCategory("subject_categories", $subjectTable);
						//$subjectLanguage = $getSubjectList->distinctCategory("subject_language", $subjectTable);
						//retrieve category name for filter label
						for($i=0; $i<sizeof($subjectCategory);$i++){
							printOption($subjectCategory[$i]['subject_categories']);
						}
						function printOption($v){
							echo "<option value='$v'>";
								echo $v;
							echo "</option>";	
						}
					?>
				</select>
			</div>
			<div class="col-4">
				<select name="subject_level" class="custom-select">
					<option selected value="">Level Select</option>
					<?php
						$subjectLevel = $getSubjectList->distinctCategory("subject_level", $subjectTable);
						for($i=0; $i<sizeof($subjectLevel);$i++){
							printOption($subjectLevel[$i]['subject_level']);
						}
					?>
				</select>	
			</div>
			<div class="col-12">
			<button type="submit" class="btn btn-primary float-right" style="margin-top:10px;">Submit</button>
			<input type="hidden" name="filtering" value="true"></input>
			</div>
		</div>
	</form>	
</div>

<?php
	//var_dump($rawSubjectData);
	$takeOffRows=9;
	$counting=0;
	$arraySize=intval(((sizeof($rawSubjectData))/$takeOffRows)+0.5);
	$counting=($_GET['subjectPage']-1)*10;
	$aj=$counting;
	$ai=$counting+1;
	//var_dump($counting);
	echo "<div class='container'>";
		echo "<div class='row'>";
			echo "<div class='col-md-6'>";
				for($aj=($counting);$aj<($counting+10);$aj+=2){
					if(isset($rawSubjectData[$aj]))
					makeCardForSubject($aj, $rawSubjectData);
				}
			echo "</div>";
			echo "<div class='col-md-6'>";
				for($ai=($counting+1);$ai<($counting+10);$ai+=2){
					if(isset($rawSubjectData[$ai]))
					makeCardForSubject($ai, $rawSubjectData);
				}
			echo "</div>";
		echo "</div>";
	echo "</div>";
	function makeCardForSubject($a, $mySubject){
		$colorCode = rand(111111,999999);
		echo "<div class='card animated subjectCard'>";
			//<img class="card-img-top" src="..." alt="Card image cap">
			//var_dump($a);
			echo "<a href=\"subjectDetail.php?course=".$mySubject[$a]['subject_code']."&sid=".$mySubject[$a]['sid']."\">";
				echo "<div class='card-header' style='background-color:#$colorCode'>";echo "</div>";
				echo "<div class='card-body'>";
					echo "<h3 class='card-title'>".$mySubject[$a]['subject_code']."</h3>";
					echo "<h4 class='card-title'>".$mySubject[$a]['subject_name']."</h4>";
					echo "<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>";
					//echo "<a href='#' class='btn btn-primary'>Go somewhere</a>";
				echo "</div>";
			echo "</a>";	
			echo "<div class='card-footer'>";
				echo "<table class='col-md-12 text-center'>";
					echo "<tr>";
						echo "<td><small>Category</small></td>";
						echo "<td><small>Subgroup</small></td>";
						echo "<td><small>Level</small></td>";
						echo "<td><small>Language</small></td>";
					echo "</tr>";
					echo "<tr>";
						echo '<td><small><a data-toggle="tooltip" data-placement="bottom" title='.$mySubject[$a]["subject_categories"].' href="subjectview.php?subject_level=&lang_select=&filtering=true&subject_category='.$mySubject[$a]['subject_categories'].'">'.$mySubject[$a]['subject_categories'].'</a></small></td>';
						echo "<td><small>".$mySubject[$a]['subject_subgroup']."</small></td>";
						echo '<td><small><a data-toggle="tooltip" data-placement="bottom" title='.$mySubject[$a]["subject_level"].' href="subjectview.php?subject_category=&lang_select=&filtering=true&subject_level='.$mySubject[$a]['subject_level'].'">'.$mySubject[$a]['subject_level'].'</a></small></td>';
						//echo "<td><small>".$mySubject[$a]['subject_level']."</small></td>";
						echo '<td><small><a data-toggle="tooltip" data-placement="bottom" title='.$mySubject[$a]["subject_language"].' href="subjectview.php?subject_category=&subject_level=&filtering=true&lang_select='.$mySubject[$a]['subject_language'].'">'.$mySubject[$a]['subject_language'].'</a></small></td>';
						//echo "<td><small>".$mySubject[$a]['subject_language']."</small></td>";
					echo "</tr>";
				echo "</table>";
			echo "</div>";
		echo "</div>";
		echo "<br>";
	}
?>		

<div class="container">		
<nav aria-label="page navigation">
	<ul class="pagination justify-content-center" style="width:100%;">
	<li class="page-item">
		<a class="page-link text-warning" href="<?php
			$destination="subjectview.php?";
			if(isset($_GET['filtering'])=="true")
				$destination.="filtering=true&lang_select=".$_GET['lang_select']."&subject_category=".$_GET['subject_category']."&subject_level=".$_GET['subject_level'];
			$destination.="&subjectPage=1";
			echo $destination;
		?>"><<</a>
	</li>
	<li class="page-item">
		<a class="page-link" href="<?php 
			$destination="subjectview.php?";
			if(isset($_GET['filtering'])=="true")
				$destination.="filtering=true&lang_select=".$_GET['lang_select']."&subject_category=".$_GET['subject_category']."&subject_level=".$_GET['subject_level'];
			if($_GET['subjectPage']-1>0){
				$destination.="&subjectPage=".($_GET['subjectPage']-1);
			}else $destination.="&subjectPage=".($_GET['subjectPage']);
			echo $destination;
		?>"><</a>
	</li>		
<?php
	if($arraySize>7){
		if($_GET['subjectPage']>5){
			if($_GET['subjectPage']+4>$arraySize){
				for($i=$arraySize-6; $i<=$arraySize; $i++) makePageNumberButton($i);
			}else{
				for($i=$_GET['subjectPage']-3;$i<=$_GET['subjectPage']; $i++) makePageNumberButton($i);
				for($i=$_GET['subjectPage']+1; $i<=$_GET['subjectPage']+3; $i++) makePageNumberButton($i);
			}
		}else{
			for($i=1; $i<=7; $i++) makePageNumberButton($i,0);
		}
	}else{
		for($i=1;$i<=$arraySize;$i++) makePageNumberButton($i,0);
	}
	//var_dump($rawSubjectData);

	function makePageNumberButton($number){
		if(isset($_GET['filtering'])=="true"){
			$destination="subjectview.php?filtering=true&lang_select=".$_GET['lang_select']."&subject_category=".$_GET['subject_category']."&subject_level=".$_GET['subject_level']."&subjectPage=".$number;
		}else{
			$destination="subjectview.php?subjectPage=".$number;
		}
		//var_dump($destination);
		echo "<li id='pageList$number' class='page-item'>";
			echo "<a class='page-link' href='$destination'>".$number."</a>";
		echo "</li>";	
	}
	//if($_GET['subjectPage']+1<=$arraySize){echo $_GET['subjectPage']+1;}else{echo $_GET['subjectPage'];}
?>
	<li class="page-item">
		<a class="page-link" href="<?php 
			$destination="subjectview.php?";
			if(isset($_GET['filtering'])=="true")
				$destination.="filtering=true&lang_select=".$_GET['lang_select']."&subject_category=".$_GET['subject_category']."&subject_level=".$_GET['subject_level'];
			if($_GET['subjectPage']+1<=$arraySize){
				$destination.="&subjectPage=".($_GET['subjectPage']+1);
			}else $destination.="&subjectPage=".($_GET['subjectPage']);
			echo $destination;
		?>">></a>
	</li>
	<li class="page-item">
		<a class="page-link text-warning" href="<?php 
			$destination="subjectview.php?";
			if(isset($_GET['filtering'])=="true")
				$destination.="filtering=true&lang_select=".$_GET['lang_select']."&subject_category=".$_GET['subject_category']."&subject_level=".$_GET['subject_level'];
			if($arraySize>0) $destination.="&subjectPage=$arraySize";
			else $destination.="&subjectPage=1";
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
	$('[data-toggle="tooltip"]').tooltip(); 
	$activePageButton=<?php echo $_GET['subjectPage'];?>;
	$currentPageName="#pageList"+$activePageButton;
	$($currentPageName).addClass("active");
	//alert($currentPageName);
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
</script>
</body>
</html>	