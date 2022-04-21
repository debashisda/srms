<?php
extract($_POST);
if(isset($login))
{
  include('common/super_common.php'); 
  $ret=mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where email='".$username."' && password='".$password."';"));
  mysqli_close($con);
  if($ret>0)
  {
      session_start();
      $_SESSION['roll'] = $ret['roll'];
      $_SESSION['course'] = $ret['course'];
      $_SESSION['email'] = $ret['email'];
      $_SESSION['name'] = $ret['name'];
      $_SESSION['state'] = true;
      header('location:student/dashboard.php');
  }
  else
  {
    $msg="<div class='alert alert-danger alert-dismissible' role='alert'>Invalid Username or Password
            <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SRMS</title>
    <meta content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">  
    <link href="./css/signin.css" rel="stylesheet">     
</head>
<body class="text-center">
    <form class="form-signin" method="post">
        <?php if(isset($msg)){ echo $msg; } ?>
        <!--img class="mb-4" src="./login_files/bootstrap-solid.svg" alt="" width="72" height="72"-->
        <h1 class="h3 mb-3 font-weight-normal">Welcome back</h1>      
        <input type="email" class="form-control" name="username" placeholder="Username" required>      
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span> Forgot Password? <a href="common/forgot_password.php" class="link-primary">Click here.</a></span>
        <button class="btn btn-md btn-primary btn-block" name="login" type="submit">Sign in</button>      
    </form> 
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>