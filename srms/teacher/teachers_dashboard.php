<html>
<head>
	<title>Teachers Dashboard</title>
	<link rel="stylesheet" href="tablecss.css">
</head> 
<body>	
	<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
		<thead><tr><th>Student ID</th><th>Student Name</th><th>Manage Result</th></tr></thead>		
		<?php
			$con=mysqli_connect('127.0.0.1','root','','srms');
			$result=mysqli_query($con,"select * from stu_details");		
			while($row=mysqli_fetch_assoc($result)) 
			{
				$result_status="Not Published";
				echo "<tr>
						<td>".$row['roll']."</td>
						<td>".$row['name']."</td>				
						<td><a href='teachers_dashboard_moredetails.php?roll=".$row['roll']."'>Update Result</a></td>
					</tr>";			
			}
		?>
	</table>
</body>
</html>