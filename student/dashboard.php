<?php 
error_reporting(0);
session_start();
if(!($_SESSION['state'])) header('location:../logout.php');
include_once("../common/super_common.php");
$row = mysqli_fetch_assoc(mysqli_query($con,"select * from ".$_SESSION['course']." where roll=".$_SESSION['roll']));
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../css/student.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>Dashboard</title>	
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>	
	
	<div class="container-fluid">
	    <div class="row">
		<?php include_once("sidebar.php");?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">			
			<?php //if(!($_SESSION['wcdm'])){echo 
			//"<div class='alert alert-success mt-3'>Welcome <strong>".$_SESSION['name']."</strong></div>";$_SESSION['wcdm']=true;}?>			
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	            <h1 class="h4">Result</h1>
	        </div>
	        <div class="table-responsive">
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead class="thead-dark"><tr><th class="th-sm" width='50%'>Semester</th><th class="th-sm">Result</th></tr></thead>
						<tbody><?php  for($i=1; $i<count($row); $i++){if($row['sem'.$i] !== NULL){echo "
				 			<tr><td>Semester ".$i."</td><td><a href='result.php?sem=".$i."' class='btn btn-info btn-sm'>Result</a></td></tr>";
						 			$_SESSION['RESULT_COUNT'] = $i;
							}							  			
						}													 				
						?>

					</tbody>
				</table>
			</div>
		   </main>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>
	<script type="text/javascript">document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>			
</body>
</html>