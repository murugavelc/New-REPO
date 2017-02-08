<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_det = '';
GLOBAL $USER_ROLES;
//print_r($_SESSION);
if(isset($_SESSION['sv_logged']) && ($_SESSION['user_type'] != 4)){
    $user_det = $this->User_model->getUserById($_SESSION['user_id'],$_SESSION['user_type']);
    if(empty($user_det)){
        redirect('admin/login');
    }
}else{
    redirect('admin/login');
    //echo'<pre>';print_r($user_det);echo '</pre>'; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salvage :: Admin Panel</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/ui/prism.min.js"></script>
<!--    <script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/navbar_multiple.js"></script>-->
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.mCustomScrollbar.css">
</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse ">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo ADMIN_URL; ?>"><b>Salvage :: <?php echo $USER_ROLES[$user_det->user_type]; ?></b></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <?php if($user_det->profile_img != '' && file_exists('./uploads/users/'.$user_det->user_id.'/'.$user_det->profile_img)){ ?>
                        <img src="<?php echo BASE.'uploads/users/'.$user_det->user_id.'/'.$user_det->profile_img; ?>" alt="">
                    <?php }else{ ?>
                        <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                    <?php } ?>
<!--                    <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" alt="">-->
                    <span><?php echo ($user_det->first_name == ''?$user_det->email : $user_det->first_name.' '.$user_det->last_name); ?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php echo ADMIN_URL; ?>profile"><i class="icon-user"></i> My profile</a></li>
                    <li><a href="<?php echo ADMIN_URL; ?>profile/change_password"><i class="icon-lock2"></i> Change Password</a></li>
<!--                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>-->
<!--                    <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>-->
                    <li class="divider"></li>
<!--                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>-->
                    <li><a href="<?php echo ADMIN_URL; ?>login/logout"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <?php
                            $mparent = $this->uri->segment(2);
                            $mchild = $this->uri->segment(3);
                            ?>
<!--                            <li class="--><?php //echo ($mparent == 'dashboard')?'active':''; ?><!--"><a href="--><?php //echo ADMIN_URL; ?><!--dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>-->
                            <li class="<?php echo ($mparent == 'products')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>products"><i class="icon-basket"></i> <span>Bidding Management</span></a></li>
                            <?php if($user_det->user_type == 1 || $user_det->user_type == 2){ ?>
                            <li class="<?php echo ($mparent == 'users')?'active':''; ?>">
                                <a href="<?php echo ADMIN_URL; ?>users"><i class="icon-user-plus"></i> <span>Users Management</span></a>
                                <ul>
                                    <li class="<?php echo ($mparent == 'users' && $mchild == '')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>users">Bidders</a></li>
                                    <?php if($user_det->user_type == 1){ ?>
                                        <li class="<?php echo ($mparent == 'users' && $mchild == 'admins')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>users/admins">Salvage Admins</a></li>
                                        <li class="<?php echo ($mparent == 'users' && $mchild == 'super_admins')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>users/super_admins">Super Admin Users</a></li>
                                        <li class="<?php echo ($mparent == 'users' && $mchild == 'approvers')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>users/approvers">Approvers</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="<?php echo ($mparent == 'reports')?'active':''; ?>">
                                <a href="<?php echo ADMIN_URL; ?>reports"><i class="icon-user-plus"></i> <span>Reports</span></a>
                                <ul>
                                    <li class="<?php echo ($mparent == 'reports' && $mchild == 'winnings')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>reports/winnings">Winning Reports</a></li>
                                    <li class="<?php echo ($mparent == 'reports' && $mchild == 'in_yard')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>reports/in_yard">Vehicle In Yard</a></li>
<!--                                    <li class="--><?php //echo ($mparent == 'reports' && $mchild == 'document_transfer')?'active':''; ?><!--"><a href="--><?php //echo ADMIN_URL; ?><!--reports/document_transfer">Document Transfer Reports</a></li>-->
                                    <li class="<?php echo ($mparent == 'reports' && $mchild == 'product_biddings')?'active':''; ?>"><a href="<?php echo ADMIN_URL; ?>reports/product_biddings">Product Biddings Report</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->

