<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teachers Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<style></style>	
</head>
<body>
	<?php include_once("nav.php"); ?>
	<div class="alert alert-info"><strong>Welcome <?php //echo $_SESSION['name']; ?></strong></div>
	<div class="container">
		<div class="table-responsive">			
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"> 
		    		<tr><th>Student ID</th><th>Student Name</th><th>Manage Result</th></tr>
		    	</thead>
				<tbody>
				<?php
					include_once("../common/super_common.php");								
					$result = mysqli_query($con,"select * from stu_details");
					mysqli_close($con);					
					while($row=mysqli_fetch_assoc($result)) 
					{
						echo "<tr>
							<td>".$row['roll']."</td>
							<td>".$row['name']."</td>				
							<td><a href='moredetails.php?roll=".$row['roll']."' class='btn btn-info btn-sm'>Update Result</a></td>
						</tr>";			
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="../js/backhref.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>	
</body>
</html>