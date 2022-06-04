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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>SRMS</title>
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>
	<div class="container-fluid">
        <div class="row">
			<?php include_once("sidebar.php");?>	
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  	<h1 class="h2">Dashboard</h1>
                  	<div class="btn-toolbar mb-2 mb-md-0">
			          <div class="btn-group me-2">
			            <a id="back" ><button type="button" class="btn btn-sm btn-outline-secondary">Back</button></a>			           
			          </div>          
        			</div>                  	  
               	</div>
				<div class="row" style="padding-left: 15px;padding-right: 15px;">	
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
</main>
</div>
</div>



	<?php include('../common/footer.php'); ?>
	<script src="../js/backhref.js"></script>
	
</body>
</html>