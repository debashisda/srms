<?php 
//error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');

include_once("../common/super_common.php");
$stu = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from stu_details;'))['count(*)'];
$tch = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from tch_details;'))['count(*)'];
$sub = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from subjects;   '))['count(*)'];
$adm = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from adm_details;'))['count(*)'];

$col = mysqli_query($con,"select * from subjects");
mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script> 
    <style>body{margin-top: 4rem;}.fluid-container{margin-right:1rem;margin-left: 1rem;}.py-5{padding-top: 1rem !important;}</style>    
</head>
<body>
    <style>.bg-light{background-color: #c1d2e3 !important;}</style>
    <nav class="navbar navbar-light bg-light fixed-top"><span class="navbar-brand" href="#" style="padding-left: 10px;font-size: 20px;">Dashboard</span></nav>
    <div class="album py-3">
      <div class="fluid-container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-2">
        <?php          
          $arr = ['Students: '.$stu, 'Teachers: '.$tch, 'Subjects: '.$sub, 'Admins: '.$adm];
          for ($i=0; $i<count($arr); $i++)
          {          
            echo '
            <div class="col">
              <div class="card shadow-sm">
                  <div class="card-body">
                    <p class="card-text">Total no. of '.$arr[$i].'</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group"><a href="#" class="btn btn-sm btn-outline-secondary">View</a></div>                
                    </div>
                  </div>
              </div>
            </div>';
          }
        ?>
        </div>
        <hr>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Course</th>               
                  <th>Start date</th>
                  <th>Salary</th>
                  <th>Salary</th>
              </tr>
          </thead>
          <tbody>
              <?php
                while($row = mysqli_fetch_assoc($col))
                {
                    echo "<tr><td>".strtoupper($row['course'])."</td><td>".$row['sem']."</td><td>".$row['sub_code']."</td><td>".$row['sub_name']."</td></tr>";  
                }
              ?>
            </tbody>        
      </table>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>