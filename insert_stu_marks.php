<html>
<head>
	<title>Student Result</title>
</head>
<body>
<?php 

    $con=mysqli_connect('127.0.0.1','root','','srms');
    $query="select sub_code,sub_name from subjects where course='BCA' and sub_sem=4";
    $res=mysqli_query($con,$query);    
    echo "<table border='2' cellspacing='2' cellpadding='3' align='center' width='900px'>";
	echo "<tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit Points</th></tr>";
	echo "<form method='post'>";
	while($r=mysqli_fetch_assoc($res))
    {   
    	$x=$r['sub_code'];
    	echo "<tr>
    			<td><input type='text' name='".$x."' value='".$x."' readonly></td>
    			<td>".$r['sub_name']."</td>
    			<td width='150px'><input type='text' name='".$x.'A'."'></td>
    			<td width='150px'><input type='number' name='".$x.'B'."'></td>
    		</tr>";  	  	
    }   
   	echo "<input type='submit' name='submit'></form>"; 
	echo "</table><br>";
	mysqli_close($con);	
?>

<?php
	extract($_POST);
	if(isset($submit))
	{
		$con=mysqli_connect('127.0.0.1','root','','srms');
    	$query="select sub_code from subjects where course='BCA' and sub_sem=4";
    	$res=mysqli_query($con,$query);
    	while($r=mysqli_fetch_assoc($res))
    	{    	
    		echo $r['sub_code'].":".${$r['sub_code'].'A'} .":".${$r['sub_code'].'B'}."<br>";    			  	
    	}
    	mysqli_close($con);
	}
?>

</body>
</html>


