<?php
error_reporting(0);
session_start();
if ($_SESSION['state'])  header('location:student/dashboard.php');
if ($_SESSION['state1']) header('location:teacher/dashboard.php');
if ($_SESSION['state2']) header('location:admin/index.php');

extract($_POST);
if(isset($login))
{
    include('common/super_common.php'); 
    $stu=mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where email='".$username."' and password='".$password."';"));  
    $tch=mysqli_fetch_assoc(mysqli_query($con,"select * from tch_details where email='".$username."' and password='".$password."';")); 
    $adm=mysqli_fetch_assoc(mysqli_query($con,"select * from adm_details where email='".$username."' and password='".$password."';"));
    mysqli_close($con);  
    if($stu>0)
    {        
        $_SESSION['roll'] = $stu['roll'];
        $_SESSION['course'] = $stu['course'];
        $_SESSION['email'] = $stu['email'];
        $_SESSION['name'] = $stu['name'];
        $_SESSION['dob'] = $stu['dob'];
        $_SESSION['state'] = true;
        header('location:student/dashboard.php');
    } 
    elseif($tch>0)
    {       
        $_SESSION['id'] = $tch['id'];
        $_SESSION['name'] = $tch['name'];
        $_SESSION['email'] = $tch['email'];
        $_SESSION['ca'] = $tch['ca'];
        $_SESSION['state1'] = true;
        header('location:teacher/dashboard.php');
    }  
    elseif($adm>0)
    {        
        $_SESSION['id'] = $adm['id'];
        $_SESSION['name'] = $adm['name'];
        $_SESSION['email'] = $adm['email'];
        $_SESSION['state2'] = true;
        header('location:admin/index.php');
    }
    else
    {
        $msg="<div class='alert alert-danger'>Invalid Username or Password</div>";
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
    <link href="css/signin.css" rel="stylesheet">     
</head>
<body class="text-center">
    <form class="form-signin" method="post"><?php if(isset($msg)) echo $msg; ?>   
        <h1 class="h3 mb-3 font-weight-normal">Welcome back</h1>      
        <input type="email" class="form-control" name="username" placeholder="Username" required>      
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span> Forgot Password? <a href="common/forgot_password.php" class="link-primary">Click here.</a></span>
        <button class="btn btn-md btn-primary btn-block" name="login" type="submit">Sign in</button>      
    </form> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script><?php if(isset($msg)) echo '
    <script class="alert" type="text/javascript">window.setTimeout(function(){$(".alert").fadeTo(200,0).slideUp(200,function(){$(this).remove();});},2000);</script>';?> 
</body>
</html>