<?php 

error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

    extract($_POST);
    include_once("../common/super_common.php");

    if(isset($add_tch))
    {
        mysqli_query($con,"INSERT INTO tch_details VALUES (".$id.",'".$name."','".$email."','".$password."','".$ca."')");
        $inserted = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                        Successfully Added '".$name."'<button class='close' data-dismiss='alert'>&times;</button>
                    </div>";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">   
    <style type="text/css">.bg-light{background-color: #c1d2e3 !important;}</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">       
</head>
<body style="margin-top: 4rem;">
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand" style="font-size: 25px;"><strong>Manage Teachers</strong></sapn></nav>
    <style>main{padding: 1rem;}input{margin-bottom: 0.3rem;}input[type='submit']{float: right;}.navbar{margin-bottom:-25px;}hr{margin-top: 5rem;}.a{margin-top:7rem;}</style>
    <main class="container-fluid">

        <!--Add Teacher-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand">Add Teacher</sapn></nav><br>
        <style>form{border-bottom:5px solid #c1d2e3;border-right:5px solid #c1d2e3;border-left:5px solid #c1d2e3;padding:10px 10px 45px 10px;}</style>               
        <form method="post" class="form-signin">
            <?php if(isset($inserted)) echo $inserted; ?>
            <input type="number" class="form-control" name="id" placeholder="Teacher ID" required>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="email"  class="form-control" name="email" placeholder="Email" required>            
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="text" class="form-control" name="ca" placeholder="Course Assigned" required>            
            <input type="submit" class="btn btn-md btn-secondary" name="add_tch" value="Add Teacher">                              
        </form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 