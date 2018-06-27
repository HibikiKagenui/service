<!DOCTYPE html>
<html>
<head>
    <title>Panel Kasir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/united.bootstrap.min.css') ?>">
    <!-- jQuery -->
    <script src="<?php echo site_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
    <!-- Select2 -->
    <link href="<?php echo site_url('assets/css/select2.min.css') ?>" rel="stylesheet"/>
    <script src="<?php echo site_url('assets/js/select2.min.js') ?>"></script>
    <!-- Chart js -->
    <script src="<?php echo site_url('assets/js/Chart.min.js') ?>"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/styles.css') ?>">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
    <?php if ($this->session->userdata('isLoggedIn')) { ?>
        <button type="button" id="sidebarCollapse" class="btn btn-link">
            <span class="fas fa-bars fa-2x"></span>
        </button>
    <?php } ?>
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo site_url() ?>">
            <img src="<?php echo site_url('assets/img/logo.png') ?>" class="d-inline-block align-top" alt="Logo">
        </a>
    </div>
</nav>
<br><br>
<br><br><br>
<?php if ($this->session->flashdata('message') != null) { ?>
    <div class="col-md-6 mx-auto mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php } ?>
<div class="container-fluid p-4 m-auto">
    <div class="wrapper">

