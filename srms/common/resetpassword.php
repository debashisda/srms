<?php
// $_GET['t']."<br>";
// echo $_GET['m']."<br>";
// echo $_GET['d']."<br>";

extract($_POST);
if(isset($reset))
{
	$cur_time = time();
	if(isset($passwd))
	{
		include_once("../common/super_common.php");
		$query = "select * from reset_db where re_email='".$re_email."' and re_token='".$token."'";
		$res = mysqli_query($con,$query);
		$row = mysqli_fetch_assoc($res);

		if($cur_time - $row['re_time'] > 180)
		{
		 	echo "Link Expired!";
		 }
		 else
		 {
			$query = "update stu_details set password='".$passwd."' where email='".$re_email."'";
			mysqli_query($con,$query);
			echo "Password Updated!";
		}
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
    	<label for="passwd">Enter new Password</label>
    	<input type="text" name="passwd" required>

    	<input type="hidden" name="token" value="<?php echo $_GET['t']; ?>">
    	<input type="hidden" name="re_email" value="<?php echo $_GET['m']; ?>">

		<input type="submit" name="reset" value="Reset Password">   	 	  
  </form>  
</div>
</body>
</html>