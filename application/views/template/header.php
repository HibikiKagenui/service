<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width = device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<script defer src="js/fontawesome-all.js"></script>
	<style>
		.navbar-header {
			float: left;
			padding: 15px;
			text-align: center;
			width: 100%;
		}
		.navbar-brand {float:none;}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url() ?>">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php if($this->session->userdata('isLoggedIn')) { ?>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto"></ul>
					<span class="navbar-text">
						Welcome, <?php echo $this->session->userdata('nama') ?>
					</span>
					<a class="btn btn-primary my-2 my-sm-0 mx-2" href="<?php echo site_url('process/logout')?>">Logout</a>
				</div>
			<?php } ?>
		</div>
	</nav>
	<div class="container p-5 m-auto">