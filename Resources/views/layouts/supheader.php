<?php

use App\http\Sessions;

require __DIR__ . './../../../helpers/Redirection.php';
require __DIR__ .'./../../../helpers/sessionutils.php';
$sess =new Sessions();
if (!isset($_SESSION['admin_id'] )) {
    Redirection::redirect('admin/login');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Support Helpdesk</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo url('img/favicon.ico'); ?>"/>

    <link rel="stylesheet" href="<?php echo url('css/bootstrap.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('css/dashboard.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('css/line-awesome.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('css/select2.min.css'); ?>"  type="text/css">
    <style>

    </style>

</head>
<body>

<div class="main-wrapper">
    <div class="header">

        <div class="header-left">
            <a href="<?php route('/dashboard') ?>" class="logo">
                <img src="<?php echo url('img/favicon.ico'); ?>" width="40" height="40" alt="">
            </a>
        </div>

        <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
            </span>
        </a>

        <div class="page-title-box">
            <h3>HelpDesk</h3>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

        <ul class="nav user-menu">

            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                   
                </div>
            </li>



            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="<?php echo url('img/avatar.png"'); ?>" alt="">
                <span class="status online"></span></span>
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php route('/profile'); ?>">My Profile</a>
                    <a class="dropdown-item" href="<?php route('/admin/logout'); ?>">Logout</a>
                </div>
            </li>
        </ul>


        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="<?php route('/profile'); ?>">My Profile</a>
                <a class="dropdown-item" href="<?php route('/admin/logout'); ?>">Logout</a>
            </div>
        </div>

    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <?php foreach ($allrole->modules() as $vamodule): ?>
                    <li class="menu-title">
                        <span><?php echo $vamodule->name; ?></span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa <?php echo $vamodule->icon; ?>"></i> <span> <?php echo $vamodule->name; ?></span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <?php foreach ($vamodule->submodules() as $dsmodule): ?>
                            <li><a href="<?php route('/'.  $dsmodule->url ); ?>"><?php echo $dsmodule->name; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>



