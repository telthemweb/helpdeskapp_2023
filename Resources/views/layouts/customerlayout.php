<?php

use Ti\Helpdesk\App\http\controllers\SessionManager;
$session = new SessionManager();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Customer Dashboard</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo url('assets/img/favicon.ico'); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/datatables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/chosen.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap-datepicker.min.css'); ?>"  type="text/css">

    <link rel="stylesheet" href="<?php echo url('assets/libs/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/fonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/sweetalert2.css'); ?>">
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand bg-white p-3 " href="<?php route('/company') ?>"><img src="<?php echo url('assets/img/favicon.ico'); ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
             
                <li class="nav-item">
               <a href="<?php route('/company/support')?>" class="nav-link " >
                      Tickets                
                  </a>
              </li>
              <li class="nav-item">
               <a href="<?php route('/company/profile') ?>" class="nav-link " >
                      My Profile                 
                  </a>
              </li>
               
                <li class="nav-item">
               <a href="<?php route('/logout');?>" class="nav-link">
                      Logout                
                  </a>
              </li>
            </ul>
        </div>
    </div>
</nav>