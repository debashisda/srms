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
		if($NULLR == $c['sub'])	$Q = NULL;			
		mysqli_query($con,"update ".$_SESSION['ca']." set sem".$sem."='".$Q."' where roll =".$roll);	
		$msg = true;		
	}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/teacher.css">
	<title>SRMS</title>		
</head>
<body class="d-flex flex-column h-100">
		<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-light border-bottom">
			<h5 class="my-0 mr-md-auto font-weight-normal">SRMS</h5>
			<nav class="my-2 my-md-0">   
				<a href="dashboard.php" class="btn btn-secondary btn-sm">Dashboard</a>		    			
				<a href="account.php" class="btn btn-primary btn-sm">Account</a>
				<a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
			</nav>  
		</div>
	</header>	
	<div class="container">
		<?php if($msg) echo "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>Result Updated<button class='close' data-dismiss='alert'>&times;</button></div>"; ?>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>	
				<style type="text/css">.u-data{width: 25%;}.bg-light{background:#cfe1f2 ;}</style>				
					<tr>
						<th class="u-data">NAME: <?php echo $nm; ?></th>
						<th class="u-data">ROLL NO: <?php echo $_GET['roll']; ?></th>		
						<th class="u-data">COURSE: <?php echo strtoupper($_SESSION['ca']); ?></th>
						<th class="u-data">SEM: <?php echo strtoupper($_GET['sem']); ?></th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="table-responsive">
			<form method="post">
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead class="thead-dark"><tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit</th></tr></thead>
					<tbody>  		
					<?php	
						include_once("../common/super_common.php");					
						$row=mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from ".$_SESSION['ca']." where roll=".$roll));	
						if($row['sem'.$sem] !== NULL) include_once('update.php');
						else include_once('insert.php');							
					?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>
	<script src="../js/trestrict.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>				