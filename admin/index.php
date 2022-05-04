<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['state2'])) header('location:../logout.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>.bg-light{background-color: #c1d2e3 !important;}a{color: #000;}.nav-link{color: #000;}</style>   
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">     
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
                <ul class="ul">
                    <span class="fs-5 d-none d-sm-inline">SRMS</span>
                </ul>                 
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li>
                        <a href="dashboard.php" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-speedometer2"></i>
                            <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="student.php" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-people"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Student</span>
                        </a>
                    </li>
                    <li>
                        <a href="subject.php" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Subject</span>
                        </a>
                    </li>
                    <li>
                        <a href="teacher.php" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-people"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Teacher</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="../logout.php" class="nav-link px-0 align-middle">                          
                            <i class="fs-4 bi-power"></i>
                            <span class="ms-1 d-none d-sm-inline">Log Out</span>
                        </a>
                    </li>
                </ul>                
            </div>
        </div>
        <div class="col py-3">            
            <iframe src="dashboard.php" name="content"  style="height: 100%;width: 100%;"></iframe>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>