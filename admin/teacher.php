<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

extract($_POST);
include_once("../common/super_common.php");

if(isset($add_tch))
{
    $s=mysqli_fetch_assoc(mysqli_query($con,"select * from tch_details where id='".$id."'"))['id'];
    if($s>0)
    {
        $inserted="<div class='alert alert-warning' style='text-align:left;'>Record Already Exists</div>";
    }
    else
    {
        mysqli_query($con,"INSERT INTO tch_details VALUES (".$id.",'".$name."','".$email."','".$password."','".strtolower($ca)."')");
        $inserted="<div class='alert alert-success' style='text-align:left;'>Successfully Added '".$name."'</div>";
    }
}

if(isset($del_tch))
{
    mysqli_query($con,"delete from tch_details where id='".$id."'");
    $deleted="<div class='alert alert-success' style='text-align:left;'>Record Deleted</div>";
}
  
if(isset($ser_tch))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from tch_details where id='".$id."'" ));
    if($s>0)
    {
    $record="<div class='card-body' style='margin-top: -1rem;'><hr>
                <form method='post'>                    
                    <div class='row mb-3'>
                        <div class='col-md-2'>
                            <label class='small mb-1' for='usr_name'>Teacher ID</label>
                            <input class='form-control' id='usr_name' type='number' name='id' value='".$s['id']."' readonly>
                        </div>
                        <div class='col-md-3'>
                            <label class='small mb-1' for='name'>Name</label>
                            <input class='form-control' id='name' type='text' name='name' value='".$s['name']."' required>
                        </div> 
                        <div class='col-md-2'>
                            <label class='small mb-1' for='course'>Course Assigned</label>
                            <input class='form-control' id='course' type='text' name='ca' value='".$s['ca']."' required>
                        </div>
                        <div class='col-md-3'>
                            <label class='small mb-1' for='course'>Email</label>
                            <input class='form-control' id='course' type='email' name='email' value='".$s['email']."' required>
                        </div>
                        <div class='col-md-2'>
                            <label class='small mb-1' for='pass'>Password</label>
                            <input class='form-control' id='pass' type='password' name='password' value='".$s['password']."' required>
                        </div>                                                  
                    </div>
                    <div class='float-right'>                                            
                        <input type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#del_con' value='Delete Record' style='margin-right:5px'>
                        <input type='submit' class='btn btn-sm btn-secondary' name='upd_tch' value='Update'>
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
                                    <button type='submit' class='btn btn-sm btn-danger' name='del_tch' value='Yes' >Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>";
    }
    else
    {
        $updated = "<div class='alert alert-warning' style='text-align:left;'>No Record Found!</div>";
    }
}

if(isset($upd_tch))
{
    $q = "update `tch_details` set `name`='".$name."',`email`='".$email."',`password`='".$password."',`ca`='".$ca."' where `id`=".$id;
    mysqli_query($con,$q);
    $updated="<div class='alert alert-success' style='text-align:left;'>Record Updated</div>";
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
      <link rel="stylesheet" type="text/css" href="../css/admin.css">
      <style type="text/css">.bg-light{background-color: #ececec !important;}</style>
   </head>
   <body class="d-flex flex-column h-100">
      <?php include_once("../common/topbar.php");?>
      <div class="container-fluid">
         <div class="row">
            <?php include_once("sidebar.php");?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h4">Manage Teachers</h1>
               </div>
                <div class="card mb-4">
                    <div class="card-header text-white bg-dark">
                        <strong>Add Teacher</strong>
                    </div>
                    <div class="card-body">
                        <form method="post"><?php if(isset($inserted)) echo $inserted; ?>                                                   
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label class="small mb-1" for="id"><strong>Teacher ID<span class="text-danger">*</span></strong></label>
                                    <input class="form-control" id="id" type="number" name="id" placeholder="ID" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="name"><strong>Name<span class="text-danger">*</span></strong></label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Name" required>
                                </div> 
                                <div class="col-md-2">
                                    <label class="small mb-1" for="ca"><strong>Course Assigned<span class="text-danger">*</span></strong></label>
                                    <input class="form-control" id="ca" type="text" name="ca" placeholder="Course Assigned" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="email"><strong>Email<span class="text-danger">*</span></strong></label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="pass"><strong>Password<span class="text-danger">*</span></strong></label>
                                    <input class="form-control" id="pass" type="password" name="password" placeholder="Password" required>
                                </div>                            
                            </div>
                            <div class="mb-1">                                 
                                 <input type="submit" class="btn btn-md btn-secondary float-right" name="add_tch" value="Add Teacher">
                            </div> 
                        </form>                             
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header text-white bg-dark">
                        <strong>Update Teacher Details</strong>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <?php if(isset($updated)) echo $updated; if(isset($deleted)) echo $deleted; ?>
                            <label class="small mb-1" for="tid"><strong>Teacher ID<span class="text-danger">*</span></strong></label>
                            <div class="input-group mb-1">
                                <input type="number" class="form-control" id="tid" name="id" placeholder="Enter teacher's id" required>
                                <div class="input-group-append">                                    
                                    <input type="submit" class="btn btn-md btn-secondary" name="ser_tch" value="Search">
                                </div>
                            </div>
                        </form>                             
                    </div>
                    <?php if(isset($record)) echo $record;?>
                </div>

            </main>
        </div>
    </div>
    <?php include('../common/footer.php');?>   
</body>
</html> 