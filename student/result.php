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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="../css/student.css">
	<link rel="stylesheet" href="../css/admin.css">	
	<title><?php echo $_SESSION['roll']." Sem ".$sem; ?></title>
	<script type="text/javascript">
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
	<?php include_once("../common/topbar.php");?> 
	<div class="container-fluid" style="max-width: 100% !important;">      
        <div class="row">
      		<?php include_once("sidebar.php");?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h4">Result > Semester <?php echo $sem;?> </h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                  <a href="<?php if($sem>1) echo "result.php?sem=".$sem-1; else echo "#";?>" class="btn btn-sm btn-outline-secondary">Previous</a>
                  <a class="btn btn-sm btn-secondary">Sem <?php echo $sem;?></a>
                  <a href="<?php if($sem<$_SESSION['RESULT_COUNT']) echo "result.php?sem=".$sem+1; else echo "#";?>" class="btn btn-sm btn-outline-secondary">Next</a>
                </div>
                <button type="button" class="btn btn-sm btn-secondary" id="dwn-rs">Download</button>
              </div>
            </div>
            <div class="container pr-0 pl-0" id="rs">
              <div class="table-responsive">
                <table class="table  table-striped table-hover">
                  <thead class="thead-dark h5"><tr><th colspan="3">NSHM COLLEGE OF MANAGEMENT AND TECHNOLOGY</th></tr></thead>
                  <tbody id="rs-0">
                    <tr></tr>
                    <tr><th>NAME: <?php echo $_SESSION['name'];?> </th><th>ROLL NO: <?php echo $_SESSION['roll'];?> </th></tr>
                    <tr><th>COURSE: <?php echo strtoupper($_SESSION['course']);?> </th><th>SEMESTER: <?php echo $sem;?> </th></tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead class="thead-dark"><tr><th>Subject Code</th><th>Subjects Offered</th><th>Letter Grade</th><th>Points</th><th>Credit</th><th>Credit Points</th></tr></thead>
                  <tbody id="rs-1"></tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead class="thead-dark"><tr><th colspan="3" align="left">RESULT</th></tr></thead>
                  <tbody id="rs-2"></tbody>
                </table>
              </div>
            </div>
          </main>
        </div>
      </div>
      <script type="text/javascript">
	      var a = c.split('|');
	      var cs = 0;
	      var cps = 0;
	      var sgpa = 0;

	      function grade_to_marks(l) 
	      {
	        switch (l) 
	        {
	          case 'O': return 10;
	          case 'E': return 9;
	          case 'A': return 8;
	          case 'B': return 7;
	          case 'C': return 6;
	          case 'D': return 5;
	          default:  return 4;
	        }
	      }
	      
	      var t1 = document.getElementById("rs-1");
	      for (var i = 0; i < a.length; i++) 
	      {
	        var b = a[i].split(':');
	        if (b[1].length < 1 || b[2].length < 1) continue;
	        else 
	        {
	          var r = t1.insertRow(-1);
	          var n = grade_to_marks(b[1]);
	          r.insertCell(0).innerHTML = b[0];
	          r.insertCell(1).innerHTML = d[b[0]];
	          r.insertCell(2).innerHTML = b[1];
	          r.insertCell(3).innerHTML = n;
	          r.insertCell(4).innerHTML = b[2];
	          r.insertCell(5).innerHTML = (n * b[2]);
	          cs += parseInt(b[2]);
	          cps += parseInt(n * b[2]);
	        }
	      }
	      var r = t1.insertRow(-1);
	      r.insertCell(0).innerHTML = "";
	      r.insertCell(1).innerHTML = "";
	      r.insertCell(2).innerHTML = "";
	      r.insertCell(3).innerHTML = "Total";
	      r.insertCell(4).innerHTML = cs;
	      r.insertCell(5).innerHTML = cps;
	      sgpa = parseFloat(cps / cs).toFixed(2);
	      var t2 = document.getElementById("rs-2");
	      var r = t2.insertRow(-1);
	      r.insertCell(0).innerHTML = "SGPA";
	      r.insertCell(1).innerHTML = sgpa;
	      var r = t2.insertRow(-1);
	      r.insertCell(0).innerHTML = "Result";
	      r.insertCell(1).innerHTML = (sgpa >= 5.6) ? "Pass" : "Fail";
	</script>
    <?php include_once('../common/footer.php');?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>document.getElementById("dwn-rs").addEventListener('click',function(){
        var opt = {margin:0.3,filename: document.title,image:{type:'jpeg',quality:1},html2canvas:{scale:2},jsPDF:{unit:'in',format:'A4',orientation:'landscape'}};
        html2pdf().from(document.getElementById("rs")).set(opt).save();});
    </script>
  </body>
</html>