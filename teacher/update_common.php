<?php	
	$sem = $_GET['sem'];
	$roll = $_GET['roll'];
	if($roll == NULL || $sem == NULL) header('location:dashboard.php');	
	$msg = false;
	extract($_POST);
	include_once("../common/super_common.php");
	if(isset($update))
	{		
		$Q="";$NULLR = 0;
		$sub_count = "SELECT COUNT(sub_code) as sub_c from subjects where sem =".$sem;
		$count = mysqli_fetch_assoc(mysqli_query($con,$sub_count));
		$count = $count['sub_c'];
		$res=mysqli_query($con,"select sub_code from subjects where course='bca' and sem=".$sem);		
		while($r=mysqli_fetch_assoc($res))
		{
			$nam = $r['sub_code'];
			$alp = ${$nam.'A'};
			$num = ${$nam.'B'};
			if($alp == NULL || $num == NULL) $NULLR++;			
			$Q = $Q.$nam.":".$alp.":".$num."|";		    
		}
		$Q = trim($Q,'|');		
		if($NULLR == $count) mysqli_query($con,"update bca set sem".$sem."=NULL where roll =".$roll);		
		else mysqli_query($con,"update bca set sem".$sem."='".$Q."' where roll =".$roll);		
		$msg = true;		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teachers Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style type="text/css">tr{ text-align: center; }td{ border: 1px solid black !important;}input:focus{outline: none;}
		nav{margin-bottom: 20px;}.mark{border: none; background: inherit; text-align: center;}.smark{text-align: left;}
		.bg-light{background-color: #cfe1f2 !important;}
	</style>	
</head>
<body>
	<?php include_once("nav.php"); ?>	
	<div class="container" style="max-width: 100% !important;">
		<?php
			if($msg)
			{
				echo "<div class='alert alert-success alert-dismissible' role='alert'>Result Updated
            			<button class='close' data-dismiss='alert'>&times;</button>
          	  		  </div>";
			}
		?>	
		<div class="table-responsive">
			<form method="post">
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead class="thead-dark"><tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit</th></tr></thead>
					<tbody>  		
					<?php	
						include_once("../common/super_common.php");					
						$row=mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from bca where roll=".$roll));	
						if($row['sem'.$sem] != NULL) include_once('update.php');
						else include_once('insert.php');							
					?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<script src="../js/backhref.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>				