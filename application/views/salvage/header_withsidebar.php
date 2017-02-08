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

<body>

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
        </ul>
        <form class="navbar-form navbar-left">
            <div class="form-group has-feedback">
                <input type="search" class="form-control" placeholder="Search field">
                <div class="form-control-feedback">
                    <i class="icon-search4 text-muted text-size-base"></i>
                </div>
            </div>
        </form>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo BASE; ?>assets/images/flags/gb.png" class="position-left" alt="">
                    English
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="deutsch"><img src="<?php echo BASE; ?>assets/images/flags/de.png" alt=""> Deutsch</a></li>
                    <li><a class="ukrainian"><img src="<?php echo BASE; ?>assets/images/flags/ua.png" alt=""> Українська</a></li>
                    <li><a class="english"><img src="<?php echo BASE; ?>assets/images/flags/gb.png" alt=""> English</a></li>
                    <li><a class="espana"><img src="<?php echo BASE; ?>assets/images/flags/es.png" alt=""> España</a></li>
                    <li><a class="russian"><img src="<?php echo BASE; ?>assets/images/flags/ru.png" alt=""> Русский</a></li>
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
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
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
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
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
                            <div class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Jeremy Victorino</span>
                                    <span class="media-annotation pull-right">22:48</span>
                                </a>

                                <span class="text-muted">But that would be extremely strained and suspicious...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Beatrix Diaz</span>
                                    <span class="media-annotation pull-right">Tue</span>
                                </a>

                                <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
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

<!-- Mini navbar -->
<div class="navbar-collapse collapse" id="navbar-alt">
    <ul class="nav navbar-nav">
        <?php
        $mparent = $this->uri->segment(1);
        $mchild = $this->uri->segment(2);
        ?>
        <!-- Main -->
        <li class="<?php echo ($mparent == 'dashboard')?'active':''; ?>"><a href="<?php echo BASE; ?>dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
        <li class="<?php echo ($mparent == 'projects')?'active':''; ?>">
            <a href="<?php echo BASE; ?>projects"><i class="icon-stack2"></i> <span>Projects</span></a>
            <!--                                <ul>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects">All Projects</a></li>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects/add">Add New Project</a></li>-->
            <!--                                </ul>-->
        </li>
        <li class="<?php echo ($mparent == 'tasks')?'active':''; ?>">
            <a href="<?php echo BASE; ?>tasks"><i class="icon-googleplus5"></i> <span>Tasks</span></a>
            <!--                                <ul>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects">All Projects</a></li>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects/add">Add New Project</a></li>-->
            <!--                                </ul>-->
        </li>
        <li class="<?php echo ($mparent == 'messages')?'active':''; ?>">
            <a href="<?php echo BASE; ?>messages"><i class="icon-bubbles3"></i> <span>Messages</span></a>
        </li>
        <li class="<?php echo ($mparent == 'users')?'active':''; ?>">
            <a href="<?php echo BASE; ?>Users"><i class="icon-user-plus"></i> <span>Users</span></a>
            <!--                                <ul>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'users' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--users">All Users</a></li>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'users' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--users/add">Add New User</a></li>-->
            <!--                                </ul>-->
        </li>
        <li class="<?php echo ($mparent == 'roles')?'active':''; ?>">
            <a href="<?php echo BASE; ?>roles"><i class="icon-user-plus"></i> <span>User Roles</span></a>
            <!--                                <ul>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'roles' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--roles">All Roles</a></li>-->
            <!--                                    <li class="--><?php //echo ($mparent == 'roles' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--roles/add">Add New Role</a></li>-->
            <!--                                </ul>-->
        </li>
    </ul>

    <div class="navbar-right">
        <p class="navbar-text"><i class="icon-user-check position-left"></i> Signed in as <a href="#" class="navbar-link">Victoria</a></p>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-share4"></i>
                    <span class="visible-xs-inline-block position-right">Share</span>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-dribbble3"></i> Dribbble</a></li>
                    <li><a href="#"><i class="icon-pinterest2"></i> Pinterest</a></li>
                    <li><a href="#"><i class="icon-github"></i> Github</a></li>
                    <li><a href="#"><i class="icon-stackoverflow"></i> Stack Overflow</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /mini navbar -->




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
                                <a href="<?php echo BASE; ?>projects"><i class="icon-stack2"></i> <span>Projects</span></a>
<!--                                <ul>-->
<!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects">All Projects</a></li>-->
<!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects/add">Add New Project</a></li>-->
<!--                                </ul>-->
                            </li>
                            <li class="<?php echo ($mparent == 'tasks')?'active':''; ?>">
                                <a href="<?php echo BASE; ?>tasks"><i class="icon-googleplus5"></i> <span>Tasks</span></a>
<!--                                <ul>-->
<!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects">All Projects</a></li>-->
<!--                                    <li class="--><?php //echo ($mparent == 'projects' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--projects/add">Add New Project</a></li>-->
<!--                                </ul>-->
                            </li>
                            <li class="<?php echo ($mparent == 'messages')?'active':''; ?>">
                                <a href="<?php echo BASE; ?>messages"><i class="icon-bubbles3"></i> <span>Messages</span></a>
                            </li>
                            <li class="<?php echo ($mparent == 'users')?'active':''; ?>">
                                <a href="<?php echo BASE; ?>Users"><i class="icon-user-plus"></i> <span>Users</span></a>
<!--                                <ul>-->
<!--                                    <li class="--><?php //echo ($mparent == 'users' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--users">All Users</a></li>-->
<!--                                    <li class="--><?php //echo ($mparent == 'users' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--users/add">Add New User</a></li>-->
<!--                                </ul>-->
                            </li>
                            <li class="<?php echo ($mparent == 'roles')?'active':''; ?>">
                                <a href="<?php echo BASE; ?>roles"><i class="icon-user-plus"></i> <span>User Roles</span></a>
<!--                                <ul>-->
<!--                                    <li class="--><?php //echo ($mparent == 'roles' && $mchild == '')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--roles">All Roles</a></li>-->
<!--                                    <li class="--><?php //echo ($mparent == 'roles' && $mchild == 'add')?'active':''; ?><!--"><a href="--><?php //echo BASE; ?><!--roles/add">Add New Role</a></li>-->
<!--                                </ul>-->
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->

