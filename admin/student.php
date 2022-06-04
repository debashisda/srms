<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');
include_once("../common/super_common.php");

extract($_POST);

if(isset($add_stu))
{
    $record_found = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll))['roll'];
    if($record_found > 0)
    {
        $add_record="<div class='alert alert-warning alert-dismissible' role='alert' style='text-align:left;'>
                        Record Already Exists!<button class='close' data-dismiss='alert'>&times;</button>
                    </div>";
    }
    else
    {
        mysqli_query($con,"insert into stu_details values (".$roll.",'".strtolower($course)."','".$email."','".$name."','".$password."','".$dob."')");
        mysqli_query($con,"insert into ".$course."(roll) values (".$roll.")");
        $add_record="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                        Successfully Added <strong>".$name."</strong><button class='close' data-dismiss='alert'>&times;</button>
                    </div>";
    }
}

if(isset($ser_stu))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from stu_details where roll=".$roll));
    if($s>0)
    {
        $row = "
            <div class='card-body' style='margin-top: -1rem;'><hr>
                <form method='post'>                    
                    <div class='row mb-3'>
                        <div class='col-md-2'>
                            <label class='small mb-1' for='usr_name'>Roll No</label>
                            <input class='form-control' id='usr_name' type='number' name='roll' value='".$s['roll']."' readonly>
                        </div>
                        <div class='col-md-2'>
                            <label class='small mb-1' for='name'>Name</label>
                            <input class='form-control' id='name' type='text' name='name' value='".$s['name']."'>
                        </div> 
                        <div class='col-md-1'>
                            <label class='small mb-1' for='course'>Course</label>
                            <input class='form-control' id='course' type='text' name='course' value='".$s['course']."'>
                        </div>                    
                        <div class='col-md-2'>
                            <label class='small mb-1' for='dob'>Date of Birth</label>
                            <input class='form-control' id='dob' type='date' name='dob' value='".$s['dob']."'>
                        </div>
                        <div class='col-md-3'>
                            <label class='small mb-1' for='course'>Email</label>
                            <input class='form-control' id='course' type='email' name='email' value='".$s['email']."'>
                        </div>
                        <div class='col-md-2'>
                            <label class='small mb-1' for='pass'>Password</label>
                            <input class='form-control' id='pass' type='password' name='password' value='".$s['password']."'>
                        </div>                            
                    </div>
                    <div class='float-right'>                                            
                        <input type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#del_con' value='Delete Record' style='margin-right:5px'>
                        <input type='submit' class='btn btn-sm btn-secondary' name='upd_stu' value='Update'>
                    </div> 
                    <div class='modal fade' id='del_con' tabindex='-1' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title'>Delete Record</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>×</span>
                                    </button>
                                </div>
                                <div class='modal-body'>Confirm Delete Record?</div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-sm btn-secondary' data-dismiss='modal'>No</button>                       
                                    <button type='submit' class='btn btn-sm btn-danger' name='del_stu' value='Yes' >Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>";               
    }
    else
    {
        $up = "<div class='alert alert-warning alert-dismissible' role='alert' style='text-align:left;'>
                    No Record Found!<button class='close' data-dismiss='alert'>&times;</button>
               </div>";
    }
}

if(isset($upd_stu))
{
    $x=mysqli_fetch_assoc(mysqli_query($con,"select course from stu_details where roll='".$roll."'"))['course'];
    if($x == $course)
    {
        mysqli_query($con,"update stu_details set name='".$name."',email='".$email."',password='".$password."',dob='".$dob."' WHERE roll='".$roll."'");        
    }
    else if($x !== $course)//only changing course of a student
    {
        mysqli_query($con,"delete from ".$x." where roll='".$roll."'");
        mysqli_query($con,"insert into ".$course."(roll) values (".$roll.")");
        mysqli_query($con,"update stu_details set course='".$course."' where roll=".$roll);
        
    }    
    $up = "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated<button class='close' data-dismiss='alert'>&times;</button>
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

?>
<!doctype html>
<html lang="en" class="h-100">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="../css/admin.css">
      <style type="text/css">.bg-light{background-color: #ececec !important;}</style>
   </head>
   <body class="d-flex flex-column h-100">
      <?php include_once("../common/topbar.php");?>
      <div class="container-fluid">
         <div class="row"><?php include_once("sidebar.php");?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!--   Page Heading   -->
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">Manage Student</h1>
               </div>
               <!--   Add Student   -->
               <div class="card mb-4">
                    <div class="card-header bg-light">Add Student</div>
                    <div class="card-body">
                        <form method="post"><?php if(isset($add_record)) echo $add_record;?>                                                   
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label class="small mb-1" for="roll">Roll Number</label>
                                    <input class="form-control" id="roll" type="number" name="roll" placeholder="Roll Number" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Name" required>
                                </div> 
                                <div class="col-md-1">
                                    <label class="small mb-1" for="course">Course</label>
                                    <input class="form-control" id="course" type="text" name="course" placeholder="Course" required>
                                </div>                            
                                <div class="col-md-2">
                                    <label class="small mb-1" for="dob">Date of Birth</label>
                                    <input class="form-control" id="dob" type="date" name="dob" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="pass">Password</label>
                                    <input class="form-control" id="pass" type="password" name="password" placeholder="Password" required>
                                </div>                            
                            </div>
                            <div class="mb-1">                                            
                                 <input type="submit" class="btn btn-md btn-secondary float-right" name="add_stu" value="Add Student">
                            </div> 
                        </form>                             
                    </div>
                </div>
                <!--   Update Student   -->
                <div class="card mb-4">
                    <div class="card-header bg-light">Update Student Details</div>
                    <div class="card-body">
                        <form method="post">
                            <?php if(isset($up)) echo $up; if(isset($del)) echo $del; ?>
                            <label class="small mb-1" for="sroll">Roll No</label>                                                   
                            <div class="input-group mb-1">
                                <input type="number" class="form-control" id="sroll" name="roll" placeholder="Enter student's roll" required>
                                <div class="input-group-append">                                    
                                    <input type="submit" class="btn btn-md btn-secondary" name="ser_stu" value="Search">
                                </div>
                            </div>
                        </form>                             
                    </div>
                    <?php if(isset($row)) echo $row;?>
                </div>

            </main>
        </div>
    </div>
    <?php include('../common/footer.php');?>     
</body>
</html>