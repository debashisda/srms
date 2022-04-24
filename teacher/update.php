<?php	
	$a=explode('|',$row['sem'.$sem]);
	for($i=0;$i<count($a);$i++) 
	{		
		$b=explode(':',$a[$i]);
		$subn = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='$b[0]'"));		
		echo "<tr>
				<td><input class='mark' type='text' name='".$b[0]."' value='".$b[0]."' readonly></td>
				<td class='smark'>".$subn['sub_name']."</td>
				<td><input type='text' class='data'  name='".$b[0].'A'."' id='".$b[0]."' value='".$b[1]."' onkeyup='check(this)' ></td>
				<td><input type='number' class='data' name='".$b[0].'B'."' id='".$b[0].'B'."' value='".$b[2]."' onkeyup='check(this)' ></td>
			</tr>";
	}
?>
<tr><td colspan='4' align='right'><button type='submit' class="btn btn-info btn-sm" name='update' id ='upload'>Update Result</button></td></tr>