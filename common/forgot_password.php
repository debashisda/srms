<?php
extract($_POST);
include_once("../common/mail.php");
include_once("../common/super_common.php");
if(isset($send))
{	
	$token="";
	if(isset($destination))
	{
		$t = time();
		$token = md5($destination." ".$t." ".$destination);
		$reset_link = "https://b329-42-105-103-229.in.ngrok.io/srms/common/resetpassword.php?t=".$token."&m=".$destination."&d=".$t;

		$query = "insert into reset_db values('$destination','$token','$t')";
		mysqli_query($con,$query);
		send_reset_link($destination,$reset_link);
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SRMS</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <style> 
      .form-control,.btn-block{
        margin-top: 15px;
        margin-bottom: 15px !important;
        border-radius: 5px !important;
      }
    </style>     
</head>
<body class="text-center">
  <form class="form-signin" method="post">      
      <h1 class="h3 mb-3 font-weight-normal">Forgot Password</h1>         
      <input type="email" class="form-control" name="destination" placeholder="Enter Registered Email" required>      
      <button class="btn btn-md btn-primary btn-block" name="send" type="submit">Reset Password</button>
      <a href="../"class="link-primary">Go back to Login</a>
    </form> 
    <?php if(isset($reset_link)) echo $reset_link; ?>     
  </body>
</html>

