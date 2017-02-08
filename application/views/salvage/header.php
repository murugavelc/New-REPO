<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_det = '';
if(!isset($_SESSION['user_id']) && !isset($_SESSION['sv_salvage_logged'])){
    redirect('salvage/login');
}else{
    $user_det = $this->User_model->getUserById($_SESSION['user_id'],$_SESSION['user_type']);
    if(empty($user_det)){
        redirect('salvage/login');
    }

    //echo'<pre>';print_r($user_det);echo '</pre>'; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salvage :: Salvage </title>

    <!-- Global stylesheets -->
<!--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
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
        <a class="navbar-brand" href="<?php echo SALVAGE_URL; ?>"><b>Salvage :: Salvage User</b></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav">
<!--            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>-->
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
                    <li><a href="<?php echo SALVAGE_URL; ?>profile"><i class="icon-user-plus"></i> My profile</a></li>
<!--                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>-->
<!--                    <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>-->
                    <li class="divider"></li>
<!--                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>-->
                    <li><a href="<?php echo SALVAGE_URL; ?>login/logout"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
<!--        <form class="navbar-form navbar-right">-->
<!--            <div class="form-group has-feedback">-->
<!--                <input type="search" id="ProjectSearch" class="form-control" placeholder="Search ...">-->
<!--                <div class="form-control-feedback">-->
<!--                    <i class="icon-search4 text-muted text-size-base"></i>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

