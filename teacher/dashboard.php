<?php
error_reporting(0);
session_start();
if(!($_SESSION['state1']))
{	
	header('location:../logout.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<title>SRMS</title>	
</head>
<body class="d-flex flex-column h-100">
	<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-light border-bottom">
		  <h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
		  <nav class="my-2 my-md-0">		    				
				<a href="account.php" class="btn btn-primary btn-sm">Account</a>	
				<a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
		  </nav>  
		</div>
	</header>	
	<div class="container">
		<div class="alert alert-info"><strong><?php echo $_SESSION['name']; ?></strong></div>
		<div class="table-responsive">			
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"><tr><th>Student ID</th><th>Student Name</th><th>Manage Result</th></tr></thead>
				<tbody>
				<?php
					include_once("../common/super_common.php");								
					$result = mysqli_query($con,"select * from stu_details where course='".$_SESSION['ca']."'");
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
	<?php include('../common/footer.php'); ?>
	<script src="../js/trestrict.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>