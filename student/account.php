<?php 
//error_reporting(0);
session_start();
if(!($_SESSION['state'])) header('location:../logout.php');

include_once("../common/super_common.php");
extract($_POST);
if(isset($upd_pass))
{
	$cur_pass1 = mysqli_fetch_assoc(mysqli_query($con,'select password from stu_details where roll='.$_SESSION['roll']))['password'];	
	if($cur_pass == $cur_pass1)
	{
		 mysqli_query($con,"update stu_details set password='".$new_pass."' where roll=".$_SESSION['roll']);
		 $msg = "<div class='alert alert-success' style='text-align:left;'>Password Updated</div>";
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
	<link rel="stylesheet" type="text/css" href="../css/student.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>Account</title>		 
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>	
		<div class="container-fluid">
        	<div class="row">
			<?php include_once("sidebar.php");?><main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
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
							<div class="col-md-6">
								<label class="small mb-1" for="roll"><strong>College ID</strong></label>
								<input class="form-control" id="roll" type="text" value='<?php echo $_SESSION['roll'];?>' readonly>
							</div>
							<div class="col-md-6">
								<label class="small mb-1" for="usr_name"><strong>Name</strong></label>
								<input class="form-control" id="usr_name" type="text" value='<?php echo $_SESSION['name'];?>' readonly>
							</div>																				
						</div>
						<div class="row gx-3 mb-3">
							<div class="col-md-6">
								<label class="small mb-1" for="course"><strong>Course</strong></label>
								<input class="form-control" id="course" type="text" value='<?php echo strtoupper($_SESSION['course']);?>' readonly>
							</div>
							<div class="col-md-6">
								<label class="small mb-1" for="dob"><strong>DOB</strong></label>
								<input class="form-control" id="dob" type="text" name="birthday" value="<?php echo strtoupper($_SESSION['dob']);?>" readonly>
							</div>
						</div>	
						<div class="mb-3">
							<label class="small mb-1" for="email"><strong>Email address</strong></label>
							<input class="form-control" id="email" type="email" value='<?php echo $_SESSION['email'];?>' readonly>
						</div>				
					</div>
				</div>				
				<div class="card mb-4">					
					<div class="card-header text-white bg-dark">
						<strong>Change Password</strong>
					</div>
					<div class="card-body">
						<form method="post">
<?php if(isset($msg)) echo $msg; ?>
							<div class="row gx-3">		
								<div class="col-md-6">
									<label class="small mb-1" for="cur_pass"><strong>Current password<span class="text-danger">*</span></strong></label>
									<input class="form-control" id="cur_pass" name="cur_pass" type="password" required>
								</div>
								<div class="mb-3 col-md-6">
									<label class="small mb-1" for="new_pass"><strong>New password<span class="text-danger">*</span></strong></label>
									<input class="form-control" id="new_pass" name="new_pass" type="password" required>
								</div>							
							</div>
							<button class="btn btn-secondary float-right" type="submit" name="upd_pass">Update Password</button>
						</form>
					</div>
				</div>
			</main>
			</div>
		</div>
	
	<?php include('../common/footer.php'); ?>
	<script type="text/javascript">document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>	  
</body>
</html>