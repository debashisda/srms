<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">   
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
                <a href="../" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none"><span class="fs-5 d-none d-sm-inline">SRMS</span></a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="dashboard.html" class="nav-link align-middle px-0" target="content">
                            <i class="fs-4 bi-house"></i>
                            <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="Subjects.html" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Subjects</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="Teachers.html" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-people"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="Student.html" class="nav-link px-0 align-middle" target="content">
                            <i class="fs-4 bi-people"></i>
                            <span class="ms-1 d-none d-sm-inline">Manage Student</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="Student.html" class="nav-link px-0 align-middle" target="content">                          
                            <i class="fs-4 bi-power"></i>
                            <span class="ms-1 d-none d-sm-inline">Log Out</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col py-3">            
            <iframe src="dashboard.html" name="content"  style="height: 100%;width: 100%;"></iframe>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>