<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

include_once("../common/super_common.php");
$stu_count = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) as stu_count from stu_details;'))['stu_count'];
$tch_count = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) as tch_count from tch_details;'))['tch_count'];
$sub_count = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) as sub_count from subjects;'))['sub_count'];
$adm_count = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) as adm_count from adm_details;'))['adm_count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>body{margin-top: 4rem;}.fluid-container{margin-right:1rem;margin-left: 1rem;}.py-5{padding-top: 1rem !important;}</style>      
</head>
<body>
    <style>.bg-light{background-color: #c1d2e3 !important;}</style>
    <nav class="navbar navbar-light bg-light fixed-top">
        <span class="navbar-brand" href="#" style="padding-left: 10px;font-size: 20px;">Dashboard</span>
    </nav>
    <div class="album py-3">
        <div class="fluid-container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-2">
        <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <p class="card-text">Total no. of Students: <?php echo $stu_count;?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>                  
                </div>
                <!--small class="text-muted">9 mins</small-->
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <p class="card-text">Total no. of Subjects: <?php echo $sub_count;?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-block btn-outline-secondary">View</button>               
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">           
            <div class="card-body">
              <p class="card-text">Total no.  of Faculties: <?php echo $tch_count;?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <!--button type="button" class="btn btn-sm btn-outline-secondary">Edit</button-->
                </div>               
              </div>
            </div>
          </div>
        </div>


        <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <p class="card-text">Total no. of Admins: <?php echo $adm_count;?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>               
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>