<?php 

$sub = $_REQUEST['sub_name'];
$con = mysqli_connect('127.0.0.1','root','','srms');
$query ="select sub_name from subjects where sub_name like '$sub"."%'";
$result = mysqli_query($con,$query );
while ($row=mysqli_fetch_assoc($result)) 
{
	echo "<option>".$row['sub_name']."</options>";
}

?>