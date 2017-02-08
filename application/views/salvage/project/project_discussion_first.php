<?php //print_r($project);
$this->load->view('header'); ?>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>


<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="project-header page-header no-margin">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <img class="img-circle" style="width:30px;" src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" alt="">
                    <span class="text-semibold">Project</span> - <?php echo $project->project_name; ?>
                </h4>
            </div>

            <div class="project_top_nav pull-right">
                <ul class="heading-btn-group">
                    <li><a href="<?php echo BASE; ?>projects/dashboard/<?php echo $this->uri->segment(3); ?>"><i class="icon-pie-chart"></i> <span>Summary</span></a></li>
                    <li><a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>"><i class="icon-googleplus5"></i> <span>Tasks</span></a></li>
                    <li class="active"><a href="<?php echo BASE; ?>projects/discussion/<?php echo $this->uri->segment(3); ?>"><i class="icon-bubbles5"></i> <span>Discussion</span></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding">

        <div id="discussion_container">
            <div id="team_list" class="">
                <div class="team-inner">
                    <div class="top-block">
                        <input class="search_box" type="text" placeholder="Search ...">
                    </div>
                    <ul >
                        <li class="">
                            <div class="pro_img">
                                <img width="40px" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                            </div>
                            <div class="usr_pro_text">Tema User Name</div>
                            <div class="clearfix"></div>
                        </li>
                        <li class="active">
                            <div class="pro_img">
                                <img width="40px" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                            </div>
                            <div class="usr_pro_text">Tema User Name</div>
                            <div class="clearfix"></div>
                        </li>
                        <li class="">
                            <div class="pro_img">
                                <img width="40px" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                            </div>
                            <div class="usr_pro_text">Tema User Name</div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="discussion_wrapper">
                <div class="inner_wrapper">
                    <ul>
                        <li id="" class="mar-btm">
                            <div class="media-left">
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">
                            </div>
                            <div class="media-body pad-hor">
                                <div class="speech">
                                    <a href="#" class="media-heading">Testing user</a>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    <p class="speech-time">
                                        <i class="fa fa-clock-o fa-fw"></i><?php echo date('g:i A',strtotime('now')); ?>
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li id="" class="mar-btm">
                            <div class="media-body pad-hor speech-right">
                                <div class="speech">
                                    <a href="#" class="media-heading">Testing user</a>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    <p class="speech-time">
                                        <i class="fa fa-clock-o fa-fw"></i><?php echo date('g:i A',strtotime('now')); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="media-right">
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">
                            </div>
                        </li>
                        <li id="" class="mar-btm">
                            <div class="media-left">
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">
                            </div>
                            <div class="media-body pad-hor">
                                <div class="speech">
                                    <a href="#" class="media-heading">Testing user</a>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    <p class="speech-time">
                                        <i class="fa fa-clock-o fa-fw"></i><?php echo date('g:i A',strtotime('now')); ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li id="" class="mar-btm">
                            <div class="media-body pad-hor speech-right">
                                <div class="speech">
                                    <a href="#" class="media-heading">Testing user</a>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    <p class="speech-time">
                                        <i class="fa fa-clock-o fa-fw"></i><?php echo date('g:i A',strtotime('now')); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="media-right">
                                <img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm2" alt="Profile Picture">
                            </div>
                        </li>
                    </ul>
                    <form id="AddDiscussionMsg" action="">
                        <input id="input_msg" type="text" placeholder="Type your text here ...">
                    </form>
                </div>
            </div>


        </div>


<?php $this->load->view('footer'); ?>
        <script>
            $(function() {
                var win_height = $(window).height();
//                $('#discussion_container').css('height',(parseInt(win_height)-parseInt(150)));
                $('.team-inner').css('height',(parseInt(win_height)-parseInt(150)));
                $('.inner_wrapper').css('height',(parseInt(win_height)-parseInt(150)));

                $(window).on('resize', function(){
                    var win_height = $(window).height();
//                    $('#discussion_container').css('height',(parseInt(win_height)-parseInt(150)));
                    $('.team-inner').css('height',(parseInt(win_height)-parseInt(150)));
                    $('.inner_wrapper').css('height',(parseInt(win_height)-parseInt(150)));
                });

                $(document).on('click','#ProjectTaskList tr',function(e){
//                    alert($(this).data('id'));
                    $(this).parent().find('tr').removeClass('active');
                    $(this).addClass('active');
                });

//                $('.datatable-basic').DataTable();

//                $('.search_filter').on( 'keyup', function () {
//                    oTable.search( this.value ).draw();
//                } );
            });
        </script>