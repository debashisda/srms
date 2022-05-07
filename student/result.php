<?php
error_reporting(0);
session_start();
if(!($_SESSION['state'])) header('location:../logout.php');
$sem = $_GET['sem'];
if(!isset($sem) || ($sem<=0 || $sem > $_SESSION['RESULT_COUNT'])) header('location:dashboard.php');

function grade_to_marks($al_m)
{
	switch ($al_m) 
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

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $_SESSION['roll']." Sem ".$sem; ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/student.css">
</head>
<body>
	<?php include_once("nav.php"); ?>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>
					<tr><th class="c-name" colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>
					<tr><th class="u-data wide">NAME: <?php echo $_SESSION['name']; ?></th><th class="u-data">ROLL NO: <?php echo $_SESSION['roll']; ?></th></tr>			
					<tr><th class="u-data">COURSE: <?php echo strtoupper($_SESSION['course']); ?></th><th class="u-data">SEMESTER: <?php echo $sem; ?></th></tr>
				</tbody>
			</table>
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead><tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr></thead>
				<tbody>
				<?php		
				include_once("../common/super_common.php");
				$st = mysqli_fetch_assoc(mysqli_query($con,"SELECT sem".$sem." FROM ".$_SESSION['course']." WHERE roll=".$_SESSION['roll']))['sem'.$sem];	
				$c = 0;	$cp = 0;
				$a = explode('|',$st);				
				for($i=0; $i<count($a); $i++)
				{		
					$b=explode(':',$a[$i]);
					if($b[2] == NULL or $b[1] == NULL) continue;
					else
					{					
						$sn = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='".$b[0]."'"))['sub_name'];
						$nm = grade_to_marks($b[1]);
						echo "<tr>
								<td>".$b[0]."</td>
								<td class='sub-n'>".$sn."</td>
								<td>".$b[1]."</td>
								<td>".$nm."</td>
								<td>".$b[2]."</td>
								<td>".$nm*$b[2]."</td>
							  </tr>";
						$c+=$b[2];
						$cp+=($nm*$b[2]);
					}
				}
				mysqli_close($con);
				echo "<tr><td colspan='3'></td><th>Total</th><th>".$c."</th><th>".$cp."</th></tr>";
				$sgpa = round($cp/$c,2);
				?>					
				</tbody>
			</table>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tbody>
					<tr><th class="u-data" colspan='2'>RESULT</th></tr>
		    		<tr><th class="u-data wide">SGPA</th><th class="u-data"><?php echo $sgpa; ?></th></tr>
					<tr><th class="u-data">Result</th><th class="u-data"><?php echo ($sgpa>=5.6)?"Pass":"Fail"; ?></th></tr>
				</tbody>				
			</table>
		</div>
	</div>
</body>
</html>