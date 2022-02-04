<?php
	//after adding login system roll will be fetched from SESSION
	$roll=14901219028;
?>
<html>
<head>	
	<title>Student Dashboard</title>
	<link rel="stylesheet" href="../common/tablecss.css">
</head>
<body>
	<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
	<tr><th>Semester</th><th>Result</th></tr>
	<?php
		session_start();
		$_SESSION['ROLL']=$roll;
		//contains database connectivity
		include_once("../common/super_common.php");

		//selecting student course from roll
		$res1 = mysqli_query($con,"select * from stu_details where roll=".$roll);
	    	$row1 = mysqli_fetch_assoc($res1);

	    	//selecting number of result published
	    	$res2 = mysqli_query($con,"select * from ".$row1['course']." where roll=".$roll);
	    	$row2 = mysqli_fetch_assoc($res2);

	    	$rc=0;
	    	for($i=1;$i<count($row2);$i++)
	    	{
	    		if($row2['sem'.$i]!=NULL)
	    		{	
					echo "<tr>
							<td>Semester ".$i."</td>
							<td><a href='generate_result.php?sem=".$i."'><button>View Result</button></a></td>
						  </tr>";
					$rc++;
	    		}    			
	    	}
	    	mysqli_close($con);	    	
	    	$_SESSION['RESULT_COUNT']=$rc;
	?>
</table>
</body>
</html>
