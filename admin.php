<?php
	session_start();
	include 'php/sqlQuery.php';
	$authorized = false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']==1){
		$authorized = true;
	} 
	if($authorized){
		$admin = new admin();
		$userList = $admin->userList();
		$postList = $admin->postList();
		$repliesList = $admin->repliesList();
		$subjectList = $admin->subjectList();
		$commentList = $admin->commentList();
		$likeList = $admin->likeList();
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<link rel="stylesheet" href="css\commonCSS.css">
<link rel="stylesheet" href="css\animation.css">
<link rel="stylesheet" href="css\adminStyle.css">
<style>
.navbar a:link{
	text-decoration:none;
	color:white;
}
.navbar a:visited{
	text-decoration:none;
	color:white;
}
body {
    font-family: "Lato", sans-serif;
    transition: background-color .5s;
    background-color: #EFEFEF;
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
.numberTitle{
	font-size:15px;
	font-weight:;
}
.table-hover:hover{
	cursor: pointer;
}
</style>	
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div id='mySidenav' class='sidenav'>
	<a id='closeNav' href="javascript:void(0)" class="closebtn" onclick="closeNav();">&times;</a>
	<a href='admin.php'>Home DashBoard</a>
	<a href='admin/userEdit.php'>User</a>
	<a href='admin/multiEdit.php'>Edit DashBoard</a>
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
				}
			?>
		</div>		
	</div>		
</nav>
<?php

?>
<div id='numericStat' class='col-md-12'>
	<div class='row'>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Users</h6>
			<div class='count'><?php echo sizeof($userList); ?></div>
			<div class='countBottom'>Latest Registered User: 
				<?php
					$latestUser=0;
					$datetime=0;
					for($i=0; $i<sizeof($userList); $i++){
						if($userList[$i]['user_datatime']>$datetime){
							$latestUser = $i;
							$datetime = $userList[$i]['user_datatime'];
						}
					}
					echo "<var class='countBottomVar'>".$userList[$latestUser]['username']."</var>";
					echo "</br>Registered on: <var class='countBottomVar'>" . $datetime . "</var>";
				?>
			</div>
		</div>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Post</h6>
			<div class='count'><?php echo sizeof($postList); ?></div>
			<div class='countBottom'>Latest Post: 
				<?php
					$latestPost=0;
					$datetime=0;
					for($i=0; $i<sizeof($postList); $i++){
						if($postList[$i]['post_datetime'] > $datetime){
							$latestPost = $i;
							$datetime = $postList[$i]['post_datetime'];
						}
					}
					echo "<var class='countBottomVar'>".$postList[$latestPost]['post_title']."</var>";
					echo "</br>Registered on: <var class='countBottomVar'>" . $datetime . "</var>";
				?>
			</div>			
		</div>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Visit</h6>
			<div class='count'>
				<?php
					$counter=0;
					for($i=0; $i<sizeof($postList); $i++)
						$counter+=$postList[$i]['post_numberOfvisits'];
					echo $counter;
				?>
			</div>
		</div>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Replies</h6>
			<div class='count'>
				<?php
					echo sizeof($repliesList);
				?>
			</div>
			<div class='countBottom'>Latest Reply: 
				<?php
					$latestReplies=0;
					$datetime=0;
					for($i=0; $i<sizeof($repliesList); $i++){
						if($repliesList[$i]['replies_datetime'] > $datetime){
							$latestReplies = $i;
							$datetime = $repliesList[$i]['replies_datetime'];
						}
					}
					echo "<var class='countBottomVar'>".$repliesList[$latestReplies]['username']."</var>";
					echo "</br>Reply: <var class='countBottomVar'>" . $repliesList[$latestReplies]['post_title'] . "</var>";
					echo "</br>Registered on: <var class='countBottomVar'>" . $datetime . "</var>";
				?>
			</div>			
		</div>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Subject</h6>
			<div class='count'><?php echo sizeof($subjectList) ?></div>
		</div>
		<div class='col-lg-2 col-xs-6 statCard'>
			<i></i><h6 class='topStatTitle'>Comments</h6>
			<div class='count'><?php echo sizeof($commentList); ?></div>
			<div class='countBottom'>Latest: 
				<?php
					$latestComment=0;
					$datetime=0;
					for($i=0; $i<sizeof($commentList); $i++){
						if($commentList[$i]['comment_datetime'] > $datetime){
							$latestComment = $i;
							$datetime = $commentList[$i]['comment_datetime'];
						}
					}
					echo "<var class='countBottomVar'>".$commentList[$latestComment]['subject_name']."</var>";
					echo "</br>Commented on: <var class='countBottomVar'>" . $datetime . "</var>";
				?>
			</div>	
		</div>
	</div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div class='row'>
	<div id="container" class='col-lg-6'></div>
	<div id="container2" class='col-lg-6'></div>
</div>
<div class='row' style='padding: 5px;'>
	<div class='col-lg-4 lg4Card'>
		<div class='lg4Content'>
			<div class='cardHeader'>
				User
				<span id="userTable" data-toggle="tooltip" 
				data-replacement="top" title="more" class='headerTool'><i class="fas fa-wrench"></i></span>
			</div>
			<div class='cardBody table-responsive'>
				<table class='table table-striped table-hover'>
				<thead class='thead-light'>
					<tr>
						<th scope='col'>uid</th>
						<th scope='col'>Username</th>
						<th scope='col'>gender</th>
						<th scope='col'>Create date</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i=0; $i<sizeof($userList); $i++){
						$idname = "uid". $userList[$i]['uid'];
						echo "<tr class='footerPrint' id=\"$idname\">";
							echo "<th scope='row'>". $userList[$i]['uid'] ."</th>";
							echo "<th>". $userList[$i]['username'] ."</th>";
							echo "<th>" . $userList[$i]['sex'] . "</th>";
							echo "<th>" . $userList[$i]['user_datatime'] . "</th>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<div class='col-lg-4 lg4Card'>
		<div class='lg4Content'>
			<div class='cardHeader'>
				Subject
				<span id="subjectTable" data-toggle="tooltip" 
				data-replacement="top" title="more" class='headerTool'><i class="fas fa-wrench"></i></span>
			</div>
			<div class='cardBody table-responsive'>
				<table class='table table-striped table-hover'>
				<thead class='thead-light'>
					<tr>
						<th scope='col'>Code</th>
						<th scope='col'>Title</th>
						<th scope='col'>LeveL</th>
						<th scope='col'>Language</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i=0; $i<sizeof($subjectList); $i++){
						$idname = "sid". $subjectList[$i]['sid'];
						echo "<tr class='footerPrint' id=\"$idname\">";
							echo "<th scope='row'>". $subjectList[$i]['subject_code'] ."</th>";
							echo "<th scope='row'>". $subjectList[$i]['subject_name'] ."</th>";
							echo "<th>". $subjectList[$i]['subject_level'] ."</th>";
							echo "<th>" . $subjectList[$i]['subject_language'] . "</th>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
			</div>
		</div>		
	</div>
	<div class='col-lg-4 lg4Card'>
		<div class='lg4Content'>
			<div class='cardHeader'>
				Post
				<span id="postTable" data-toggle="tooltip" 
				data-replacement="top" title="more" class='headerTool'><i class="fas fa-wrench"></i></span>
			</div>
			<div class='cardBody table-responsive'>
				<table class='table table-striped table-hover'>
				<thead class='thead-light'>
					<tr>
						<th scope='col'>Id</th>
						<th scope='col'>Title</th>
						<th scope='col'>Category</th>
						<th scope='col'>User</th>
						<th scope='col'>Visits</th>
					</tr>
				</thead>
				<tbody>
				<?php

					for($i=0; $i<sizeof($postList); $i++){
						$idname = "pid". $postList[$i]['pid'];
						echo "<tr class='footerPrint' id=\"$idname\">";
							echo "<th scope='row'>". $postList[$i]['pid'] ."</th>";
							echo "<th scope='row'>". $postList[$i]['post_title'] ."</th>";
							echo "<th>". $postList[$i]['catname'] ."</th>";
							echo "<th>" . $postList[$i]['username'] . "</th>";
							echo "<th>" . $postList[$i]['post_numberOfvisits'] . "</th>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
			</div>
		</div>			
	</div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
	<div class='modal-dialog modal-dialog-centered myModalSize' role="document">
		<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='detailModalTitle'></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
				</button>	
			</div>	
			<div class="modal-body" id="returnModal" style='overflow-y: scroll; max-height:700px;'>

			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

	$('[data-toggle="tooltip"]').tooltip(); 


	$(".headerTool").each(function(){
		$(this).on("click", function(){
			$("#detailModal").modal("show");
			var target = $(this).attr("id");
			target = target.substring(0, target.search("Table"));
			$("#detailModalTitle").text(target);
			$.post("adminDetail.php",{
				target: target
			}, function(result){
				$("#returnModal").html(result);
			});
		});
	});
});
</script>
<script>
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



var myChart = Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Visiting Number'
    },
    subtitle: {
        text: 'SPEED FORUM'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Number'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
    	name: 'Replies'
    }, {
    	name: 'Post'
    }]
});

var myChart2 = Highcharts.chart('container2', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Monthly Written Comment Number'
    },
    subtitle: {
        text: 'SUBJECT COMMENT'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Number'
        },
        labels: {
            formatter: function () {
                return this.value ;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Written Comments',
        marker: {
            symbol: 'square'
        }

    }]
});
$(document).ready(function(){
	var post = <?php echo json_encode($postList); ?>;
	var replies = <?php echo json_encode($repliesList); ?>;
	var comments = <?php echo json_encode($commentList); ?>;
	var year = (new Date).getFullYear();
	var month = (new Date).getMonth();
	month = month + 1;
	var postData = [];
	var repliesData = [];
	var commentData = [];
	for(var i=0; i<month; i++) {
		postData[i]=0;
		repliesData[i]=0;
		commentData[i]=0;
	}
	for(var i=0; i<post.length; i++){
		var str = post[i]['post_datetime'].split("-");
		switch(str[1]){
			case "01": postData[0]++; break;
			case "02": postData[1]++; break;
			case "03": postData[2]++; break;
			case "04": postData[3]++; break;
			case "05": postData[4]++; break;
			case "06": postData[5]++; break;
			case "07": postData[6]++; break;
			case "08": postData[7]++; break;
			case "09": postData[8]++; break;
			case "10": postData[9]++; break;
			case "11": postData[10]++; break;
			case "12": postData[11]++; break;
		}
	}
	for(var i=0; i<replies.length; i++){
		var str = replies[i]['replies_datetime'].split("-");
		switch(str[1]){
			case "01": repliesData[0]++; break;
			case "02": repliesData[1]++; break;
			case "03": repliesData[2]++; break;
			case "04": repliesData[3]++; break;
			case "05": repliesData[4]++; break;
			case "06": repliesData[5]++; break;
			case "07": repliesData[6]++; break;
			case "08": repliesData[7]++; break;
			case "09": repliesData[8]++; break;
			case "10": repliesData[9]++; break;
			case "11": repliesData[10]++; break;
			case "12": repliesData[11]++; break;
		}	
	}
	for(var i=0; i<comments.length; i++){
		var str = comments[i]['comment_datetime'].split("-");
		switch(str[1]){
			case "01": commentData[0]++; break;
			case "02": commentData[1]++; break;
			case "03": commentData[2]++; break;
			case "04": commentData[3]++; break;
			case "05": commentData[4]++; break;
			case "06": commentData[5]++; break;
			case "07": commentData[6]++; break;
			case "08": commentData[7]++; break;
			case "09": commentData[8]++; break;
			case "10": commentData[9]++; break;
			case "11": commentData[10]++; break;
			case "12": commentData[11]++; break;
		}	
	}	
	myChart.series[1].setData(postData);
	myChart.series[0].setData(repliesData);
	myChart2.series[0].setData(commentData);
});
</script>
</body>
</html>