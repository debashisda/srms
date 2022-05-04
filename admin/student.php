<?php 

error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');


include_once("../common/super_common.php");
extract($_POST);
if(isset($add_stu))
{
    mysqli_query($con,"insert into stu_details values (".$roll.",'".$course."','".$email."','".$name."','".$password."')");
    mysqli_query($con,"insert into ".$course."(roll) values (".$roll.")");
    $rowx="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
            Successfully Added '".$name."'<button class='close' data-dismiss='alert'>&times;</button>
        </div>";
}

if(isset($del_stu))
{
    $c = mysqli_fetch_assoc(mysqli_query($con,"select course from stu_details where roll=".$roll));
    mysqli_query($con,"delete from stu_details where roll=".$roll);
    mysqli_query($con,"delete from ".$c['course']." where roll=".$roll);
    $del = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated<button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

if(isset($ser_stu))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
    $row="<div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover table-condensed'>
        <thead class='thead-dark'><tr><th>Roll</th><th>Course</th><th>Name</th><th>Email</th><th>Password</th></tr></thead>
        <tbody>
        <tr>
            <td><input type='number' class='data' value='".$s['roll']."' name='roll' readonly></td>
            <td><input type='text' class='data' value='".$s['course']."' name='course' readonly></td>             
            <td><input type='text' class='data' value='".$s['name']."' name='name'></td>
            <td><input type='email' class='data' value='".$s['email']."' name='email'></td> 
            <td><input type='password' class='data' value='".$s['password']."' name='password'></td>  
        </tr>
        <tr><td colspan='4'></td><td><input type='submit' class='btn btn-md btn-secondary' name='upd_stu' value='Update'></td></tr></tbody></table></div></form>";
}

if(isset($upd_stu))
{
    mysqli_query($con,"update stu_details set name='".$name."',email='".$email."',password='".$password."' WHERE roll='".$roll."'");
    $up = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated for ".$roll."
                <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

if(isset($ser_stu_))
{
   $c = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
   $srow="<div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover table-condensed'>
        <thead class='thead-dark'><tr><th>Roll</th><th>Name</th><th>Course</th></tr></thead>
        <tbody>
        <tr>
            <td><input type='number' class='data' value='".$c['roll']."' name='roll' readonly></td>                         
            <td><input type='text' class='data' value='".$c['name']."' name='name' readonly></td>
            <td><input type='text' class='data' value='".$c['course']."' name='course'></td>
        </tr>
        <tr><td colspan='2'></td><td><input type='submit' class='btn btn-md btn-secondary' name='upd_stu_' value='Update'></td></tr></tbody></table></div></form>
        ";
}

if(isset($upd_stu_))
{
    $c = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
    mysqli_query($con,"delete from ".$c['course']." where roll=".$c['roll']."");
    mysqli_query($con,"insert into ".$course."(roll) values (".$roll.")");
    mysqli_query($con,"update stu_details set course='".$course."' where roll=".$roll);
    $upd = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated for ".$roll."
                <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">    
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand big"><strong>Manage Student</strong></sapn></nav>

    
    <main class="container-fluid">

        <!--Add Student-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Add Student</strong></sapn></nav><br>         
        <form method="post" class="form-signin">
            <?php if(isset($rowx)) echo $rowx;?>
            <input type="number" class="form-control" name="roll" placeholder="Roll No" required>
            <input type="text" class="form-control" name="course" placeholder="Course" required>
            <input type="email"  class="form-control" name="email" placeholder="Email" required>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>            
            <input type="submit" class="btn btn-md btn-secondary" name="add_stu" value="Add Student">                              
        </form><hr>        

        <!--Update Student-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Update Students Details</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($up)) echo $up;?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="roll" placeholder="Search Student" required>
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="ser_stu" value="Search Student">
                </div>
            </div>            
        </form><br>
        <?php if(isset($row)) echo "<form method='post' style='border-top:5px solid #c1d2e3';>".$row;?>
        <hr>
           
        
        <!--Delete Student--> 
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Delete Student</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($del)) echo "<br>".$del; ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="roll" placeholder="Student Roll No" required>
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="del_stu" value="Delete Student">
                </div>
            </div>  
        </form>        
        <br><hr>
     
        <!--Course Change-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Change Student Course</strong></sapn></nav><br>
            <form method="post" class="form-signin">
                <?php if(isset($upd)) echo "<br>".$upd; ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="roll" placeholder="Student Roll No" required>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-md btn-secondary" name="ser_stu_" value="Search Student">
                    </div>
                </div>                                
            </form>
        <?php if(isset($srow)) echo "<br><form method='post' style='border-top:5px solid #c1d2e3';>".$srow; ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>