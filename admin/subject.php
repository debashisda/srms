<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

include_once("../common/super_common.php");
extract($_POST);
if(isset($add_sub))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from subjects where sub_code='".$sub_code."'"));
    if($s>0)
    {
        $add_record="<div class='alert alert-warning alert-dismissible' role='alert' style='text-align:left;'>
                        Record Already Exists!<button class='close' data-dismiss='alert'>&times;</button>
                    </div>";
    }
    else
    {
        mysqli_query($con,"insert into subjects values ('".$course."',".$sem.",'".$sub_code."','".$sub_name."')");
        $rowx="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                    Successfully Added <strong>".$sub_name."</strong><button class='close' data-dismiss='alert'>&times;</button>
              </div>";
    }
}

if(isset($del_sub))
{
    mysqli_query($con,"delete from subjects where sub_code='".$sub_code."'");
    $row2="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Deleted<button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

if(isset($ser_sub))
{
    $s = mysqli_fetch_assoc(mysqli_query($con,"select * from subjects where sub_code='".$sub_code."'" ));
    if($s>0)
    {
    $row=   "<div class='card-body' style='margin-top: -1rem;'><hr>
                <form method='post'>                    
                    <div class='row mb-3'>
                        <div class='col-md-3'>
                            <label class='small mb-1' for='sub_code'>Subject Code</label>
                            <input class='form-control' id='sub_code' type='text' name='sub_code' value='".$s['sub_code']."' readonly>
                        </div>
                        <div class='col-md-3'>
                            <label class='small mb-1' for='course'>Course</label>
                            <input class='form-control' id='course' type='text' name='course' value='".$s['course']."'>
                        </div> 
                        <div class='col-md-3'>
                            <label class='small mb-1' for='sem'>Semester</label>
                            <input class='form-control' id='sem' type='text' name='sem' value='".$s['sem']."'>
                        </div>                    
                        <div class='col-md-3'>
                            <label class='small mb-1' for='sub_name'>Subject Name</label>
                            <input class='form-control' id='sub_name' type='text' name='sub_name' value='".$s['sub_name']."'>
                        </div>                                                    
                    </div>
                    <div class='float-right'>                                            
                        <input type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#del_con' value='Delete Record' style='margin-right:5px'>
                        <input type='submit' class='btn btn-sm btn-secondary' name='upd_sub' value='Update'>
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
                                    <button type='submit' class='btn btn-sm btn-danger' name='del_sub' value='Yes' >Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>";
    }
    else
    {
            $rowu="<div class='alert alert-warning alert-dismissible' role='alert' style='text-align:left;'>
                        No Record Record Found!<button class='close' data-dismiss='alert'>&times;</button>
                    </div>";
    }      
}

if(isset($upd_sub))
{
    mysqli_query($con,"update subjects set course='".$course."',sem='".$sem."',sub_name='".$sub_name."' WHERE sub_code='".$sub_code."'");
    $rowu="<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>
                Record Updated<button class='close' data-dismiss='alert'>&times;</button>
          </div>";
}

?>
<!doctype html>
<html lang="en" class="h-100">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link rel="stylesheet" type="text/css" href="../css/admin.css">      
   </head>
   <body class="d-flex flex-column h-100">
      <?php include_once("../common/topbar.php");?>
      <div class="container-fluid">
         <div class="row">
            <?php include_once("sidebar.php");?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">Manage Subjects</h1>
               </div>

               <div class="card mb-4">
                    <div class="card-header bg-light">Add Subject</div>
                    <div class="card-body">
                        <form method="post"><?php if(isset($add_record)) echo $add_record;?>
                            <?php if(isset($rowx)) echo $rowx;?>                                                   
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="small mb-1" for="course">Course</label>
                                    <input class="form-control" id="course" type="text" name="course" placeholder="Course (ex. BCA,BBA)" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="sub_code">Subject Code</label>
                                    <input class="form-control" id="sub_code" type="text" name="sub_code" placeholder="Subject Code" required>
                                </div> 
                                <div class="col-md-4">
                                    <label class="small mb-1" for="sub_name">Subject Name</label>
                                    <input class="form-control" id="sub_name" type="text" name="sub_name" placeholder="Subject Name" required>
                                </div>                            
                                <div class="col-md-2">
                                    <label class="small mb-1" for="sem">Semester</label>
                                    <input class="form-control" id="sem" type="number" name="sem" placeholder="Semester">
                                </div>                                                       
                            </div>
                            <div class="mb-3">                                            
                                 <input type="submit" class="btn btn-md btn-secondary float-right" name="add_sub" value="Add Subject">
                            </div> 
                        </form>                             
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">Update Subject</div>
                    <div class="card-body">
                        <form method="post">
                            <?php if(isset($rowu)) echo $rowu; if(isset($row2)) echo $row2;?>
                            <label class="small mb-1" for="sroll">Subject Code</label>                                                   
                            <div class="input-group mb-3">                                
                                <input type="text" class="form-control" name="sub_code" placeholder="Search Subject">
                                <div class="input-group-append">                                    
                                    <input type="submit" class="btn btn-md btn-secondary" name="ser_sub" value="Search">
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