<?php

error_reporting(0);

$x="";
$x = explode('?',$_SERVER['REQUEST_URI'])[1];
$link = explode('&', base64_decode($x));
$lt = $link[0];
$le = $link[1];
$ld = $link[2];

$le = filter_var($link[1],FILTER_SANITIZE_EMAIL);

if(strlen($x)<75)
{
		sleep(2);
		header('location:../index.php');
}
elseif(!(count($link) == 3) || (strlen($lt)!=32) || (strlen($ld)!=10) || ($le==NULL || $lt==NULL || $ld==NULL))
{
		$msg = "<div class='alert alert-danger' role='alert'>Invalid Link</div>";		
}
elseif(!filter_var($le,FILTER_VALIDATE_EMAIL))
{
		$msg = "<div class='alert alert-danger' role='alert'>Invalid Link</div>";
}
else
{
		include_once('../common/super_common.php');
		$row = mysqli_fetch_assoc(mysqli_query($con,"select * from reset_password where email='".$le."' and token='".$lt."' and time=".$ld));
		mysqli_close($con);
		if($row<0)
		{
				$msg = "<div class='alert alert-danger' role='alert'>Invalid Link</div>";
		}
		else
		{
				if(time() - $row['time'] > 60*10)
				{
						$msg = "<div class='alert alert-danger' role='alert'>Link Expired</div>";
				}
				else
				{
						$msg = "<div class='alert alert-success' role='alert'>Valid Link</div>";
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
	<div class="form-signin"><?php if(isset($msg)) echo $msg;?><div>  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>



<?php 
/*
				mysqli_query($con,"UPDATE stu_details SET password='".$passwd."' WHERE email='".$re_email."'");	
				mysqli_query($con,"DELETE FROM reset_password WHERE email='".$re_email."'");
				$msg = "<div class='alert alert-success alert-dismissible' role='alert'>Password Updated
            			<button class='close' data-dismiss='alert'>&times;</button>
          			</div>";
*/ 
?>