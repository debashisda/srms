<?php
error_reporting(0);
session_start();
if(!($_SESSION['state']))
{	
	header('location:../logout.php');
}

$sem = $_GET['sem'];

if(!isset($sem) || ($sem<=0 || $sem > $_SESSION['RESULT_COUNT']))
{
	header('location:dashboard.php');
}
	
function grade_to_marks($al_m)
{
	if($al_m == 'O') return 10;
	elseif ($al_m == 'E') return 9;
	elseif ($al_m == 'A') return 8;		
	elseif ($al_m == 'B') return 7;
	elseif ($al_m == 'C') return 6;
	elseif ($al_m == 'D') return 5;
	else return 4;		
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<title>Result</title>
	<style type="text/css">
		.container{	margin-top: 10px;}
		tr{text-align: center;}
		td,th{border: 1px solid black !important;padding: 10px !important;}
		.c-name{font-size: 20px;}
		.u-data{text-align: left;}
		.sub-n{	text-align: left;}
		.bg-light{background-color: #cfe1f2 !important;}
		.wide{width: 50%;}	
	</style>
</head>
<body>
	<?php include_once("nav.php"); ?>
	<div id = "container" class="container" style="max-width: 100% !important;">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>
					<tr><th class="c-name" colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>
					<tr><th class="u-data wide">NAME: <?php echo $_SESSION['name']; ?></th><th class="u-data">ROLL NO: <?php echo $_SESSION['roll']; ?></th></tr>			
					<tr><th class="u-data">COURSE: <?php echo strtoupper($_SESSION['course']); ?></th><th class="u-data">SEMESTER: <?php echo $sem; ?></th></tr>
				</tbody>
			</table>
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead>
		    		<tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr>
				</thead>
				<tbody>
				<?php				
				$t = "</td><td>";				
				$credit = 0;
				$credit_points = 0;
				$query = "select sem".$sem." from ".$_SESSION['course']." where roll=".$_SESSION['roll'];
				include_once("../common/super_common.php");
				$stu_result = mysqli_fetch_assoc(mysqli_query($con,$query));
				$a = explode('|',$stu_result['sem'.$sem]);		
				$p = False;
				for($i=0;$i<count($a);$i++)
				{		
					$b=explode(':',$a[$i]);
					if($b[2] == NULL || $b[1] == NULL)
					{
						$p=True;
						continue;
					}
					else
					{					
						$sub_name = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='".$b[0]."'"));
						$num_marks = grade_to_marks($b[1]);
						echo "<tr><td>".$b[0]."</td><td class='sub-n'>".$sub_name['sub_name'].$t.$b[1].$t.$num_marks.$t.$b[2].$t.$num_marks*$b[2]."</td></tr>";
						$credit+=$b[2];
						$credit_points+=($num_marks*$b[2]);
					}
				}
				mysqli_close($con);
				echo "<tr><td colspan='3'></td><th>Total</th><th>".$credit."</th><th>".$credit_points."</th></tr>";
				$sgpa = round($credit_points/$credit,2);
				?>					
				</tbody>
			</table>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>
					<tr><th class="u-data" colspan='2'>RESULT</th></tr>
		    		<tr><th class="u-data wide">SGPA</th><th class="u-data"><?php echo $sgpa;  if($p){ echo " <i>*Partial Result</i>";}?></th></tr>
					<tr><th class="u-data">Result</th><th class="u-data"><?php echo ($sgpa>=5.6)?"Pass":"Fail"; ?></th></tr>
				</tbody>				
			</table>
		</div>
	</div>
</body>
</html>