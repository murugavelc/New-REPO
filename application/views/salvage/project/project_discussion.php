<?php //print_r($pusers);
$this->load->view('header'); ?>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquerypane.css">

<div class="content-wrapper">

    <!-- Page header -->
    <div class="project-header page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <?php if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){ ?>
                        <img style="width:30px;" class="img-circle" src="<?php echo BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img; ?>" alt="">
                    <?php }else{ ?>
                        <img style="width:30px;" class="img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                    <?php } ?>
                    <span class="text-semibold">Project</span> - <?php echo $project->project_name; ?>
                </h4>
            </div>

            <div class="project_top_nav pull-right">
                <ul class="heading-btn-group">
                    <li><a href="<?php echo BASE; ?>projects/dashboard/<?php echo $this->uri->segment(3); ?>"><i class="icon-pie5"></i> <span>Summary</span></a></li>
                    <li><a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>"><i class="icon-clipboard2"></i> <span>Tasks</span></a></li>
                    <li class="active"><a href="<?php echo BASE; ?>projects/discussion/<?php echo $this->uri->segment(3); ?>"><i class="icon-bubbles5"></i> <span>Discussion</span></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div id="DiscussionPage" class="content">

        <div class="row">
            <div class="col-sm-3">
                <div id="Discussion_users" class="panel panel-white">
                    <div class="panel-heading">
                        <div class="form-group has-feedback has-feedback-left">
                            <input id="SearchUsers" type="text" class="form-control" placeholder="Search ...">
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-size-base"></i>
                            </div>
                            <a class="search_clear" href=""><i class="icon-cross2"></i></a>
                        </div>
                    </div>
                    <div id="DisUsers_list" class="category-content">
                        <div id="searchViewUsers">

                        </div>
                        <ul id="regularUsersList" class="media-list">
                            <li data-id="0" class="media">
                                <div class="media-left">
                                    <?php if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){ ?>
                                        <img class="img-circle img-sm" src="<?php echo BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img; ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    <?php } ?>
<!--                                    <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-sm img-circle" alt="">-->
<!--                                    <span class="badge bg-warning-400 media-badge">5</span>-->
                                </div>
                                <?php $allLast = $this->Discussion_model->getLastOfProjectall($project->project_id); ?>
                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold uname">All Users</span>
                                        <span class="media-annotation pull-right"><?php echo date('H:i A',strtotime($allLast['datetime'])); ?></span>
                                    </a>
                                    <span class="text-muted"><?php print_r($allLast['message']);  ?></span>
                                </div>
                            </li>
                            <?php
                            if(!empty($pusers)){  foreach ($pusers as $pusr){ ?>
                                <li data-id="<?php echo $pusr['user_id']; ?>" class="media">
                                    <div class="media-left">
                                        <?php if($pusr['profile_img'] != '' && file_exists('./uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img'])){ ?>
                                            <img class="img-circle img-sm" src="<?php echo BASE.'uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img']; ?>" alt="">
                                        <?php }else{ ?>
                                            <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                        <?php } ?>
<!--                                        <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-sm img-circle" alt="">-->
<!--                                        <span class="badge bg-danger-400 media-badge">5</span>-->
                                        <?php if($pusr['unread'] > 0){ ?>
                                            <span class="badge bg-warning-400 media-badge"><?php echo $pusr['unread']; ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="uname text-semibold"><?php echo $pusr['first_name'].' '.$pusr['last_name']; ?></span>
                                            <span class="media-annotation pull-right"><?php echo date('H:i A',strtotime($pusr['datetime'])); ?></span>
                                        </a>
                                        <span class="text-muted"><?php echo $pusr['message']; ?></span>
                                    </div>
                                </li>
                            <?php }} ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div id="discussion_msgs" class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title"><img class="img-circle img-usr" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt=""> Benjamin Joel</h5>
                        <div class="heading-elements">
                            <div class="btn-group heading-btn">
                                <button type="button" class="btn bg-primary-800 btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Clear Conversation</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-inner">
                        <ul>
<!--                            <li id="" class="mar-btm">-->
<!--                                <div class="media-left">-->
<!--                                    <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">-->
<!--                                </div>-->
<!--                                <div class="media-body pad-hor">-->
<!--                                    <div class="speech">-->
<!--                                        <a href="#" class="media-heading">Testing user</a>-->
<!--                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
<!--                                        <p class="speech-time">-->
<!--                                            <i class="fa fa-clock-o fa-fw"></i>--><?php //echo date('g:i A',strtotime('now')); ?>
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!---->
<!--                            <li id="" class="mar-btm">-->
<!--                                <div class="media-body pad-hor speech-right">-->
<!--                                    <div class="speech">-->
<!--                                        <a href="#" class="media-heading">Testing user</a>-->
<!--                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
<!--                                        <p class="speech-time">-->
<!--                                            <i class="fa fa-clock-o fa-fw"></i>--><?php //echo date('g:i A',strtotime('now')); ?>
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="media-right">-->
<!--                                    <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">-->
<!--                                </div>-->
<!--                            </li>-->
                        </ul>
                    </div>
                    <div class="msg_form">
                        <form id="ChatInputForm" action="#">
                            <div class="chat-input-box">
                                <input type="hidden" id="active_user" name="active_user" value="">
                                <input type="hidden" id="project_id" name="project_id" value="<?php echo $project->project_id; ?>">
                                <div class="input-attachment bg-warning-600 btn-file"> <i class="icon-attachment"></i><input type="file" name="userfile[]" multiple class="file-input" data-show-caption="false" data-show-upload="false" id="msg_attachment"></div>
                                <input type="text" name="msg" placeholder="Enter your message ..." class="form-control chat-input">
                                <button type="submit" class="btn btn-success input-send"><i class="icon-paperplane"></i> Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php $this->load->view('footer'); ?>
<script>var base_url = '<?php echo BASE; ?>';</script>
<script src="<?php echo BASE; ?>assets/js/discussion.js"></script>

<script>
    $(function() {

        var win_height = $(window).height();
        console.log(win_height);
        if(win_height >= 350) {
            $('.category-content').css('height', (parseInt(win_height) - parseInt(248)));
            $('.panel-inner').css('height', (parseInt(win_height) - parseInt(310)));
        }else{
            $('.category-content').css('height', '110px');
            $('.panel-inner').css('height', '50px');
        }

        $(window).on('resize', function(){
            var win_height = $(window).height();
            if(win_height >= 350) {
                $('.category-content').css('height', (parseInt(win_height) - parseInt(248)));
                $('.panel-inner').css('height', (parseInt(win_height) - parseInt(310)));
            }else{
                $('.category-content').css('height', '110px');
                $('.panel-inner').css('height', '50px');
            }
        });



    });
    $(window).on("load",function() {

    });
</script>