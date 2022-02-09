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

<html>
<head>
<title>Forgot Password</title>
<link rel="stylesheet" type="text/css" href="../common/style.css">
</head>
<body>
<div class="container">
  <form method="post">
    	<label for="destination">Enter your registered email</label>
    	<input type="text" name="destination" required>
		<input type="submit" name="send" value="Send">    	 	  
  </form>
  <?php if(isset($reset_link)) echo $reset_link; ?>
</div>
</body>
</html>

