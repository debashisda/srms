<?php 

error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

include_once("../common/super_common.php");
extract($_POST);
if(isset($add_sub))
{
    mysqli_query($con,"insert into subjects values ('".$course."',".$sem.",'".$sub_code."','".$sub_name."')");
    $rowx="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Successfully Added '".$sub_name."'
                <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

if(isset($del_sub))
{
    mysqli_query($con,"delete from subjects where sub_code='".$sub_code."'");
    $row2="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Deleted
                <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

if(isset($ser_sub))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from subjects where sub_code='".$sub_code."'" ));
    $row=   "<div class='table-responsive'>
                <table class='table table-bordered table-striped table-hover table-condensed'>
                    <thead class='thead-dark'><tr><th>Subject Code</th><th>Course</th><th>Semester</th><th>Subject Name</th></tr></thead>
                    <tbody>
                        <tr>
                        <td><input class='data' value='".$s['sub_code']."' name='sub_code' readonly></td>
                        <td><input class='data' value='".$s['course']."' name='course'></td>
                        <td><input class='data' value=".$s['sem']." name='sem'></td>
                        <td><input class='data' value='".$s['sub_name']."' name='sub_name'></td>
                        </tr>
                        <tr><td colspan='3'></td><td><input type='submit' class='btn btn-md btn-secondary' name='upd_sub' value='Update'></td></tr>
                    </tbody>
                </table>
            </div>";
}

if(isset($upd_sub))
{
    mysqli_query($con,"update subjects set course='".$course."',sem='".$sem."',sub_name='".$sub_name."' WHERE sub_code='".$sub_code."'");
    $rowu="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated
                <button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">       
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand big"><strong>Manage Subjects</strong></sapn></nav>

   
    <main class="container-fluid">

        <!--Add Subject-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Add Subjects</strong></sapn></nav><br>          
        <form method="post" class="form-signin">
            <?php if(isset($rowx)) echo $rowx;?>
            <input type="text" class="form-control" name="course" placeholder="Course (ex. BCA )" required>
            <input type="text" class="form-control" name="sub_code" placeholder="Subject Code" required>
            <input type="text"  class="form-control" name="sub_name" placeholder="Subject Name" required>
            <input type="number" class="form-control" name="sem" placeholder="Semester" required>            
            <input type="submit" class="btn btn-md btn-secondary" name="add_sub" value="Add Subject">                              
        </form>    
        <hr>

        <!--Update Subject-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Update Subjects</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($rowu)) echo $rowu;?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="sub_code" placeholder="Search Subject">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="ser_sub" value="Search Subject">
                </div>
            </div>            
        </form>      
        <?php if(isset($row)) echo "<br><form method='post' style='border-top:5px solid #c1d2e3';>".$row."</form>";?>
           
     
        <!--Delete Subject--> 
        <hr>
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"><strong>Delete Subject</strong></sapn></nav><br>        
        <form method="post" class="form-signin">
            <?php if(isset($row2)) echo $row2;?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="sub_code" placeholder="Subject Code">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="del_sub" value="Delete Subject">
                </div>
            </div>  
        </form>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>