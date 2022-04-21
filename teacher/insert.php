<?php 	
	include_once("update_common.php");
	include_once("../common/super_common.php");
	$row=mysqli_query($con,"select sub_code,sub_name from subjects where course='bca' and sem=".$sem);
	while($r=mysqli_fetch_assoc($row))
	{   
		$x=$r['sub_code'];
		echo "<tr>
		    	<td><input class='mark' type='text' name='".$x."' value='".$x."' readonly='true'></td>
		    	<td class='smark'>".$r['sub_name']."</td>
		    	<td width='150px'><input type='text' id='".$x."' name='".$x.'A'."' onkeyup='manage(this)'></td>
		    	<td width='150px'><input type='number' id='".$x.'B'."' name='".$x.'B'."' disabled required></td>
		      </tr>"; 	  	
	}		    										
?>
<tr><td colspan='4' align='right'>
<button type='submit' class="btn btn-info btn-sm" name='update' id ='update' disabled>Upload Result</button></td></tr></form>
</table></div></div>
<script src="../js/backhref.js"></script>
</body></html>
<?php include_once("upload.php"); ?>