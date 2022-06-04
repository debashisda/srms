<?php
error_reporting(0);
session_start();
if(!($_SESSION['state1'])) header('location:../logout.php');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css"> 
	<link rel="stylesheet" type="text/css" href="../css/admin.css">   
    <title>SRMS</title>
	<style type="text/css">thead input{width: 100%;}</style>
	<style type="text/css">#example_wrapper > div:nth-child(1){margin: 5px;}#example_filter > label > input{width: 200px}div.col-md-6:nth-child(1){visibility: hidden;}</style>
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>
	<div class="container-fluid">
        <div class="row">
			<?php include_once("sidebar.php");?>	
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  	<h1 class="h2">Dashboard</h1>
               	</div>
				<div class="row mt-3 pl-3 pr-3">	
					<div class="table-responsive">			
		    			<table id="example" class="table table-bordered table-striped table-hover ">
			    			<thead class="thead-dark"><tr><th>Student ID</th><th>Student Name</th><th>Action</th></tr></thead>
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
			</main>
		</div>
	</div>		
	<?php include('../common/footer.php');?>
	<script type="text/javascript">document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript">$(document).ready(function (){$('#example').DataTable({info:false,stateSave:true,});});</script>
</body>
</html>