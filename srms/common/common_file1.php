<?php
	//updates the marks database included in teacher_update_marks.php and teacher_insert_marks.php	
	extract($_POST);
	if(isset($submit))
	{
		$con=mysqli_connect('127.0.0.1','root','','srms');
    	$query="select sub_code from subjects where course='BCA' and sub_sem=".$sem;
    	$res=mysqli_query($con,$query);
    	$str="";
    	while($r=mysqli_fetch_assoc($res))
    	{    	
    		$str=$str.$r['sub_code'].":".${$r['sub_code'].'A'} .":".${$r['sub_code'].'B'}."|";			  	
    	}
    	$str=substr($str,0,-1); 
    	$qu="update bca_marks set sem".$sem."='".$str."' where roll=".$roll;  
    	mysqli_query($con,$qu);
    	mysqli_close($con);
    	header("location:teachers_dashboard_moredetails.php?roll=".$roll);
	}
	
?>