<?php 
	//error_reporting(0);
	if($_GET['roll'] == NULL)
	{
		header('location:dashboard.php');
	}
	$roll = $_GET['roll'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teachers Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style>tr{ text-align:center;}td{border: 1px solid black !important;}</style>	
</head>
<body>
	<?php include_once("nav.php"); ?>	
	<!-- Table and it's body -->
	<div class="container" style="max-width: 100% !important;">
		<div class="table-responsive">			
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"> 
		    		<tr><th>SL No.</th><th>Semester</th><th>Result</th></tr>
		    	</thead>
				<tbody>	
				<?php
					include_once("../common/super_common.php");
					$res=mysqli_query($con,"desc bca");	
					$i=1;
					while($row=mysqli_fetch_assoc($res))
					{
						if($row['Field'] == 'roll')
							continue;
						else
						{
							echo "<tr>
									<td>".$i."</td>
									<td>Semester ".$i."</td>
									<td><a href='update_common.php?roll=".$roll."&sem=".$i."' class='btn btn-info btn-sm'>Update Result</a></td>
								</tr>";
						}
						$i++;
					}		
				?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="../js/backhref.js"></script>
</body>
</html>