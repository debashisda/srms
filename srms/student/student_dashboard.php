<?php 
session_start();
error_reporting(0);
if(!($_SESSION['state']))
{
	header('location:../index.php');
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
	<link rel="stylesheet" href="../common/tablecss.css">
</head>
<body>

<?php

	echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>"
	."<tr><th colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>"
	."<tr><td width='50%'>NAME: ".$_SESSION['name']."</td><td>ROLL NO: ".$_SESSION['roll']."</td></tr>"
	."<tr><td>COURSE: ".strtoupper($_SESSION['course'])."</td><td>CURRENT SEMESTER: ".($_SESSION['RESULT_COUNT'] + 1)
	."</td></tr></tr></table><br>";

	echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
	<tr><th>Semester</th><th>Result</th></tr>";

	$rc=0;	    	
	for($i=1;$i<count($row);$i++)
	{
		if($row['sem'.$i]!=NULL)
		{
	 		echo "<tr>
				<td>Semester ".$i."</td>
				<td><a href='generate_result.php?sem=".$i."'><button>View Result</button></a></td>
			  </tr>";
			$rc++;
		}    			
	}

	$_SESSION['RESULT_COUNT'] = $rc;
?>
	</table>
</body>
</html>
