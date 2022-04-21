<?php
	extract($_POST);
	
	if(isset($rmres))
	{		
		mysqli_query($con,"update bca set sem".$sem."=NULL where roll=".$roll);
		mysqli_close($con);
		header("location:moredetails.php?roll=".$roll);		
	}

	if(isset($update))
	{		
		$res=mysqli_query($con,"select sub_code from subjects where course='bca' and sem=".$sem);
		$Q="";
		while($r=mysqli_fetch_assoc($res))
		{   
		    $x=$r['sub_code'];
		    $Q = $Q.$x.":".${$x.'A'}.":".${$x.'B'}."|";  	
		}
		$Q = trim($Q,'|');
		$query = "update bca set sem".$sem."='".$Q."' where roll =".$roll;
		mysqli_query($con,$query);
		mysqli_close($con);
		header("location:moredetails.php?roll=".$roll);		
	}
?>