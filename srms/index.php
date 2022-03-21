<?php

$msg = false;
include('common/super_common.php');

extract($_POST);
if(isset($login))
{
  /*
  $username=$username;
	$password=hash('sha256',$password);
  */
    $query=mysqli_query($con,"select * from stu_details where email='".$username."' && password='".$password."';");
	$ret=mysqli_fetch_assoc($query);
	if($ret>0)
	{
        session_start();
        $_SESSION['roll'] = $ret['roll'];
        $_SESSION['regno'] = $ret['regno'];
        $_SESSION['course'] = $ret['course'];
        $_SESSION['email'] = $ret['email'];
        $_SESSION['name'] = $ret['name'];
        $_SESSION['state'] = true;
		header('location:student/student_dashboard.php');
	}
   else
	{
		$msg=true;
	}
}
?>
<html>
<head>		
    <link rel="stylesheet" href="common/indexstyle.css">
</head>
<style>
	
@font-face 
{
	font-family: bootstrap-icons;
    src: url(common/svg/bootstrap-icons.woff2);
}

[class*=" bi-"]::before {
  display: inline-block;
  font-family: bootstrap-icons;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  vertical-align: text-bottom;
  -webkit-font-smoothing: antialiased;
}
.bi-eye-slash::before { content: "\f320"; }
.bi-eye::before { content: "\f321"; }

	</style>
    <body>
        <h1>Student Result Management System</h1>
        <?php if($msg) echo "<ul class='auth-form' id='clsem'><li>Invalid username or password.<span class='close'  onclick='errormessage()'>&times;</span></li></ul>";?>

        <div class="auth-form" id="login">
            <div class="auth-form-body">
                <form method="post">
                    <label>Email:</label>
                    <input type="email" name="username" id="login_field" class="form-control" required autocomplete>
                    <div class="position-relative">
                        <label>Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <i class="bi bi-eye-slash eye-button" id="togglePassword"></i>
                        <input type="submit" class="btn" name="login" value="Log in">
                        <a class="label-link" href="forgot-password.php">Forgot password?</a>
                    </div>
                </form>
            </div>
            <!--p class="create-new-account">New here? <a href="create-account.php">Create an account</a>.</p-->
        </div>
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            togglePassword.addEventListener('click', function(e){const type = password.getAttribute('type')==='password'?'text':'password';password.setAttribute('type',type);this.classList.toggle('bi-eye');});
		</script>
		<script>function errormessage(){document.getElementById("clsem").style.display='none';}</script>
    </body>
    </html>
