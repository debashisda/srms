<?php 
error_reporting(0);
session_start();
if(!($_SESSION['state1'])) header('location:../logout.php');

include_once("../common/super_common.php");
extract($_POST);
if(isset($upd_pass))
{
	$cur_pass1 = mysqli_fetch_assoc(mysqli_query($con,'select password from tch_details where id='.$_SESSION['id']))['password'];	
	if($cur_pass == $cur_pass1)
	{
		mysqli_query($con,"update tch_details set password='".$new_pass."' where id=".$_SESSION['id']);
		$msg = "<div class='alert alert-success'style='text-align:left;'>Password Updated</div>";
	}	
	else
	{
		$msg = "<div class='alert alert-danger' style='text-align:left;'>Incorrect Password</div>";
	}
}
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
			<style>.nav{min-width: 270px !important;}</style>
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
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  	<h1 class="h4">Account</h1>
               	</div>					
				<div class="card mb-4">
					<div class="card-header text-white bg-dark">
						<strong>Account Details</strong>
					</div>
					<div class="card-body">
						<style>.form-control[readonly]{background-color: #f4f4f4; opacity: 1;</style>			
						<div class="row gx-3 mb-3">
							<div class="col-md-4">
								<label class="small mb-1" for="usr_name"><strong>Name</strong></label>
								<input class="form-control" id="usr_name" type="text" value='<?php echo $_SESSION['name'];?>' readonly>
							</div>
							<div class="col-md-4">
								<label class="small mb-1" for="course"><strong>Managing Course</strong></label>
								<input class="form-control" id="course" type="text" value='<?php echo strtoupper($_SESSION['ca']);?>' readonly>
							</div>										
							<div class="col-md-4">
								<label class="small mb-1" for="email"><strong>Email address</strong></label>
								<input class="form-control" id="email" type="email" value='<?php echo $_SESSION['email'];?>' readonly>
							</div>
						</div>				
					</div>
				</div>				
				<div class="card mb-4">					
					<div class="card-header text-white bg-dark">
						<strong>Change Password</strong>
					</div>
					<div class="card-body">
						<form method="post">
							<?php if(isset($msg)) echo $msg;?>
							<div class="row gx-3 mb-3">								
								<div class="col-md-6">
									<label class="small mb-1" for="cur_pass"><strong>Current password<span class="text-danger">*</span></strong></label>
									<input class="form-control" id="cur_pass" name="cur_pass" type="password" required>
								</div>
								<div class="col-md-6">
									<label class="small mb-1" for="new_pass"><strong>New password<span class="text-danger">*</span></strong></label>
									<input class="form-control" id="new_pass" name="new_pass" type="password" required>
								</div>
							</div>					
							<button class="btn btn-secondary float-right" type="submit" name="upd_pass">Update Password</button>
						</form>
					</div>
				</div>
			</main>
		<div>
	</div>
   </div>
</div>
	<script>document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>
	<?php include('../common/footer.php'); ?>	
</body>
</html>