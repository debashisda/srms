<?php
error_reporting(0);
extract($_POST);

if(isset($send))
{        
    include_once('../common/super_common.php');
    $founds = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM stu_details WHERE email='".$email."'"));
    $foundt = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM tch_details WHERE email='".$email."'"));
    $founda = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM adm_details WHERE email='".$email."'"));
    $table = "";
    if($founds>0)
    {
        $table = "stu_details";
    }
    elseif($foundt>0)
    {
        $table = "tch_details";
    }
    else
    {
        $table = "adm_details";
    }

    if($table>0)
    {
        $time = time();
        $token = md5(md5($email.time()).md5(time().$email));
        $afound = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM reset_password WHERE email='".$email."'"));
        if($afound>0)
        {
            $q= "update reset_password SET `token`='".$token."' ,`time`=".$time.", `table`='".$table."', email='".$email."'";           
            mysqli_query($con,$q);            
        }
        else
        {           
            mysqli_query($con,"INSERT into reset_password VALUES('".$email."','".$token."',".$time.",'".$table."')");
        }     
        $message="https://".$_SERVER['SERVER_NAME']."/srms/common/resetpassword.php?".base64_encode($token."&".$email."&".$time."&".$table);
        include_once("mail.php");               
        send_reset_link($email,$message);       
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="../css/signin.css" rel="stylesheet">
    <style>.form-control,.btn-block{margin-top: 15px;margin-bottom: 15px !important;border-radius: 5px !important;}</style>     
</head>
<body class="text-center">
<?php 
    if(isset($msg))
    {
        echo "<div class='form-signin'>
                <div class='alert alert-success'>Please check your registered email. If it exists in our records we will send you the reset link.</div>
                <a href='../' class='link-primary'>Go back to Login</a>                
              </div>";
    }
    else
    {
        echo "<form class='form-signin' method='post'>                 
                <h2 class='h3 mb-3 font-weight-normal'>Reset your password</h2>              
                <input type='email' class='form-control' name='email' placeholder='name@email.com' required>      
                <button class='btn btn-md btn-primary btn-block' name='send' type='submit'>Reset Password</button>
                <a href='../' class='link-primary'>Go back to Login</a>
             </form>";
    }
?>    
 
  </body>
</html>

