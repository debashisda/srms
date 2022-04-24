<?php
extract($_POST);
if(isset($reset))
{ 
	$cur_time = time();
	if(isset($passwd))
	{
		include_once("../common/super_common.php");
		$query = "select * from reset_password where email='".$re_email."' and token='".$token."'";
		$res = mysqli_query($con,$query);
		$row = mysqli_fetch_assoc($res);
		if($cur_time - $row['time'] > 180)
		{
		 		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'>Something went wrong
            			<button class='close' data-dismiss='alert'>&times;</button>
          			</div>";
		}
		else
		{
				mysqli_query($con,"UPDATE stu_details SET password='".$passwd."' WHERE email='".$re_email."'");	
				mysqli_query($con,"DELETE FROM reset_password WHERE email='".$re_email."'");
				$msg = "<div class='alert alert-success alert-dismissible' role='alert'>Password Updated
            			<button class='close' data-dismiss='alert'>&times;</button>
          			</div>";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <style>.form-control,.btn-block{margin-top: 15px;margin-bottom: 15px !important;border-radius: 5px !important;}</style>     
</head>
<body class="text-center">
  <form class="form-signin" method="post">
  		<?php if(isset($msg)) echo $msg; ?>
    	<h2 class="h4 mb-3 font-weight-normal">Enter new Password</h2>
    	<input type="text" class="form-control" name="passwd" placeholder="Enter new password" required>
    	<input type="hidden" name="token" value="<?php echo $_GET['t']; ?>">
    	<input type="hidden" name="re_email" value="<?php echo $_GET['m']; ?>">
			<button type="submit" class="btn btn-md btn-primary btn-block" name="reset">Reset Password</button>
  </form> 
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>