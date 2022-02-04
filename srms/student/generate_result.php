<?php
	
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

	function generate_pass_fail($sgpa)
	{
		if($sgpa >= 5.6) return "Pass";
		else return "Fail";
	}

	function generate_stu_details($con,$roll)
	{
		$stu_detail = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
		echo $stu_detail['name']." ".strtoupper($stu_detail['course'])."<br>";		
	}

	function generate_stu_result($con,$course,$roll,$sem)
	{
		$credit = 0;
		$credit_points = 0;
		$stu_result = mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from ".$course." where roll=".$roll));
		$a=explode('|',$stu_result['sem'.$sem]);
		for($i=0;$i<count($a);$i++) 
		{		
			$b=explode(':',$a[$i]);
			$sub_name = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='".$b[0]."'"));
			$num_marks = grade_to_marks($b[1]);
			echo $b[0]." ".$sub_name['sub_name']." ".$b[1]." ".$num_marks." ".$b[2]." ".$num_marks*$b[2]."<br>";			
			$credit+=$b[2];
			$credit_points+=($num_marks*$b[2]);
		}

		$sgpa = round($credit_points/$credit,2);
		echo $credit." ".$credit_points." ".$sgpa." ".generate_pass_fail($sgpa);
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
	$roll = $_SESSION['ROLL'];
	$sem = $_GET['sem'];
	$course = 'bca';
	if(!isset($sem) || ($sem > $_SESSION['RESULT_COUNT'] || $sem<=0))
	{header('location:student_dashboard.php');}else{

	include_once("../common/super_common.php");
	generate_stu_result($con,$course,$roll,$sem);
	mysqli_close($con);

}?>
</body>
</html>
