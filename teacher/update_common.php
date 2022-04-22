<?php 
	error_reporting(0);
	$sem = $_GET['sem'];
	$roll = $_GET['roll'];

	if($roll == NULL || $sem == NULL)
	{
		header('location:dashboard.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teachers Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style type="text/css">
		tr{ text-align: center; }
		td{ border: 1px solid black !important;}
		input:focus{outline: none;}
		nav{margin-bottom: 20px;}
		.mark{border: none; background: inherit; text-align: center;}	
		.smark{text-align: left;}
		.bg-light{background-color: #cfe1f2 !important;}
	</style>	
</head>
<body>
	<?php include_once("nav.php"); ?>
	<div class="container" style="max-width: 100% !important;">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
		    	<thead class="thead-dark"><tr><th>Subject Code</th><th>Subjects Name</th><th>Letter Grade</th><th>Credit</th></tr></thead>
					<form method='post'>		
			