<?php 
	session_start();
	include 'php/sqlQuery.php' ;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css\commonCSS.css">
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
.subjectiveHead{
	//background-color: black;
}
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
.myMainHeading{
	-webkit-clip-path: polygon(100% 0%, 75% 50%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
	clip-path: polygon(100% 0%, 75% 50%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
	color: #f4f4dd;
	padding-top:80px;
}
.myMainHeading h1{
	text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);
}
.splitHeading{
	padding-top:35px;
	padding-bottom:35px;
}
.splitHeading h2{
	text-shadow: 2px 2px 4px #000000;
	color:white;
}
.subjectiveCard{
	//border:2px solid black;
}
.subjectiveCard h2{
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	cursor: pointer;
	border: none;
	font: normal 55px/normal "Passero One", Helvetica, sans-serif;
	color: rgba(255,255,255,1);
	text-align: center;
	-o-text-overflow: clip;
	text-overflow: clip;
	text-shadow: 0 1px 0 rgb(204,204,204) , 0 2px 0 rgb(201,201,201) , 0 3px 0 rgb(187,187,187) , 0 4px 0 rgb(185,185,185) , 0 5px 0 rgb(170,170,170) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 5px 10px rgba(0,0,0,0.247059) , 0 10px 10px rgba(0,0,0,0.2) , 0 20px 20px rgba(0,0,0,0.14902) ;
	-webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	-moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	-o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
}
.subjectiveCard h5{
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	cursor: pointer;
	border: none;
	font: normal 28px/normal "Passero One", Helvetica, sans-serif;
	color: rgba(255,255,255,1);
	text-align: center;
	-o-text-overflow: clip;
	text-overflow: clip;
	text-shadow: 0 1px 0 rgb(204,204,204) , 0 2px 0 rgb(201,201,201) , 0 3px 0 rgb(187,187,187) , 0 4px 0 rgb(185,185,185) , 0 5px 0 rgb(170,170,170) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 5px 10px rgba(0,0,0,0.247059) , 0 10px 10px rgba(0,0,0,0.2) , 0 20px 20px rgba(0,0,0,0.14902) ;
	-webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	-moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	-o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
	transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);	
}
.subjectiveCard h2:hover, .subjectiveCard h5:hover{
	color: rgba(100,100,100,1);
	text-shadow: 0 1px 0 rgba(255,255,255,1) , 0 2px 0 rgba(255,255,255,1) , 0 3px 0 rgba(255,255,255,1) , 0 4px 0 rgba(255,255,255,1) , 0 5px 0 rgba(255,255,255,1) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 -5px 10px rgba(0,0,0,0.247059) , 0 -7px 10px rgba(0,0,0,0.2) , 0 -15px 20px rgba(0,0,0,0.14902) ;
	-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
	-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
	-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
	transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
}
@media only screen and (min-width: 992px){
	.myStyleContainer{
		padding: 1% 10% 1% 10%;
	}
}
@media only screen and (max-width: 992px){

}
</style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
	</div>			
</nav>	
<div class="parallax parallaxMain" style="height:380px;">
	<div class="col-md-5 myMainHeading text-center" style="height:380px;background-color: rgba(98, 96, 98, 0.4);">
	<h1 style="font-family:Bradley Hand, cursive;">SPEED Forum</h1>
	<h1 style="font-family:Bradley Hand, cursive">&</h1>
	<h1 style="font-family:Bradley Hand, cursive">Subject Guide</h1>
	</div>
</div>
<div class="parallax parallaxBooks text-center splitHeading">
	<h2>SUBJECTIVE</h2>
</div>
<div class="myStyleContainer">
	<div class="row">
		<div class="col-md-5 card subjectiveCard" style="padding:0px;">
			<div class="card-header subjectiveHead">
				<h2>IDEA</h2>
			</div>
			<div class="card-body" style="padding-top:15%;">
				<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
				<p style="font-family:Lucida Console"> 
					providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
				</p>
			</div>
		</div>
		<div class="col-md-7">
			<div class="row">
				<div class="card col-md-6 subjectiveCard" style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">CONFESSING?</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>					
				</div>
				<div class="card col-md-6 subjectiveCard" style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">KNOW THE COURSE DEEPLY?</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 card subjectiveCard"  style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">FIND COURSE</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>
				</div>
				<div class="col-md-4 card subjectiveCard"  style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">READ REVIEWS</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>
				</div>
				<div class="col-md-4 card subjectiveCard"  style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">ADD COMMENTS</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 card subjectiveCard" style="padding:0px;">
					<div class="card-header subjectiveHead">
						<h5 class="text-center">DISCUSS WITH SCHOOL MATES</h5>
					</div>
					<div class="card-body">
						<h4 class="text-center" style="font-family:Lucida Console"><i>SHARING SCHOOL LIFE</i></h4>
						<p style="font-family:Lucida Console"> 
							providing a platform for SPEED's STUDENT to sharing their SCHOOL LIFE and Course review
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="parallax parallaxMain text-center splitHeading">
	<h2>SPEED FORUM</h2>
</div>
<!--
<?php
	$getPostInfo = new SQLQuery();
	$endofRows=7;
	$categories=-1;
	$popularPost=$getPostInfo->searchPopularPost(true, 0, $endofRows);
	$i;
	echo "<div class='container' style='padding-bottom:25px'>";
		echo "<div class='row'>";
			echo "<div class='col-md-6'>";
				echo "<div class='card'>";
					echo "<div class='card-header'>";
						echo "Most Likes";
					echo "</div>";
					echo "<div class='card-body'>";
					echo "asdfasdf";
					echo "</div>";
					echo "<div class='card-footer'>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
			echo "<div class='col-md-6'>";
				echo "<div class='card'>";
					echo "<div class='card-header'>";
						echo "Most Views";
					echo "</div>";
					echo "<div class='card-body'>";
						echo "<table class='col-md-12'>";
							echo "<tr>";
								echo "<td>Subject</td>";
								echo "<td class='text-center'>Categories</td>";
								echo "<td class='text-center'>User</td>";
								echo "<td class='text-center'>Visits</td>";
							echo "</tr>";
							for($i=0;$i<sizeof($popularPost);$i++){
							echo "<tr>"; 
								echo "<td><a href='postView.php?post=$i'>".$popularPost[$i]['post_title']."</a></td>";
								echo "<td class='text-center'><a href='postView.php?post=$i'>".$popularPost[$i]['catname']."</a></td>";
								echo "<td class='text-center'><a href='postView.php?post=$i'>".$popularPost[$i]['username']."</a></td>";
								echo "<td class='text-center'><a href='postView.php?post=$i'>".$popularPost[$i]['post_numberOfvisits']."</a></td>";
							echo "</tr>";	
							}
						echo "</table>";
					echo "</div>";
					echo "<div class='card-footer'>";
					echo "</div>";
				echo "</div>";
			echo "</div>";			
		echo "</div>";
	echo "</div>";
?>
-->
<div class="parallax parallaxBooks">
	<blockquote class="blockquote text-center">
		<p style="color: white;text-shadow: 2px 2px 4px #000000;" class="mb-0">SOME ENCOURAGING WORDS Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
		<footer style="color:white;text-shadow: 1px 1px 2px #000000;" class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
	</blockquote>
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