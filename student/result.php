<?php
error_reporting(0);
session_start();
if(!($_SESSION['state'])) header('location:../logout.php');
$sem = $_GET['sem'];
if(!isset($sem) || ($sem<=0 || $sem > $_SESSION['RESULT_COUNT'])) header('location:dashboard.php');
include_once("../common/super_common.php");
$st = mysqli_fetch_assoc(mysqli_query($con,"SELECT sem".$sem." FROM ".$_SESSION['course']." WHERE roll=".$_SESSION['roll']))['sem'.$sem];
$sl = mysqli_query($con,"SELECT sub_code,sub_name from subjects where course='".$_SESSION['course']."' and sem=".$sem);
mysqli_close($con);
?>
<!DOCTYPE html>
<html class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/student.css">
	<title><?php echo $_SESSION['roll']." Sem ".$sem; ?></title>
	<script>
	<?php		
		echo " 	var d = {";
		while($r = mysqli_fetch_assoc($sl))
			echo "'".$r["sub_code"]."'".":"."'".$r["sub_name"]."',";
		echo "};
		var c = '".$st."';";
	?>
	</script>
</head>
<body class="d-flex flex-column h-100">
	<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-light border-bottom">
		  <h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
		  <nav class="my-2 my-md-0">   
		    	<a href='dashboard.php' class='btn btn-secondary btn-sm'>Dashboard</a>
				<button type='button' class='btn btn-info btn-sm' onclick='window.print()'>Download</button>
				<a href='account.php' class='btn btn-primary btn-sm'>Account</a>	
				<a href='../logout.php' class='btn btn-danger btn-sm'>Logout</a>
		  </nav>  
		</div>
	</header>	
	<div class="container">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody id="rs-0">
					<tr><th class="c-name" colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>
					<tr><th>NAME: <?php echo $_SESSION['name']; ?></th><th>ROLL NO: <?php echo $_SESSION['roll']; ?></th></tr>		
					<tr><th>COURSE: <?php echo strtoupper($_SESSION['course']); ?></th><th>SEMESTER: <?php echo $sem; ?></th></tr>
				</tbody>
			</table>
		</div>
		<div class="table-responsive">
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead><tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr></thead>
				<tbody id="rs-1"></tbody>
			</table>
		</div>		
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody id="rs-2">
					<tr><th class="u-data" colspan='2'>RESULT</th></tr>						    	
				</tbody>				
			</table>
		</div>
	</div>	
	<?php include_once('../common/footer.php');?>
	<script src="../js/generateresult.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>