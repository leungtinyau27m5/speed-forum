<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="..\bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="..\css\commonCSS.css">
<link rel="stylesheet" href="..\css\animation.css">
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
						<a class="nav-link" href="">Forum</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Courses
						</a>
						<div id="navbarDropdownShow" class="dropdown-menu" aria-labelledby="navbarDropdown">
							<h5 class="dropdown-header">General</h5>
							<a class="dropdown-item" href="">All Courses</a>
							<a class="dropdown-item" href="">Stream</a>
							<a class="dropdown-item" href="">Statistic</a>
							<div class="dropdown-divider"></div>
							<h5 class="dropdown-header">GUR</h5>
							<a class="dropdown-item" href="">Something else here</a>
						</div>
					</li>					
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
					<a href="#" class="card-header list-group-item list-action" id="headingOne" 
						data-toggle="collapse" data-target="#footerSubjectMenu" 
						aria-expanded="true" aria-controls="footerSubjectMenu">Subject Review
					</a>
					<div id="footerSubjectMenu" class="collapse" aria-labelledby="headingOne" data-parent="accordionOne">
						<div class="card-body" style="background-color:#990000;">
							<div class="list-group">
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
							</div>
						</div>
					</div>
				</div>	
				<div class="card">
						<a href="#" class="card-header list-group-item list-action" id="headingTwo" 
							data-toggle="collapse" data-target="#footerForumMenu" 
							aria-expanded="true" aria-controls="footerForumMenu">Forum
						</a>
					<div id="footerForumMenu" class="collapse" aria-labelledby="headingTwo" data-parent="accordionOne">
						<div class="card-body" style="background-color:#990000;">
							<div class="list-group">
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
							</div>
						</div>
					</div>
				</div>	
				<div class="card">
					<a href="#" class="card-header list-group-item list-action" id="headingTwo" 
						data-toggle="collapse" data-target="#footerAdvancedMenu" 
						aria-expanded="true" aria-controls="footerAdvancedMenu">Advanced
					</a>
					<div id="footerAdvancedMenu" class="collapse" aria-labelledby="headingThree" data-parent="accordionOne">
						<div class="card-body" style="background-color:#990000;">
							<div class="list-group">
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
								<a href="#" class="list-group-item">asdf</a>
							</div>
						</div>
					</div>
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
				<p>
				dafsdfhasdjkfhkaljeklwjfhajklsehfjkalsehfjdkhf
				asdkfjhsdkjfhkjladshfjkadhsjklfhkdjs
				askldjfhklajdshfjkladshjkfhadsl
				ajkfhdlkasjhfjklasdhjfhkadjsl
				asjkdlhfjklasdhfkjlds
				</p>
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
				data-replacement="top" title="Facebook" class="fa" src="..\img\facebook.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Google-Plus" class="fa" src="..\img\google-plus.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Instagram" class="fa" src="..\img\instagram.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Tiwtter" class="fa" src="..\img\twitter.png"></a>
			</li>
			<li class="list-inline-item">
				<a href="#" class=""><img data-toggle="tooltip" 
				data-replacement="top" title="Youtube" class="fa" src="..\img\youtube.png"></a>
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