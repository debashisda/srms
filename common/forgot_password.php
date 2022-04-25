<?php
error_reporting(0);
extract($_POST);
if(isset($send))
{        
    include_once('../common/super_common.php');
    $found = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM stu_details WHERE email='".$email."'"));
    if($found>0)
    {
        $time = time();
        $token = md5(md5($email.time()).md5(time().$email));
        $afound = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM reset_password WHERE email='".$email."'"));
        if($afound>0)
        {
            mysqli_query($con,"UPDATE reset_password SET token='".$token."' ,time=".$time." WHERE email='".$email."'");            
        }
        else
        {           
            mysqli_query($con,"INSERT into reset_password VALUES('".$email."','".$token."',".$time.")");
        }
        include_once("mail.php");               
        //$message = "127.0.0.1/srms/common/resetpassword.php?".base64_encode($token."&".$email."&".$time);        
        $message = "http://192.168.43.66/srms/common/resetpassword.php?".base64_encode($token."&".$email."&".$time);        
        send_reset_link($email,$message);
        //echo $message;                
    }
    else
    {
        sleep(2.5);
    }
    $msg = true;
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
<?php 
    if(isset($msg))
    {
        echo "
            <div class='form-signin'>
                <div class='alert alert-success'>Please check your registered email. If it exists in our records we will send you a reset link.</div>
                <a href='../' class='link-primary'>Go back to Login</a>                
            </div>";
    }
    else
    {
        echo "
            <form class='form-signin' method='post'>                 
                <h2 class='h3 mb-3 font-weight-normal'>Reset your password</h2>              
                <input type='email' class='form-control' name='email' placeholder='name@email.com' required>      
                <button class='btn btn-md btn-primary btn-block' name='send' type='submit'>Reset Password</button>
                <a href='../' class='link-primary'>Go back to Login</a>
            </form>";
    }
    ?>    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>   
  </body>
</html>

