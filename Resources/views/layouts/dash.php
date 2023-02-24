<?php

use Ti\Helpdesk\App\http\controllers\SessionManager;
use Ti\Helpdesk\App\Model\Employeetask;
$session = new SessionManager();
$emp =  Employeetask::whereadministrator_id($_SESSION['admin_id'])->wherestatus('Pending')->get();
$employeetask=$emp->count();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Administrator Dashboard</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo url('assets/img/favicon.ico'); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/jquery.dataTables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/chosen.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap-datepicker.min.css'); ?>"  type="text/css">
   <link rel="stylesheet" href="<?php echo url('assets/libs/css/datatables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/fonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/style.blue.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/libs/css/sweetalert2.css'); ?>">
</head>
<body>
<header class="header" id="myHeader">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="<?php route('/dashboard');?>" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            <li class="nav-item">
                <form id="searchForm" class="ml-auto d-none d-lg-block">
                    <div class="form-group position-relative mb-0">
                        <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                        <input type="search" class="form-control form-control-sm border-0 no-shadow pl-4">
                    </div>
                </form>
            </li>
            <li class="nav-item dropdown mr-3"><a id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
                <div aria-labelledby="notifications" class="dropdown-menu">
                    <?php if($_SESSION['role_Id']=='3'): ?>
                    <a href="<?php route('/technician/mytasks');?>" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-sm bg-violet text-white"></div>
                            <div class="text ml-2"><i class="fa fa-hands-helping"></i>
                                <p class="mb-0">You have <?php echo $employeetask==null?"0":$employeetask ?> new support tickets</p>
                            </div>
                        </div>
                    </a>
                <?php endif ?>
            </li>
            <li class="nav-item dropdown ml-auto">
                <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <img src="<?php echo url('assets/img/avatar.png'); ?>" alt="Profile Picture" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow">
                </a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                    <a href="<?php route('/profile');?>" class="dropdown-item">
                        <strong class="d-block text-uppercase headings-font-family" id="flname" >
                            <span><i class="fa fa-user"></i> <?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?></span>
                        </strong>
                    </a>
                   
                    <div class="dropdown-divider"></div>
                    <a href="<?php route('/profile');?>" class="dropdown-item"><i class="fa fa-cog"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php route('/changepassword/userid/'.$_SESSION['admin_id'] );?>" class="dropdown-item"><i class="fa fa-lock"></i> Change Password</a>
                    <div class="dropdown-divider"></div><a href="<?php route('/admin/logout');?>" class="dropdown-item" ><i class="fa fa-sign-out-alt"></i> Logout</a>

                </div>
            </li>
        </ul>
    </nav>
</header>
<div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MY DASHBOARD</div>
        <ul class="sidebar-menu list-unstyled">
         <?php if($_SESSION['role_Id']=="1" || $_SESSION['role_Id']=="2"): ?>
            <li class="sidebar-list-item " >
            <a href="<?php route('/companies');?>" class="sidebar-link text-muted nav-link" >
            <i class="fa fa-home mr-3 text-gray"></i><span>COMPANY </span></a>
            </li>
         
        
        <li class="sidebar-list-item " >
        <a href="<?php route('/employees');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-users mr-3 text-gray"></i><span>EMPLOYEES</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/categories');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-folder mr-3 text-gray"></i><span>CATEGORIES</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/tickets');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-ticket-alt mr-3 text-gray"></i><span>TICKETS</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/tasks');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-tasks mr-3 text-gray"></i><span>TASKS</span></a>
        </li>
        <li class="sidebar-list-item dropdown" >
        <a href="#" class="sidebar-link text-muted nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-home mr-3 text-gray"></i><span>ACCOUNTS</span> </a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/invoices');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file mr-3 text-gray"></i><span>INVOICES</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/payments');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file mr-3 text-gray"></i><span>PAYMENTS</span></a>
        </li>
       
        <li class="sidebar-list-item " >
        <a href="<?php route('/penalties');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file mr-3 text-gray"></i><span>PENALTIES</span></a>
        </li>
        <li class="sidebar-list-item dropdown" >
        <a href="#" class="sidebar-link text-muted nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-home mr-3 text-gray"></i><span>REPORTS</span> </a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/reports/payements');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file mr-3 text-gray"></i><span>PAYMENTS</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/reports/invoices');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file-invoice mr-3 text-gray"></i><span>PAID INVOICES</span></a>
        </li>
         <li class="sidebar-list-item " >
        <a href="<?php route('/reports/notpaidinvoices');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file-invoice mr-3 text-gray"></i><span>UNPAID INVOICES</span></a>
        </li>
         <li class="sidebar-list-item " >
        <a href="<?php route('/reports/penalties');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-file-invoice mr-3 text-gray"></i><span>PENALTIES</span></a>
        </li>
        <?php endif; ?>
        

        <?php if($_SESSION['role_Id']=="1"): ?>
        <li class="sidebar-list-item dropdown" >
        <a href="#" class="sidebar-link text-muted nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cogs mr-3 text-gray"></i><span>SYSTEM CONFIGURATIONS</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/roles');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-lock mr-3 text-gray"></i><span>ROLES</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/permissions');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-link mr-3 text-gray"></i><span>PERMISSIONS</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/audits');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-tasks mr-3 text-gray"></i><span>AUDIT TAIL</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/logs');?>" class="sidebar-link text-muted nav-link" >
        <i class="fa fa-database mr-3 text-gray"></i><span>SYSTEM LOGS</span></a>
        </li>
        

        <?php endif; ?>
        <?php if($_SESSION['role_Id']=="3"): ?>
        <a href="#" class="sidebar-link text-muted nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false>
        <i class="fa fa-home mr-3 text-gray"></i><span>MY ACCOUNT</span>
        
            <li class="sidebar-list-item mb-5" >
            <a href="<?php route('/technician/mytasks');?>" class="sidebar-link text-muted nav-link" >
            <i class="fa fa-tasks mr-3 text-gray"></i><span>TASK</span></a>
            </li>
           
        <?php endif; ?>
        
       <p class="mb-5"></p>
        <li class="sidebar-list-item bg-red text-white" >
        <a href="<?php route('/admin/logout');?>" class="sidebar-link text-muted nav-link " >
        <i class="fa fa-sign-out-alt mr-3 text-gray text-white"></i><span class="text-white">LOGOUT</span></a>
        </li>
        </ul>
    </div>
    <div class="page-holder w-100 d-flex flex-wrap">



