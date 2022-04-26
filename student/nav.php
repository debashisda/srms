<?php
echo "<div class='navbar navbar-light bg-light'>
	<a class='navbar-brand'><img src='../css/bootstrap-solid.svg' height='30' class='d-inline-block align-top'> SRMS</a>
	<div class='my-sm-0'>
		<a href='dashboard.php' id='dashboard'><button type='button' class='btn btn-secondary btn-sm'>Dashboard</button></a>
		<button type='button' class='btn btn-info btn-sm' id='print' onclick='window.print()'>Print Result</button>
		<a href='../logout.php'><button type='button' class='btn btn-danger btn-sm'>Logout</button></a>
	</div>		
</div>";
?>
