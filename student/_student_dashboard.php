<?php 
session_start();
error_reporting(0);
if(!($_SESSION['state']))
{	
	header('location:../logout.php');
}

include_once("../common/super_common.php");

$roll = $_SESSION['roll'];
$regno = $_SESSION['regno'];
$course = $_SESSION['course'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];

//selecting number of result published
$res = mysqli_query($con,"select * from ".$course." where roll=".$roll);
$row = mysqli_fetch_assoc($res);
mysqli_close($con);
?>

<html>
<head>	
	<title>Student Dashboard</title>
	<!--link rel="stylesheet" href="../common/tablecss.css"-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style type="text/css">

		body{
			padding: 10px;
		}
		table{
			margin-top: 20px;
			border-collapse: unset;
		}

		.bg-light {
    	background-color: #c7c7c7!important;
	}
	</style>

</head>
<body>
<div class="my-div">
<?php

	include_once("../common/nav-bar.php");

	echo "
	<table class='table'>
	<thead class='thead-light'>
		<tr><th>Semester</th><th>Result</th></tr>
	</thead>
	<tbody>";

	    	
	for($i=1;$i<count($row);$i++)
	{
		if($row['sem'.$i]!=NULL)
		{
	 		echo "
	 		<tr>
	 			<td>".$i."</td>
				<td>Semester ".$i."</td>
				<td><a href='generate_result.php?sem=".$i."' class='btn btn-info btn-sm'>Result</button></a></td>
			 </tr>";	
		}    			
	}
	echo "</table></div>";
?>
	</table></div>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
