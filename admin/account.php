<?php 
error_reporting(0);
session_start();
if(!($_SESSION['state2'])) header('location:../logout.php');

include_once("../common/super_common.php");
extract($_POST);
if(isset($upd_pass))
{
	$cur_pass1 = mysqli_fetch_assoc(mysqli_query($con,'select password from adm_details where id='.$_SESSION['id']));	
	if($cur_pass == $cur_pass1['password'])
	{
		 mysqli_query($con,"update adm_details set password='".$new_pass."' where id=".$_SESSION['id']);
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
<!doctype html>
<html lang="en" class="h-100">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link rel="stylesheet" type="text/css" href="../css/admin.css">
   </head>
   <body class="d-flex flex-column h-100">
      <?php include_once("../common/topbar.php");?>
      <div class="container-fluid">
         <div class="row">
            <?php include_once("sidebar.php");?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 ">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"><h1 class="h2">Account</h1></div>
					<div class="card mb-4">
						<div class="card-header bg-light">Account Details</div>
							<div class="card-body">
								<style>.form-control[readonly]{background-color: #f4f4f4; opacity: 1;</style>			
								<div class="row gx-3 mb-3">
									<div class="col-md-4">
										<label class="small mb-1" for="roll">Administrator ID</label>
										<input class="form-control" id="roll" type="text" value='<?php echo $_SESSION['id'];?>' readonly>
									</div>
									<div class="col-md-4">
										<label class="small mb-1" for="usr_name">Name</label>
										<input class="form-control" id="usr_name" type="text" value='<?php echo $_SESSION['name'];?>' readonly>
									</div>											
									<div class="col-md-4">
										<label class="small mb-1" for="email">Email address</label>
										<input class="form-control" id="email" type="email" value='<?php echo $_SESSION['email'];?>' readonly>
									</div>													
								</div>														
						</div>
					</div>					
					<div class="card mb-4">					
						<div class="card-header bg-light">Change Password</div>
						<div class="card-body">
							<form method="post">
								<?php if(isset($msg)) echo $msg; ?>
								<div class="row gx-3 mb-3">					
									<div class="col-md-6">
										<label class="small mb-1" for="cur_pass">Current password</label>
										<input class="form-control" id="cur_pass" name="cur_pass" type="password" required>
									</div>											
									<div class="col-md-6">
										<label class="small mb-1" for="new_pass">New password</label>
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
	<?php include('../common/footer.php');?>
	 
	
</body>
</html>
