<?php
//print_r($user);
$this->load->view('admin/header');
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Users</span> - View - <?php echo ucfirst($user->first_name.' '.$user->last_name); ?></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo ADMIN_URL; ?>users" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Users</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo BASE; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo BASE; ?>clients"> Users</a></li>
                <li class="active">View - <?php echo ucfirst($user->first_name.' '.$user->last_name); ?></li>
            </ul>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div id="ProfileView" class="row">
                            <div class="col-md-4">
                                <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
                                    <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
                                <?php }else{ ?>
                                    <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                <?php } ?>
<!--                                <input type="file">-->
                            </div>
                            <div class="col-md-8">
                                <h1 class="no-margin"><?php echo $user->first_name.' '.$user->last_name; ?></h1>
                                <h5 class="no-margin"><?php GLOBAL $USER_ROLES; echo $USER_ROLES[$user->user_type]; ?></h5><hr>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <p><i class="icon-envelop2"></i> &nbsp;<?php echo $user->email; ?> </p>
                                        <?php if($user->phone != ''){ ?>
                                            <p><i class="icon-phone"></i> &nbsp;<?php echo $user->phone; ?> </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6 text-right">

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div><br>
                            <hr>
                            <div class="col-md-12">
                                <h6><b>More Information :</b></h6>
                                <?php if($user->more_info != ''){ ?>
                                    <p><?php echo $user->more_info; ?> </p>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                        </div>
                        <div class="text-center">
                            <a class="btn bg-blue-300" href="<?php echo ADMIN_URL; ?>profile/edit">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h6 class="panel-title">Latest Activity</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                    <div class="panel-body">
                        White panel using <code>.panel-white</code> class
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('admin/footer'); ?>
