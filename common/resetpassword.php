<?php
error_reporting(0);
$x="";

$invalid_link = "<div class='alert alert-danger'>Invalid Link</div>";
$expired_link = "<div class='alert alert-danger'>Link Expired</div>";

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
		$msg = $invalid_link;		
}
elseif(!filter_var($le,FILTER_VALIDATE_EMAIL))
{
		$msg = $invalid_link;
}
else
{
		include_once('../common/super_common.php');
		$row = mysqli_fetch_assoc(mysqli_query($con,"select * from reset_password where email='".$le."' and token='".$lt."' and time=".$ld));					
		if($row < 1)
		{
				$msg = $invalid_link;
		}	
		else
		{
				if(time() - $row['time'] > 60*10)
				{
						$msg = $expired_link;
				}
				else
				{
						$msg = "<form method='post'>  		
    										<h2 class='h3 mb-3 font-weight-normal'>Reset your password</h2>
    										<input type='password' class='form-control' id='password' name='passwd' placeholder='New password' required>
    										<input type='password' class='form-control' id='confirm_password' name='repasswd' placeholder='Confirm new password' required>   
												<button type='submit' class='btn btn-md btn-primary btn-block' name='reset'>Change Password</button>
  								</form>  								
  								<script src='../js/backhref.js'></script>";
				}
		}
}

extract($_POST);
if(isset($reset))
{
		include_once('../common/super_common.php');
		$row = mysqli_fetch_assoc(mysqli_query($con,"select * from reset_password where email='".$le."' and token='".$lt."' and time=".$ld));					
		if($row < 1)
		{
				$msg = $invalid_link;
				mysqli_close($con);
		}
		else
		{
				if(time() - $row['time'] > 60*10)
				{
						$msg = $expired_link;
				}
				elseif(($passwd != $repasswd))
				{
						$error = "<div class='alert alert-danger'>Confirm Password doesn't Match</div>";
				}
				elseif(($passwd == $repasswd))
				{						
						mysqli_query($con,"UPDATE stu_details SET password='".$passwd."' WHERE email='".$le."'");	
						mysqli_query($con,"DELETE FROM reset_password WHERE email='".$le."'");
						$msg = "<div class='alert alert-success'>Password Updated</div>";
						unset($le);unset($lt);unset($ld);					
						mysqli_close($con);
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
	<div class='form-signin'>		
		<?php if(isset($error))echo $error; if(isset($msg)) echo $msg;?>
		<div><a href='../' class='link-primary'>Go back to Login</a></div>			
	</div>
	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->
</body>
</html>