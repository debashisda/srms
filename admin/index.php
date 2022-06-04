<?php 
   error_reporting(0);
   session_start();
   if (!isset($_SESSION['state2'])) header('location:../logout.php');
   
   include_once("../common/super_common.php");
   $stu = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from stu_details;'))['count(*)'];
   $tch = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from tch_details;'))['count(*)'];
   $sub = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from subjects;   '))['count(*)'];
   $adm = mysqli_fetch_assoc(mysqli_query($con,'SELECT count(*) from adm_details;'))['count(*)'];
   
   $col = mysqli_query($con,"select * from subjects");
   mysqli_close($con);
   $arr = ['Student','Subject','Teacher'];
   $arr2 = [$stu,$sub,$tch];
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
                  <h1 class="h2">Dashboard</h1>
               </div>
               <div class="row"><?php for($i=0; $i<count($arr); $i++){echo '
                  <div class="col-lg-4 mb-2 mt-2">                    
                     <div class="card h-100 border-start-lg border-start-primary">
                        <div class="card-body">
                           <div class="small text-muted">Total No of '.$arr[$i].'</div>
                           <div class="h3">'.$arr2[$i].'</div>
                           <a  href="'.strtolower($arr[$i]).'.php'.'">View Record <i class="bi bi-arrow-right" style="font-size:13px"></i></a>
                        </div>
                     </div>
                  </div>';}?>     
               </div>
               <hr>
            </main>
         </div>
      </div>
      <?php include('../common/footer.php');?>     
   </body>
</html>
