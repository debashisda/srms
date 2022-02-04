<html>
<head>
	<title>Student Result</title>
	<link rel="stylesheet" href="tablecss.css">
</head>
<body>
	<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
	<tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit</th></tr>
	<form method='post'>
		<?php 
			$roll = $_GET['roll'];
			$sem = $_GET['sem'];

			//insert marks
		    $con=mysqli_connect('127.0.0.1','root','','srms');
		    $query="select sub_code,sub_name from subjects where course='BCA' and sub_sem=".$sem;
		    $res=mysqli_query($con,$query);       

			while($r=mysqli_fetch_assoc($res))
		    {   
		    	$x=$r['sub_code'];
		    	echo "<tr>
		    			<td><input type='text' name='".$x."' value='".$x."' readonly></td>
		    			<td>".$r['sub_name']."</td>
		    			<td width='150px'><input type='text' name='".$x.'A'."'></td>
		    			<td width='150px'><input type='number' name='".$x.'B'."'></td>
		    		</tr>";  	  	
		    }	
			mysqli_close($con);
			include_once("common_file1.php");
		?>
	<tr><td colspan='4' align='right'><input type='submit' name='submit'></td></tr></form></table>
</body>
</html>


