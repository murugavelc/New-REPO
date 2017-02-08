<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_det = '';
if(!isset($_SESSION['user_id'])){
    redirect('login');
}else{
    $user_det = $this->User_model->getUserById($_SESSION['user_id'],$_SESSION['user_type']);
    if(empty($user_det)){
        redirect('login');
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
    <title>BT TUT</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/custom.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>
</head>

<body class=" sidebar-xs">

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo BASE; ?>"><b>BT</b></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-git-compare"></i>
                    <span class="visible-xs-inline-block position-right">Git updates</span>
                    <span class="badge bg-warning-400">9</span>
                </a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-heading">
                        Git updates
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-sync"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body width-350">
                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                            </div>

                            <div class="media-body">
                                Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                <div class="media-annotation">4 minutes ago</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
                            </div>

                            <div class="media-body">
                                Add full font overrides for popovers and tooltips
                                <div class="media-annotation">36 minutes ago</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
                            </div>

                            <div class="media-body">
                                <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
                                <div class="media-annotation">2 hours ago</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
                            </div>

                            <div class="media-body">
                                <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
                                <div class="media-annotation">Dec 18, 18:36</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                            </div>

                            <div class="media-body">
                                Have Carousel ignore keyboard events
                                <div class="media-annotation">Dec 12, 05:46</div>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>
        </ul>

        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/flags/gb.png" class="position-left" alt="">
                    English
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
                    <li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
                    <li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
                    <li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
                    <li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">Messages</span>
                    <span class="badge bg-warning-400">2</span>
                </a>

                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        Messages
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-compose"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body">
                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">5</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">James Alexander</span>
                                    <span class="media-annotation pull-right">04:58</span>
                                </a>

                                <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">4</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Margo Baker</span>
                                    <span class="media-annotation pull-right">12:16</span>
                                </a>

                                <span class="text-muted">That was something he was unable to do because...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Jeremy Victorino</span>
                                    <span class="media-annotation pull-right">22:48</span>
                                </a>

                                <span class="text-muted">But that would be extremely strained and suspicious...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Beatrix Diaz</span>
                                    <span class="media-annotation pull-right">Tue</span>
                                </a>

                                <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Richard Vango</span>
                                    <span class="media-annotation pull-right">Mon</span>
                                </a>

                                <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                    <span><?php echo ($user_det->first_name == ''?$user_det->email : $user_det->first_name.' '.$user_det->last_name); ?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php echo BASE; ?>profile"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
                    <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="<?php echo BASE; ?>login/logout"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!--<div class="navbar navbar-default navbar-xs" id="navbar-second">-->
<!--    <ul class="nav navbar-nav no-border visible-xs-block">-->
<!--        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>-->
<!--    </ul>-->
<!---->
<!--    <div class="navbar-collapse collapse" id="navbar-second-toggle">-->
<!--        <ul class="nav navbar-nav">-->
<!--            <li class="active"><a href="#"><i class="icon-git-branch position-left"></i> Branches</a></li>-->
<!--            <li><a href="#"><i class="icon-git-merge position-left"></i> Merges <span class="badge badge-info badge-inline position-right">81</span></a></li>-->
<!--            <li><a href="#"><i class="icon-git-pull-request position-left"></i> Requests</a></li>-->
<!--        </ul>-->
<!---->
<!--        <ul class="nav navbar-nav navbar-right">-->
<!--            <li><a href="#"><i class="icon-upload10 position-left"></i> Upload files</a></li>-->
<!--            <li class="dropdown">-->
<!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                    <i class="icon-share4"></i>-->
<!--                    <span class="visible-xs-inline-block position-right">Share</span>-->
<!--                    <span class="caret"></span>-->
<!--                </a>-->
<!---->
<!--                <ul class="dropdown-menu dropdown-menu-right">-->
<!--                    <li><a href="#"><i class="icon-dribbble3"></i> Dribbble</a></li>-->
<!--                    <li><a href="#"><i class="icon-pinterest2"></i> Pinterest</a></li>-->
<!--                    <li><a href="#"><i class="icon-github"></i> Github</a></li>-->
<!--                    <li><a href="#"><i class="icon-stackoverflow"></i> Stack Overflow</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold"><?php echo ($user_det->first_name == ''?$user_det->email : $user_det->first_name.' '.$user_det->last_name); ?></span>
                                <div class="text-size-mini text-muted">
                                    <i class="icon-user text-size-small"></i> &nbsp;<?php echo $user_det->name; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <?php
                            $mparent = $this->uri->segment(1);
                            $mchild = $this->uri->segment(2);
                            ?>
                            <!-- Main -->
                            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li class="<?php echo ($mparent == 'dashboard')?'active':''; ?>"><a href="<?php echo BASE; ?>dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                            <li class="<?php echo ($mparent == 'projects')?'active':''; ?>">
                                <a href="#"><i class="icon-stack2"></i> <span>Projects</span></a>
                                <ul>
                                    <li class="<?php echo ($mparent == 'projects' && $mchild == '')?'active':''; ?>"><a href="">All Projects</a></li>
                                    <li ><a href="">Add New Project</a></li>
                                </ul>
                            </li>
                            <li class="<?php echo ($mparent == 'users')?'active':''; ?>">
                                <a href="#"><i class="icon-user-plus"></i> <span>Users</span></a>
                                <ul>
                                    <li class="<?php echo ($mparent == 'users' && $mchild == '')?'active':''; ?>"><a href="<?php echo BASE; ?>users">All Users</a></li>
                                    <li class="<?php echo ($mparent == 'users' && $mchild == 'add')?'active':''; ?>"><a href="<?php echo BASE; ?>users/add">Add New User</a></li>
                                </ul>
                            </li>
                            <li class="<?php echo ($mparent == 'roles')?'active':''; ?>">
                                <a href="#"><i class="icon-user-plus"></i> <span>User Roles</span></a>
                                <ul>
                                    <li class="<?php echo ($mparent == 'roles' && $mchild == '')?'active':''; ?>"><a href="<?php echo BASE; ?>roles">All Roles</a></li>
                                    <li class="<?php echo ($mparent == 'roles' && $mchild == 'add')?'active':''; ?>"><a href="<?php echo BASE; ?>roles/add">Add New Role</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->