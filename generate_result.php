<!DOCTYPE html>
<html>
<head>
	<title>Create Result</title>
</head>
<body>
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

	function generate_result($sem, $course, $roll)
    {
    	$con=mysqli_connect('127.0.0.1','root','','srms');
		$query="select ".$sem." from ".$course." where roll=".$roll;		
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_assoc($result);
		$a=explode('|',$row[$sem]);
		$credit = 0;
		$credit_points = 0;
		echo "<table border='2' cellspacing='3' cellpadding='5'>";
		echo "<tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr>";
		for ($i=0; $i < count($a) ; $i++) 
		{		
			$b=explode(':',$a[$i]);	
			$sub = mysqli_query($con,"select sub_name from subjects where sub_code='$b[0]'");
			$subn = mysqli_fetch_assoc($sub);
			$num_marks = grade_to_marks($b[1]);		
			echo "<tr><td>",$b[0],"</td>
				  	<td>",$subn['sub_name'],"</td>
				  	<td>",$b[1],"</td>
				  	<td>",$num_marks,"</td>
				  	<td>",$b[2],"</td>
				  	<td>",$num_marks*$b[2],"</td></tr>";
			$credit+=$b[2];
			$credit_points+=($num_marks*$b[2]);
		}
		echo "</table>";
		echo "SGPA: ",round($credit_points/$credit,2);
	}

	?>
</body>
</html>