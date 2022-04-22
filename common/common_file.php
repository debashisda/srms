<?php

    //generates student details included in generate_result.php and teachers_dashboard_moredetails.php
    $con=mysqli_connect('127.0.0.1','root','','srms');
	$get_d="select * from stu_details where roll=".$roll;
	$res=mysqli_query($con,$get_d);
	$r=mysqli_fetch_assoc($res);	
	echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>"
	."<tr><th colspan='2'>NSHM COLLEGE OF  MANAGEMENT AND TECHNOLOGY</th></tr>"
	."<tr><td width='50%'>NAME: ".$r['name']."</td><td>ROLL NO: ".$roll."</td></tr>";
	$c=explode('_',$r['course']);				
	echo "<tr><td>COURSE: ".strtoupper($c[0])."</td><td>SEMESTER: </td></tr>"
	."<tr><td colspan='2'>REG. NO.: </td></tr></table><br>";
	
?>