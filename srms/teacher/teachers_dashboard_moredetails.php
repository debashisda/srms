<!DOCTYPE html>
<html>
<head>
	<title>Student Result Editing Page</title>
	<link rel="stylesheet" href="tablecss.css">
</head>
<body>	
	
	<?php
		$roll = $_GET['roll'];			
		include_once("common_file.php");
		$query="desc bca_marks";
		$res=mysqli_query($con,$query);
		$i=1;
		echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>
		<tr><td>Semester</td><td>Result</td></tr>";
		while ($row=mysqli_fetch_assoc($res))
		{
			if($row['Field'] == 'roll')
				continue;
			else
			{
				echo "<tr>
							<td>".$row['Field']."</td>
							<td><a href='teacher_update_marks.php?roll=".$roll."&sem=".$i."'>Update Result</a></td>
					</tr>";
			}
			$i++;
		}		
	?>
	</table>
</body>
</html>