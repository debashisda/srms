<?php 
//error_reporting(0);
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
		 $msg = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
					Password Updated<button class='close' data-dismiss='alert'>&times;</button>
				 </div>";
	}	
	else
	{
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert' style='text-align:left;'>
					Incorrect Password<button class='close' data-dismiss='alert'>&times;</button>
				</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<title>Account</title>		 
</head>

<body class="d-flex flex-column h-100">
	<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 border-bottom bg-light">
			<h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
			 <nav class="my-2 my-md-0">   
			    <a href='dashboard.php' class='btn btn-secondary btn-sm'>Dashboard</a>				
				<a href='../logout.php' class='btn btn-danger btn-sm'>Logout</a>
			</nav>  
		</div>
	</header>
	<div class="container-xl px-4 mt-4">	
		<div class="row">
			<div class="col-xl-4">
				<div class="card mb-4 mb-xl-0">
					<div class="card-header bg-light">Profile</div>
					<div class="card-body text-center">
						<img class="img-account-profile mb-1" src="" alt="Profile" >
						<div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
						<button class="btn btn-primary" type="file">Upload new image</button>
					</div>
				</div>
			</div>
			<div class="col-xl-8">				
				<div class="card mb-4">
					<div class="card-header bg-light">Account Details</div>
					<div class="card-body">
						<style>.form-control[readonly]{background-color: #f4f4f4; opacity: 1;</style>			
						<div class="row gx-3 mb-3">
							<div class="col-md-6">
								<label class="small mb-1" for="usr_name">Name</label>
								<input class="form-control" id="usr_name" type="text" value='<?php echo $_SESSION['name'];?>' readonly>
							</div>
							<div class="col-md-6">
								<label class="small mb-1" for="course">Course Assigned</label>
								<input class="form-control" id="course" type="text" value='<?php echo strtoupper($_SESSION['ca']);?>' readonly>
							</div>													
						</div>	
						<div class="mb-3">
							<label class="small mb-1" for="email">Email address</label>
							<input class="form-control" id="email" type="email" value='<?php echo $_SESSION['email'];?>' readonly>
						</div>				
					</div>
				</div>
				<?php if(isset($msg)) echo $msg; ?>
				<div class="card mb-4">					
					<div class="card-header bg-light">Change Password</div>
					<div class="card-body">
						<form method="post">		
							<div class="mb-3">
								<label class="small mb-1" for="cur_pass">Current password</label>
								<input class="form-control" id="cur_pass" name="cur_pass" type="password" required>
							</div>
							<div class="mb-3">
								<label class="small mb-1" for="new_pass">New password</label>
								<input class="form-control" id="new_pass" name="new_pass" type="password" required>
							</div>					
							<button class="btn btn-primary" type="submit" name="upd_pass">Save changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
</body>
</html>