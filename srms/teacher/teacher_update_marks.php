<html>
<head>
	<title>Student Result</title>
	<link rel="stylesheet" href="tablecss.css">
</head>
<body>
	<form method='post'>
	<table border='2' cellspacing='2' cellpadding='3' align='center' width='1000px'>
	<tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Credit</th></tr>
	<?php
		$roll = $_GET['roll'];
		$sem = $_GET['sem'];     
	     
	    //update result    
	    $con=mysqli_connect('127.0.0.1','root','','srms');
		$query="select sem".$sem." from bca_marks where roll=".$roll;					
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_assoc($result);
		if($row['sem'.$sem] == NULL)
		{
			header("location:teacher_insert_marks.php?roll=".$roll."&sem=".$sem);
		}	
		$a=explode('|',$row['sem'.$sem]);
		for($i=0;$i<count($a);$i++) 
		{		
			$b=explode(':',$a[$i]);	
			$sub = mysqli_query($con,"select sub_name from subjects where sub_code='$b[0]'");
			$subn = mysqli_fetch_assoc($sub);			
			echo "<tr>
						<td><input type='text' name='".$b[0]."' value='".$b[0]."' readonly></td>
						<td>".$subn['sub_name']."</td>
						<td><input type='text' name='".$b[0].'A'."' value='".$b[1]."'></td>
						<td><input type='number' name='".$b[0].'B'."' value='".$b[2]."'></td>
				</tr>";
		}
		mysqli_close($con);		
		include_once("common_file1.php");
	?>
	<tr>
		<td colspan='4' align='right'>
			<button type='submit' name='rm_res'>Remove Result</button>
			<button type='submit' name='submit'>Update Result</button>
		</td>
	</tr>
</table>
</form>
	<?php

		if(isset($rm_res))
		{
			$con=mysqli_connect('127.0.0.1','root','','srms');
			$query="update bca_marks set sem".$sem."=NULL where roll=".$roll;
			mysqli_query($con,$query);
			header("location:teachers_dashboard_moredetails.php?roll=".$roll);
			mysqli_close($con);
		}
	?>
</body>
</html>


