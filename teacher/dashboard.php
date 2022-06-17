<?php
error_reporting(0);
session_start();
if(!($_SESSION['state1'])) header('location:../logout.php');
include_once("../common/super_common.php");								
$result = mysqli_query($con,"select * from stu_details where course='".$_SESSION['ca']."'");
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<title>SRMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css"> 
	<link rel="stylesheet" type="text/css" href="../css/admin.css">   
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>
	<div class="container-fluid">
        <div class="row">
        	<style>.nav{min-width:270px !important;}</style>
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
			    <div class="sidebar-sticky pt-2">
			        <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
			            <span><strong>Teachers</strong></span><a class="d-flex align-items-center text-muted" href="account.php"><span data-feather="plus-circle"></span></a>
			        </h5>
			        <ul class="nav flex-column">
			        	<li class="nav-item"><a class="nav-link" id="dashboard" href="dashboard.php"><i class="bi bi-speedometer2"></i> Manage Result</a></li>
			        </ul>			   
			        <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
			            <span><strong> Account </strong></span><a class="d-flex align-items-center text-muted"><span data-feather="plus-circle"></span></a>
			        </h5>
			        <ul class="nav flex-column mb-2">
			            <li class="nav-item"><a class="nav-link" id="account" href="account.php"><i class="bi bi-gear"></i> Account</a></li>
			            <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
			        </ul>
			    </div>
			</nav>
			<script>document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  	<h1 class="h4">Dashboard</h1>
               	</div>
				<div class="row mt-3 pl-3 pr-3 mb-3">	
					<div class="table-responsive pr-2 pt-2">			
		    			<table id="records" class="table table-bordered table-striped table-hover ">
			    			<thead class="thead-dark"><tr><th>Student ID</th><th>Student Name</th><th>Action</th></tr></thead>
							<tbody><?php while($row=mysqli_fetch_assoc($result)){echo "
								<tr>
									<td>".$row['roll']."</td>
									<td>".$row['name']."</td>
									<td><a href='moredetails.php?roll=".$row['roll']."' class='btn btn-info btn-sm'>Update Result</a></td>
								</tr>";}?>

							</tbody>
						</table>
					</div>
				</div>
			</main>
		</div>
	</div>		
	<?php include('../common/footer.php');?>	
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script>$(document).ready(function(){$('#records').DataTable({info:false});$('.dataTables_length')[0].remove();});</script>
</body>
</html>