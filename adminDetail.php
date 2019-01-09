<html>
<head>
<style>
i{
	margin-right: 5px;
}
i:hover{
	cursor: pointer;
	opacity: 0.7;
	filter: blur(1px);
}
</style>
</head>
<body>
<?php
	include 'php/sqlQuery.php';
	$ad = new admin();
	$detailArray=array();
	switch($_POST['target']){
		case "user": 
			$detailArray = $ad->userList();
		break;
		case "subject": 
			$detailArray = $ad->subjectList();
		break;
		case "post": 
			$detailArray = $ad->postList();
		break;
	}
	echo "<table class='myEditable table table-striped table-dark'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th scope='col'>#Tools</th>";
				foreach($detailArray[0] as $key=>$value){
					echo "<th scope='col'>". $key ."</th>";
				}
			echo "</tr>";
			for($i=0; $i<sizeof($detailArray); $i++){
				$idrow = $_POST['target'].$i;
				echo "<tr>";
				echo "<td id=\"$idrow\"></td>";
				foreach($detailArray[$i] as $key=>$value){
					echo "<td>".$value."</td>";
				}
				echo "</tr>";
			}
		echo "</thead>";
	echo "</table>";
?>
<script>
</script>
</body>
</html>