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
    <script src="<?php echo site_url('assets/js/Chart.min.js')?>"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/styles.css') ?>">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo site_url() ?>">
            <img src="<?php echo site_url('assets/img/logo.png') ?>" class="d-inline-block align-top" alt="">
        </a>
    </div>
</nav>
<br><br>
<br><br><br>
<?php if ($this->session->flashdata('message') != null) { ?>
    <div class="row mt-3" id="message-box">
        <div class="col-md-3 m-auto">
            <div class="card shadow-sm text-center">
                <div class="my-3 h6 text-danger">
                    <?php echo $this->session->flashdata('message') ?>
                </div>
                <button class="btn btn-primary" onclick="closeMessage()"><span class="fas fa-times"></span></button>
            </div>
        </div>
    </div>
<?php } ?>
<div class="container-fluid p-4 m-auto">
    <div class="row">
