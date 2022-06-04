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
			<table class="table table-bordered table-striped table-hover">
				<tbody id="rs-0">
					<tr><th colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>
					<tr><th>NAME: <?php echo $_SESSION['name'];?></th><th>ROLL NO: <?php echo $_SESSION['roll'];?></th></tr>		
					<tr><th>COURSE: <?php echo strtoupper($_SESSION['course']);?></th><th>SEMESTER: <?php echo $sem;?></th></tr>
				</tbody>
			</table>
		</div>
		<div class="table-responsive">
		    <table class="table table-bordered table-striped table-hover">
		    	<thead><tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr></thead>
				<tbody id="rs-1"></tbody>
			</table>
		</div>		
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<tbody id="rs-2"><tr><th colspan='2'>RESULT</th></tr></tbody>				
			</table>
		</div>
	</div>	
	<script type="text/javascript">
		var a = c.split('|');	
		var cs = 0;
		var cps = 0;
		var sgpa = 0;
		function gm(l)
		{
		    switch(l)
		    {
		       	case 'O' : return 10;
		        case 'E' : return 9;
		        case 'A' : return 8;
		        case 'B' : return 7;
		        case 'C' : return 6;
		        case 'D' : return 5;
		        default  : return 4;
		    }
		}
		var t1 = document.getElementById("rs-1");
		for(var i=0; i<a.length; i++)
		{	
			var b = a[i].split(':');
			if(b[1].length<1 || b[2].length<1) continue;
			else
			{
				var r = t1.insertRow(-1);
				var n = gm(b[1]);                   
				r.insertCell(0).innerHTML = b[0];
				r.insertCell(1).innerHTML = d[b[0]];
				r.insertCell(2).innerHTML = b[1];
				r.insertCell(3).innerHTML = n;
				r.insertCell(4).innerHTML = b[2];
				r.insertCell(5).innerHTML = (n*b[2]);
				cs+=parseInt(b[2]);
				cps+=parseInt(n*b[2]);
			}
		}
		var r = t1.insertRow(-1);
		r.insertCell(0).innerHTML = "";
		r.insertCell(1).innerHTML = "";
		r.insertCell(2).innerHTML = "";
		r.insertCell(3).innerHTML = "Total";
		r.insertCell(4).innerHTML = cs;
		r.insertCell(5).innerHTML = cps;
		sgpa = parseFloat(cps/cs).toFixed(2);
		var t2 = document.getElementById("rs-2");
		var r = t2.insertRow(-1);
		r.insertCell(0).innerHTML = "SGPA";
		r.insertCell(1).innerHTML = sgpa;
		var r = t2.insertRow(-1);
		r.insertCell(0).innerHTML = "Result";
		r.insertCell(1).innerHTML = (sgpa>=5.6)?"Pass":"Fail";
	</script>
	<?php include_once('../common/footer.php');?>	
</body>
</html>