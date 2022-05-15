<?php 
error_reporting(0);
session_start();
if(!($_SESSION['state1'])) header('location:../logout.php');
if($_GET['roll'] == NULL) header('location:dashboard.php');
include_once("../common/super_common.php");
$nm=mysqli_fetch_assoc(mysqli_query($con,"SELECT name from stu_details WHERE roll=".$_GET['roll']))['name'];
if(strlen($nm)<1) header('location:dashboard.php');	
$res=mysqli_query($con,"desc ".$_SESSION['ca']);
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<title>SRMS</title>
</head>
<body class="d-flex flex-column h-100">
	<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-light border-bottom">
			<h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
			<nav class="my-2 my-md-0">   
				<a href="dashboard.php" class="btn btn-secondary btn-sm">Dashboard</a>		    			
				<a href="account.php" class="btn btn-primary btn-sm">Account</a>
				<a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
			</nav>  
		</div>
	</header>
	<div class="container">	
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>					
					<tr><th class="u-data">NAME: <?php echo $nm; ?></th><th class="u-data">ROLL NO: <?php echo $_GET['roll']; ?></th>		
					<th class="u-data">COURSE: <?php echo strtoupper($_SESSION['ca']); ?></th></tr>
				</tbody>
			</table>
		</div>
		<div class="table-responsive">			
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"><tr><th>SL No.</th><th>Semester</th><th>Result</th></tr></thead>
				<tbody>	
				<?php						
					$i=1;					
					while($row=mysqli_fetch_array($res))
					{
						if($row['Field'] == 'roll') continue;
						else
						{
							echo "<tr>
									<td class='u-data'>".$i."</td>
									<td class='u-data'>Semester ".$i."</td>
									<td class='u-data'><a href='result.php?roll=".$_GET['roll']."&sem=".$i."' class='btn btn-info btn-sm'>Update Result</a></td>
								</tr>";
							$_SESSION['semcount']=$i;
						}
						$i++;
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