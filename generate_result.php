<html>
<head>
	<title>Create Result</title>
</head>
<body>
	<?php

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

	function generate_student_details()
	{
		echo "<table border='2' cellspacing='3' cellpadding='5' width='900' align='center'>";
		echo "<tr><th colspan='2'>MAULANA ABUL KALAM AZAD UNIVERSITY OF TECHNOLOGY</th></tr>";
		echo "<td width='50%'>NAME: </td><td>ROLL NO: </td></tr>";
		echo "<tr><td colspan='2'>COURSE: </td></tr>";
		echo "<tr><td colspan='2'>COLLEGE: </td></tr>";
		echo "</table><br>";
	}

	function generate_marks($sem, $course, $roll)
    {
    	$con=mysqli_connect('127.0.0.1','root','','srms');	
		$query="select ".$sem." from ".$course." where roll=".$roll;			
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_assoc($result);
		$a=explode('|',$row[$sem]);
		$credit = 0;
		$credit_points = 0;
		echo "<table border='2' cellspacing='3' cellpadding='5' width='900' align='center'>";
		echo "<tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr>";
		for ($i=0;$i<count($a);$i++) 
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
		echo "<tr><td></td><td></td><td></td><th>Total</th><td>".$credit."</td><td>".$credit_points."</td></tr>";
		echo "</table><br>";

		$sgpa=round($credit_points/$credit,2);
		$rr=generate_pass_fail($sgpa);
		echo "<table border='2' cellspacing='3' cellpadding='5' width='900' align='center'>";
		echo "<tr><td width='50%'>SGPA: ".$sgpa."</td><td></td></tr>";
		echo "<tr><td width='50%'>Result: ".$rr."</td><td></td></tr>";
		echo "<tr><td colspan='2'>YGPA: </td></tr>";
		echo "</table>";
		mysqli_close($con);
	}

	generate_student_details();
	generate_marks('sem1','bca_marks',14901219028);

	?>
</body>
</html>
