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
			<?php include_once("sidebar.php");?>	
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  	<h1 class="h2">Result</h1>
                  	<div class="btn-toolbar mb-2 mb-md-0">
			          <div class="btn-group me-2">
			            <a id="back" ><button type="button" class="btn btn-sm btn-outline-secondary">Back</button></a>	           
			          </div>          
        			</div>                  	  
               	</div>
				<div class="row">	
					<div class="container-fluid">				
						<?php if($msg) echo "<div class='alert alert-success alert-dismissible' role='alert' style='text-align:left;'>Result Updated</div>"; ?>
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
										else if($row['sem'.$sem] == "")
											include_once('insert.php');							
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
</body>
</html>				