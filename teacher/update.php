<?php	
	include_once("update_common.php");
	include_once("../common/super_common.php");
	$row=mysqli_fetch_assoc(mysqli_query($con,"select sem".$sem." from bca where roll=".$roll));	
	if($row['sem'.$sem] == NULL)
	{
		header("location:insert.php?roll=".$roll."&sem=".$sem);
	}	
	$a=explode('|',$row['sem'.$sem]);
	for($i=0;$i<count($a);$i++) 
	{		
		$b=explode(':',$a[$i]);		
		$subn = mysqli_fetch_assoc(mysqli_query($con,"select sub_name from subjects where sub_code='$b[0]'"));		
		echo "<tr>
			<td><input class='mark' type='text' name='".$b[0]."' value='".$b[0]."' readonly></td>
			<td class='smark'>".$subn['sub_name']."</td>
			<td><input type='text' name='".$b[0].'A'."' value='".$b[1]."' id='".$b[0]."'></td>
			<td><input type='number' name='".$b[0].'B'."' value='".$b[2]."' id='".$b[0].'B'."' ></td>
		</tr>";
	}						
?>

<tr><td colspan='4' align='right'>
<button type='submit' class="btn btn-danger btn-sm" name='rmres'>Remove Result</button>
<button type='submit' class="btn btn-info  btn-sm" id='upload' name='update'>Update Result</button>
</td></tr></form></table><script src="../js/backhref.js"></script></body></html>
<?php include_once("upload.php"); ?>
