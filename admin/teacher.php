<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

extract($_POST);
include_once("../common/super_common.php");

if(isset($add_tch))
{
    mysqli_query($con,"INSERT INTO tch_details VALUES (".$id.",'".$name."','".$email."','".$password."','".strtolower($ca)."')");
    $inserted = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                    Successfully Added '".$name."'<button class='close' data-dismiss='alert'>&times;</button>
                </div>";
}

if(isset($del_tch))
{
    mysqli_query($con,"delete from tch_details where id='".$id."'");
    $deleted="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Deleted<button class='close' data-dismiss='alert'>&times;</button>
            </div>";
}
  
if(isset($ser_tch))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from tch_details where id='".$id."'" ));
    $record = "<div class='table-responsive'>
                <table class='table table-bordered table-striped table-hover table-condensed'>
                    <thead class='thead-dark'><tr><th>ID</th><th>Name</th><th>Email</th><th>Course Assigned</th><th>Password</th></tr></thead>
                    <tbody>
                        <tr>
                        <td><input type='number' class='data' value='".$s['id']."' name='id' readonly></td>
                        <td><input type='text' class='data' value='".$s['name']."' name='name'></td>
                        <td><input type='email' class='data' value=".$s['email']." name='email'></td>
                        <td><input type='text' class='data' value='".$s['ca']."' name='ca'></td>
                        <td><input type='password' class='data' value='".$s['password']."' name='password'></td>
                        </tr>
                        <tr><td colspan='4'></td><td><input type='submit' class='btn btn-md btn-secondary' name='upd_tch' value='Update'></td></tr>
                    </tbody>
                </table>
            </div>";
}

if(isset($upd_tch))
{
    $q = "update `tch_details` set `name`='".$name."',`email`='".$email."',`password`='".$password."',`ca`='".$ca."' where `id`=".$id;
    mysqli_query($con,$q);
    $updated="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                    Record Updated<button class='close' data-dismiss='alert'>&times;</button>
              </div>";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
      
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand big"><strong>Manage Teachers</strong></sapn></nav> 
    <main class="container-fluid">

        <!--Add Teacher-->         
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Add Teacher</strong></sapn></nav><br>                      
        <form method="post" class="form-signin">
            <?php if(isset($inserted)) echo $inserted; ?>
            <input type="number" class="form-control" name="id" placeholder="Teacher ID" required>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="email"  class="form-control" name="email" placeholder="Email" required>            
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="text" class="form-control" name="ca" placeholder="Course Assigned" required>            
            <input type="submit" class="btn btn-md btn-secondary" name="add_tch" value="Add Teacher">                              
        </form>        

        <!--Update Teacher-->
        <hr><nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Update Teacher</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($updated)) echo $updated;?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="id" placeholder="Search Teacher">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="ser_tch" value="Search Teacher">
                </div>
            </div>            
        </form>      
        <?php if(isset($record)) echo "<br><form method='post' style='border-top:5px solid #c1d2e3';>".$record."</form>";?>
           
     
        <!--Delete Subject--> 
        <hr><nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Delete Teacher</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($deleted)) echo $deleted;?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="id" placeholder="Teacher ID">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="del_tch" value="Delete Teacher">
                </div>
            </div>  
        </form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 