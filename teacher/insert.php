<?php
	$row=mysqli_query($con,"select sub_code,sub_name from subjects where course='".$_SESSION['ca']."' and sem=".$sem);
	while($r=mysqli_fetch_assoc($row))
	{   
		$x=$r['sub_code'];
		echo "<tr>
		    	<td><input class='mark' type='text' name='".$x."' value='".$x."' readonly></td>
		    	<td class='smark'>".$r['sub_name']."</td>
		    	<td><input type='text'	 class='data' name='".$x.'A'."' id='".$x."'	    onkeyup='manage(this)'></td>
		    	<td><input type='number' class='data' name='".$x.'B'."' id='".$x.'B'."' onkeyup='manage(this)'></td>
		      </tr>"; 	  	
	}

?>
<tr><td colspan='4' align='right'><button type='submit' class="btn btn-info btn-sm" name='update' id ='upload' disabled>Update Result</button></td></tr>