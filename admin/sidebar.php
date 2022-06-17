<style>.nav{min-width: 270px !important;}</style>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-2">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
            <span><strong>Administrator</strong></span>
            <a class="d-flex align-items-center text-muted" href="account.php">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" id="index" href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" id="student" href="student.php"><i class="bi bi-person"></i> Manage Student</a></li>            
            <li class="nav-item"><a class="nav-link" id="subject" href="subject.php"><i class="bi bi-book"></i> Manage Subject</a></li> 
            <li class="nav-item"><a class="nav-link" id="teacher" href="teacher.php"><i class="bi bi-person-fill"></i> Manage Teacher</a></li>           
        </ul>
        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
            <span><strong> Profile </strong></span>
            <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" id="account" href="account.php"><i class="bi bi-gear-fill"></i> Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript">document.getElementById(document.URL.split('/')[5].split('.')[0]).setAttribute('class','nav-link active');</script>