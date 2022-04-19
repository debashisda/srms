<?php 
session_start();
if(!($_SESSION['state']))
{	
	header('location:../logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style type="text/css">
		.alert{
			margin-top: 10px;
			border-radius: 0px;
			text-align: right;
		}
		tr{ text-align: center; }		
		td{ border: 1px solid black !important; }	
	</style>	
</head>
<body>
	<?php include_once("../nav.php"); ?>
	<div class="alert alert-info"><strong>Welcome <?php echo $_SESSION['name']; ?></strong></div>	
	<!-- Table and it's body -->
	<div class="container" style="max-width: 100% !important;">
		<div class="table-responsive">			
		    <table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark">
		    		<tr>
		    			<!--th class="th-sm" style="width:10%">SL. No</th-->
		    			<th class="th-sm">Semester</th>
						<th class="th-md">Publication Date</th>
						<th class="th-sm" style="width:10%">Result</th> 
					</tr>
				</thead>
				<tbody>
				<?php
				include_once("../common/super_common.php");								
				$row = mysqli_fetch_assoc(mysqli_query($con,"select * from ".$_SESSION['course']." where roll=".$_SESSION['roll']));
				mysqli_close($con);					
				if($row >= 0)
				{
					for($i=1;$i<count($row);$i++)
					{
						if($row['sem'.$i]!=NULL)
						{
	 					echo "
	 					<tr>
	 						<!--td>".$i."</td-->
							<td>Semester ".$i."</td>
							<td>18-04-2022</td>
							<td><a href='result.php?sem=".$i."' class='btn btn-info btn-sm'>Result</a></td>
			 			</tr>";
			 			$_SESSION['RESULT_COUNT'] = $i;
						}   			
					}						
				}									 				
				?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
	 	document.getElementById("dashboard").remove();
	 	document.getElementById("print").remove();
	</script>	
</body>
</html>
