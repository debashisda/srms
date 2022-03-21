<?php

	/* NOTE: Below function is highly critical, handle with care */
	function generate_stu_result($con,$roll,$sem)
	{
		$credit = 0;
		$credit_points = 0;
		$stu_result = mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from ".$_SESSION['course']." where roll=".$roll));
		$a=explode('|',$stu_result['sem'.$sem]);
		for($i=0;$i<count($a);$i++) 
		{		
			$b=explode(':',$a[$i]);
			$sub_name = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='".$b[0]."'"));
			$num_marks = grade_to_marks($b[1]);
			echo "<tr><td>".$b[0]."</td><td>".$sub_name['sub_name']."</td><td>".$b[1]."</td><td>".$num_marks."</td><td>".$b[2]."</td><td>".$num_marks*$b[2]."</td></tr>";			
			$credit+=$b[2];
			$credit_points+=($num_marks*$b[2]);
		}
		echo "<tr><td></td><td></td><td></td><td>Total</td><td>".$credit."</td><td>".$credit_points."</td></tr>";
		echo "</table><br/>";

		return round($credit_points/$credit,2);
	}

	function generate_pass_fail($sgpa)
	{
		if($sgpa >= 5.6) return "Pass";
		else return "Fail";
	}
	
	function grade_to_marks($al_m)
	{
		if($al_m == 'O') return 10;
		elseif ($al_m == 'E') return 9;
		elseif ($al_m == 'A') return 8;		
		elseif ($al_m == 'B') return 7;
		elseif ($al_m == 'C') return 6;
		elseif ($al_m == 'D') return 5;
		else return 4;		
	}

?>
<html>
<head>
	<title>Student Result</title>
	<link rel="stylesheet" href="../common/tablecss.css">
</head>
<body>
<?php
	session_start();
	if(!($_SESSION['state']))
	{
		header('location:../index.php');
	}

	$roll = $_SESSION['roll'];
	$sem = $_GET['sem'];
		
	if(!isset($sem) || ($sem > $_SESSION['RESULT_COUNT'] || $sem<=0))
	{
		header('location:student_dashboard.php');
	}
	
	include_once("../common/super_common.php");
	include_once("../common/common_file.php");

	echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
		  <tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr>";
	$sgpa = generate_stu_result($con,$roll,$sem);

	echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
			<tr><td width='50%'>SGPA: </td><td>".$sgpa."</td></tr>
		    <tr><td>Result: </td><td>".generate_pass_fail($sgpa)."</td></tr>
		  </table><br/>";

	mysqli_close($con);	
?>
</body>
</html>
