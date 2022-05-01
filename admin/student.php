<?php 

include_once("../common/super_common.php");
extract($_POST);
if(isset($add_stu))
{
    mysqli_query($con,"insert into stu_details values (".$roll.",'".$course."','".$email."','".$name."','".$password."')");
    mysqli_query($con,"insert into ".$course."(roll) values (".$roll.")");
}

if(isset($del_stu))
{
    $c = mysqli_fetch_assoc(mysqli_query($con,"select course from stu_details where roll=".$roll));
    mysqli_query($con,"delete from stu_details where roll=".$roll);
    mysqli_query($con,"delete from ".$c['course']." where roll=".$roll);
}

if(isset($ser_stu))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
    $row="<div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover table-condensed'>
        <thead class='thead-dark'><tr><th>Roll</th><th>Course</th><th>Name</th><th>Email</th><th>Password</th></tr></thead>
        <tbody>
        <tr>
            <td><input type='' class='data' value='".$s['roll']."' name='roll' readonly></td>
            <td><input type='text' class='data' value='".$s['course']."' name='course' readonly></td>             
            <td><input type='text' class='data' value='".$s['name']."' name='name'></td>
            <td><input type='email' class='data' value='".$s['email']."' name='email'></td> 
            <td><input type='password' class='data' value='".$s['password']."' name='password'></td>  
        </tr>
        ";
}

if(isset($upd_stu))
{
    mysqli_query($con,"update stu_details set name='".$name."',email='".$email."',password='".$password."' WHERE roll='".$roll."'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">  
    
    <style type="text/css">
        .bg-light{background-color: #c1d2e3 !important;}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">       
</head>
<body style="margin-top: 4.5rem;">
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand" style="font-size: 25px;"><strong>Manage Student</strong></sapn></nav>

    <style type="text/css">
        main{padding: 1rem;}
        input{margin-bottom: 0.3rem; }
        input[type='submit']{float: right;}
        .navbar{margin-bottom: -15px;}
        hr{margin-top: 5rem;}
        .a{margin-top: 7rem;}
    </style>
    <main class="container-fluid">

        <!--Add Student-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand">Add Student</sapn></nav><br>        
        <form method="post" class="form-signin">
            <input type="number" class="form-control" name="roll" placeholder="Roll No" required>
            <input type="text" class="form-control" name="course" placeholder="Course" required>
            <input type="email"  class="form-control" name="email" placeholder="Email" required>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>            
            <input type="submit" class="btn btn-md btn-secondary" name="add_stu" value="Add Student">                              
        </form>    
        <hr>

        <!--Update Student-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand">Update Students Details</sapn></nav><br>        
        <form method="post" class="form-signin">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="roll" placeholder="Search Student">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="ser_stu" value="Search Student">
                </div>
            </div>            
        </form>
        <style type="text/css">th,td{border: 1px solid black;}.data{width: 100% !important;}</style>
        <form method='post'>
            <?php 
            if(isset($row)) echo $row.
            "<tr><td colspan='4'></td><td><input type='submit' class='btn btn-md btn-secondary' name='upd_stu' value='Update'></td></tr></tbody></table></div>";
            ?>
        </form>
   
        <br>
        <!--Delete Student--> 
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand"> Delete Student</sapn></nav><br>        
        <form method="post" class="form-signin">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="roll" placeholder="Student Roll No">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="del_stu" value="Delete Student">
                </div>
            </div>  
        </form>
        <br>
        <!--Course Change-->
        <nav class="navbar navbar-light bg-light"><span class="navbar-brand">Student Course Update</sapn></nav><br>
            <form method="post" class="form-signin">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="roll" placeholder="Student Roll No">
                    <div class="input-group-append">
                    <input type="submit" class="btn btn-md btn-secondary" name="ser_stu" value="Delete Student">
                    </div>
                </div>                                
            </form>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>