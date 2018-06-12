<!DOCTYPE html>
<html>
<head>
	<title>Panel Kasir</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width = device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <link rel="stylesheet" href="<? echo site_url('assets/css/jquery-ui.min.css') ?>">
    <script src="<? echo site_url('assets/js/jquery.js')?>"></script>
    <script src="<? echo site_url('assets/js/jquery-ui.min.js')?>"></script>
	<!-- FontAwesome -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
	<!-- JBox
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://code.jboxcdn.com/0.4.9/jBox.min.js"></script>
	<link href="https://code.jboxcdn.com/0.4.9/jBox.css" rel="stylesheet">
	<script>
		var tooltip = new jBox('Tooltip', {attach: '.tooltip'});
		tooltip.attach();
	</script> -->
	<style>
		.navbar-header {
			float: left;
			padding: 15px;
			text-align: center;
			width: 100%;
		}
		.navbar-brand {
			float:none;
		}
		body {
			background-color: whitesmoke;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url() ?>">
				<img src="<?php echo site_url('assets/img/logo.png') ?>" class="d-inline-block align-top" alt="">
			</a>
		</div>
	</nav>
	<div class="container-fluid p-5 m-auto">
		<div class="row">
