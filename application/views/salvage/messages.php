<?php
//print_r($groups);
$this->load->view('header');
?>
<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquerypane.css">
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/selects/select2.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/core/app.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/form_layouts.js"></script>-->
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/picker_date.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
<!--    <div class="page-header page-header-xs">-->
<!--        <div class="page-header-content">-->
<!--            <div class="page-title">-->
<!--                <h4><i class="icon-bubble2 position-left"></i> <span class="text-semibold"> Messages</span></h4>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="breadcrumb-line">-->
<!--            <ul class="breadcrumb">-->
<!--                <li><a href="--><?php //echo BASE; ?><!--"><i class="icon-home2 position-left"></i> Home</a></li>-->
<!--                <li class="active">Messages</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="row page_header">
            <div class="col-sm-6">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Messages</span></h4>
            </div>
            <div class="col-sm-6 text-right">
                <a id="create_group" class="btn btn-success" href=""><i class="icon-users"></i> Create Group</a>
<!--                <a href="--><?php //echo BASE; ?><!--projects/add" class="btn btn-success"><i class="icon-plus2"></i><span> Add New Project</span></a>-->
            </div>
        </div>

        <div id="MessageBox" class="row">
            <div class="col-md-3">
                <div class="chat_users panel" style="height: 484px">
                    <div class="top-search-bar">
                        <div class="form-group has-feedback has-feedback-left no-margin">
                            <input type="text" id="SearchUsers" class="form-control input-lg" placeholder="Search ...">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>
                    </div>
                    <div id="searchViewUsers" class="user_list">
                        <ul>

                        </ul>
                    </div>
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-top top-divided no-margin">
                            <li class="active"><a href="#top-divided-tab1" data-toggle="tab" aria-expanded="true">Recent</a></li>
                            <li class=""><a href="#top-divided-tab2" data-toggle="tab" aria-expanded="false">Users</a></li>
                            <li class=""><a href="#top-divided-tab3" data-toggle="tab" aria-expanded="false">Groups</a></li>
                        </ul>

                        <div class="tab-content">
                            <!-- RECENT TAB CONTENT -->
                            <div class="tab-pane active" id="top-divided-tab1">
                                <div id="recent_list" class="user_list">
                                    <ul>
                                        <?php foreach ($recent as $user){ ?>
                                            <li class="">
                                                <a data-id="<?php echo $user['gu_id']; ?>" data-name="<?php echo $user['name']; ?>" data-group="<?php echo $user['is_group']; ?>" href="">
                                                    <div class="users-left">
                                                        <?php if($user['img'] != '' && file_exists('./uploads/users/'.$user['gu_id'].'/'.$user['img'])){ ?>
                                                            <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user['gu_id'].'/'.$user['img']; ?>" alt="">
                                                        <?php }else{ ?>
                                                            <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="users-right">
                                                        <span class="usr-name"><?php echo $user['name']; ?></span><br>
                                                        <span class="usr-time pull-right">
                                                            <?php if(date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($user['datetime']))){
                                                                echo date('H:i A', strtotime($user['datetime']));
                                                            }else {
                                                                echo date('M d, y', strtotime($user['datetime']));
                                                            }
                                                            ?>
                                                        </span>
                                                        <span class="usr-msg">
                                                            <?php if($user['message'] != '') {
                                                                if($_SESSION['user_id'] == $user['sender']){
                                                                    echo 'Me: '.$user['message'];
                                                                }else {
                                                                    echo $user['message'];
                                                                }
                                                            }else{
                                                                echo '<i class="icon-attachment"></i>'.$user['file'];
                                                            }?>
                                                        </span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- USERS TAB CONTENT -->
                            <div class="tab-pane" id="top-divided-tab2">
                                <div id="users_list" class="user_list">
                                    <ul>
                                        <?php foreach ($users as $user){ ?>
                                            <li class="">
                                                <a data-id="<?php echo $user->user_id; ?>" data-name="<?php echo $user->first_name.' '.$user->last_name; ?>"  href="">
                                                    <div class="users-left">
                                                        <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
                                                            <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
                                                        <?php }else{ ?>
                                                            <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="users-right">
                                                        <span class="usr-name"><?php echo $user->first_name.' '.$user->last_name; ?></span><br>
                                                        <span class="usr-time pull-right">
                                                            <?php if($user->datetime ==''){
                                                                echo '';
                                                            }elseif(date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($user->datetime))){
                                                                echo date('H:i A', strtotime($user->datetime));
                                                            }else {
                                                                echo date('M d, y', strtotime($user->datetime));
                                                            }
                                                            ?>
                                                        </span>
                                                        <span class="usr-msg">
                                                            <?php if($user->message == '' && $user->file != '') {
                                                                echo '<i class="icon-attachment"></i>'.$user->file;
                                                            }elseif($user->message != ''){
                                                                if($_SESSION['user_id'] == $user->sender){
                                                                    echo 'Me: '.$user->message;
                                                                }else {
                                                                    echo $user->message;
                                                                }
                                                            }else{
                                                                echo '<br>';
                                                            }?>
                                                        </span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- GROUPS TAB CONTENT -->
                            <div class="tab-pane" id="top-divided-tab3">
                                <div id="group_list" class="user_list user_groups">
                                    <ul>
                                        <?php if(!empty($groups)){
                                            foreach ($groups as $group){
                                            ?>
                                            <li class="">
                                                <a data-id="<?php echo $group->group_id; ?>" data-name="<?php echo $group->group_name; ?>" data-group="1" href="">
                                                    <div class="users-left">
                                                    <?php if($group->group_img != '' && file_exists('./uploads/message/group/'.$group->group_id.'/'.$group->group_img)){ ?>
                                                        <img src="<?php echo BASE.'uploads/message/group/'.$group->group_id.'/'.$group->group_img; ?>" class="img-circle img-sm" alt="Profile Picture">
                                                    <?php }else{ ?>
                                                        <img src="http://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle img-sm" alt="Profile Picture">
                                                    <?php } ?>
                                                    </div>
                                                    <div class="users-right">
                                                        <span class="usr-name"><?php echo $group->group_name; ?></span><br>
                                                        <span class="usr-time pull-right"></span>
                                                        <span class="usr-msg"><br></span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        <?php } }else{ ?>
                                            <li>
                                                No Results Found
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                <div class="panel">
                    <!--Heading-->
                    <div class="message-head">
                        <h3 class="panel-title pull-left"><i class="icon-bubbles3"></i> <span class="active_name">Chat</span></h3>
                        <div class="btn-group pull-right">
<!--                            <a id="create_group" class="btn btn-primary" href=""><i class="icon-users"></i> Create Group</a>-->
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!--Widget body-->
                    <div id="demo-chat-body" class="collapse in">
                        <div class="nano-content" tabindex="0" >
                            <ul id="user_messages_block" class="list-unstyled pad-all media-block">
                                <li>Home</li>
                            </ul>
                        </div>
                        <div id="sidebar" class="text-center">
                            <a class="profile_close" href=""><i class="icon-cross2"></i></a>
                            <div id="sidebar-inner">
                                <div class="profile_pic">
                                    <img class="img-responsive img-circle" src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" alt="">
                                </div>
                                <h1 class="profile_name">Title Name</h1>
                                <p class="profile_email">admin@bigbew.com</p>
                                <label for="" class="profile_role label label-success">Super Admin</label>
                            </div>
                        </div>
                        <!--Widget footer-->
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form id="ChatInputForm" action="#">
                                        <div class="chat-input-box">
                                            <input type="hidden" id="active_user" name="active_user" value="">
                                            <input type="hidden" id="group_active" name="group_active">
                                            <div class="input-attachment btn-file"> <i class="icon-attachment"></i><input type="file" name="userfile[]" multiple class="file-input" data-show-caption="false" data-show-upload="false" id="msg_attachment"></div>
                                            <input type="text" name="msg" placeholder="Enter your message ..." class="form-control chat-input">
                                            <button type="submit" class="input-send"><i class="icon-paperplane"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view('footer'); ?>
<script>var base_url = '<?php echo BASE; ?>';</script>
<script src="<?php echo BASE; ?>assets/js/messages.js"></script>
<script src="<?php echo BASE; ?>assets/js/jquery.mousewheel.js"></script>
<script src="<?php echo BASE; ?>assets/js/jquerypane.js"></script>
<script type="application/javascript" src="<?php echo BASE; ?>assets/js/plugins/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    (function($){
        $(window).on("load",function(){
            $('body').jScrollPane();
            $("#users_list,#group_list,#recent_list").mCustomScrollbar({
                setHeight:400,
                theme:"minimal-dark"
            });
            $('.nano-content').mCustomScrollbar({
                setHeight:380,
                theme:"minimal-dark"
            }).mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});
        });
    })(jQuery);
</script>

<div id="AddGroupNew" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">Create New Group</h5>
            </div>

            <div class="modal-body">
                <form id="AddGroup" action="#">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group Name:</label>
                                    <input type="text" id="new_group_name" name="group_name" placeholder="Group Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Attachment:</label>
                                    <input type="file" id="new_group_img" name="group_img" class="file-styled">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Group Users:</label>
                                    <select multiple name="group_users[]" class="select" placeholder="Select Group Users" id="new_group_users">
                                        <?php foreach ($users as $usr){
                                            echo '<option value="'.$usr->user_id.'">'.$usr->first_name.' '.$usr->last_name.'</option>';
                                        } ?>
                                    </select>
                                </div>
                                <input type="hidden" name="user_id" id="grp_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success">Add Group</button>
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="EditGroup" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            Loading ...
        </div>
    </div>
</div>