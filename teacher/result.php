<?php	
	error_reporting(0);
	session_start();
	if(!($_SESSION['state1'])) header('location:../logout.php');
	include_once("../common/super_common.php");
	$nm=mysqli_fetch_assoc(mysqli_query($con,"SELECT name from stu_details WHERE roll=".$_GET['roll']))['name'];
	if($_GET['roll'] == NULL || $_GET['sem'] == NULL || $_GET['sem'] > $_SESSION['semcount'] || $_GET['sem']<1 || strlen($nm)<1) header('location:dashboard.php');	

	$sem = $_GET['sem'];
	$roll = $_GET['roll'];
	$msg = false;
	extract($_POST);
	if(isset($update))
	{		
		$Q="";$NULLR = 0;
		$res=mysqli_query($con,"select sub_code from subjects where course='".$_SESSION['ca']."' and sem=".$sem);		
		while($r=mysqli_fetch_assoc($res))
		{
			$nam = $r['sub_code']; 
			$alp = ${$nam.'A'}; 
			$num = ${$nam.'B'};
			if($alp == NULL || $num == NULL) 
				$NULLR++;			
			$Q = $Q.$nam.":".$alp.":".$num."|";		    
		}
		$Q = trim($Q,'|');		
		$c = mysqli_fetch_assoc(mysqli_query($con,"select count(sub_code) as sub from subjects where sem=".$sem." and course='".$_SESSION['ca']."'"));	
		if($NULLR == $c['sub'])	mysqli_query($con,"update ".$_SESSION['ca']." set sem".$sem."=NULL where roll =".$roll);
		else mysqli_query($con,"update ".$_SESSION['ca']." set sem".$sem."='".$Q."' where roll =".$roll);	
		$msg = true;		
	}

	include_once("../common/super_common.php");					
	$row=mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from ".$_SESSION['ca']." where roll=".$roll));
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>SRMS</title>		
</head>
<body class="d-flex flex-column h-100">
	<?php include_once("../common/topbar.php");?>
	<div class="container-fluid">
        <div class="row">
						<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
					    <div class="sidebar-sticky pt-2">
					        <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
					            <span><strong>Teachers</strong></span><a class="d-flex align-items-center text-muted" href="account.php"><span data-feather="plus-circle"></span></a>
					        </h5>
					        <ul class="nav flex-column">
					        	<li class="nav-item"><a class="nav-link" id="dashboard" href="dashboard.php"><i class="bi bi-speedometer2"></i> Manage Result</a></li>
					        </ul>			   
					        <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
					            <span><strong> Account </strong></span><a class="d-flex align-items-center text-muted"><span data-feather="plus-circle"></span></a>
					        </h5>
					        <ul class="nav flex-column mb-2">
					            <li class="nav-item"><a class="nav-link" id="account" href="account.php"><i class="bi bi-gear"></i> Account</a></li>
					            <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
					        </ul>
					    </div>
						</nav>	
						<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
           		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        				<h1 class="h4">Result > Semester <?php echo $sem;?></h1>
				        <div class="btn-toolbar mb-2 mb-md-0">
				          <div class="btn-group mr-2">
				            <a href="<?php if($sem>1) echo "result.php?roll=".$_GET['roll']."&sem=".$sem-1; else echo "#";?>" class="btn btn-sm btn-outline-secondary">Previous</a>
				            <a class="btn btn-sm btn-secondary">Sem <?php echo $sem;?></a>
				            <a href="<?php if($sem< $_SESSION['semcount']) echo "result.php?roll=".$_GET['roll']."&sem=".$sem+1;else echo "#";?>" class="btn btn-sm btn-outline-secondary">Next</a>
				          </div>
				          <a id="back" ><button type="button" class="btn btn-sm btn-secondary">Back</button></a>
				        </div>
      				</div>
							<div class="row">	
							<div class="container-fluid"><?php if($msg) echo "
								<div class='alert alert-success' style='text-align:left;'>Result Updated</div>"; ?>
								<div class="table-responsive">
									<table class="table table-striped">
										<tbody>															
											<tr>
												<th class="u-data">Name: <?php echo $nm; ?></th>
												<th class="u-data">Roll No: <?php echo $_GET['roll']; ?></th>		
												<th class="u-data">Course: <?php echo strtoupper($_SESSION['ca']); ?></th>
												<th class="u-data">Semester: <?php echo $_GET['sem']; ?></th>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="table-responsive">
									<form method="post">
										<table class="table table-bordered table-striped table-hover table-condensed">
											<thead class="thead-dark"><tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit</th></tr></thead>
											<tbody> <?php if($row['sem'.$sem] !== NULL) include_once('update.php');
												else if($row['sem'.$sem] == "") include_once('insert.php');							
											?>
											</tbody>
										</table>
									</form>
								</div>	
							</div>
						</div>
					</main>
				</div>
			</div>	
	<?php include('../common/footer.php'); ?>
	<script src="../js/trestrict.js"></script>
	<script src="../js/backhref.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
</body>
</html>				