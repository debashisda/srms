<?php 
error_reporting(0);
session_start();
if(!($_SESSION['state'])) header('location:../logout.php');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/student.css">	
</head>
<body class="d-flex flex-column h-100"> 
	<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-light border-bottom">
	  <h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
	  <nav class="my-2 my-md-0">	    	
			<a href='account.php' class='btn btn-primary btn-sm'>Account</a>	
			<a href='../logout.php' class='btn btn-danger btn-sm'>Logout</a>
	  </nav>  
	</div>
	<div class="container" style="max-width: 100% !important;">
		<div class="alert alert-info"><strong><?php echo $_SESSION['name']; ?></strong></div>
		<div class="table-responsive">
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"><tr><th class="th-sm" width='50%'>Semester</th><th class="th-sm">Result</th></tr></thead>
				<tbody>
				<?php
				include_once("../common/super_common.php");								
				$row = mysqli_fetch_assoc(mysqli_query($con,"select * from ".$_SESSION['course']." where roll=".$_SESSION['roll']));
				mysqli_close($con);			
				for($i=1; $i<count($row); $i++)
				{
					if($row['sem'.$i] !== NULL)
					{
	 					echo "<tr><td>Semester ".$i."</td><td><a href='result.php?sem=".$i."' class='btn btn-info btn-sm'>Result</a></td></tr>";
			 			$_SESSION['RESULT_COUNT'] = $i;
					}							  			
				}													 				
				?>
				</tbody>
			</table>
		</div>
	</div>

	<?php include('../common/footer.php'); ?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>	
</body>
</html>