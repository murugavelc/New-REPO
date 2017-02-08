<?php //print_r($project);
$this->load->view('header'); ?>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>


<div class="content-wrapper">

    <!-- Page header -->
    <div class="project-header page-header">
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
    <div id="DiscussionPage" class="content">

        <!-- Detached content -->
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default">
                <div class="has-feedback has-feedback-left">
                    <input class="form-control" placeholder="Search" type="search">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-size-base text-muted"></i>
                    </div>
                </div>
                <div class="sidebar-content">

                    <!-- Sidebar search -->
                    <div class="sidebar-category">
                        <div class="category-content">
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                                    <div class="media-body">
                                        <a href="#" class="media-heading text-semibold">James Alexander</a>
                                        <span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <span class="status-mark border-success"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                                    <div class="media-body">
                                        <a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
                                        <span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <span class="status-mark border-danger"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                                    <div class="media-body">
                                        <a href="#" class="media-heading text-semibold">Margo Baker</a>
                                        <span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <span class="status-mark border-success"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                                    <div class="media-body">
                                        <a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
                                        <span class="text-size-mini text-muted display-block">Neenah, WI.</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <span class="status-mark border-warning"></span>
                                    </div>
                                </li>

                                <li class="media">
                                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                                    <div class="media-body">
                                        <a href="#" class="media-heading text-semibold">Richard Vango</a>
                                        <span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <span class="status-mark border-grey-400"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /online-users -->
                </div>
            </div>
        </div>
        <div class="container-detached">
            <div class="content-detached">

                <!-- Sidebars overview -->
                <div class="panel panel-flat">
                    <div class="panel-inner">
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
                    </div>
                </div>
                <!-- /sidebars overview -->

            </div>
        </div>
        <!-- /detached content -->



<?php $this->load->view('footer'); ?>
        <script>
            $(function() {
                $('body').addClass('has-detached-left');
                var win_height = $(window).height();
//                $('#discussion_container').css('height',(parseInt(win_height)-parseInt(150)));
                if(win_height >= 350) {
                    $('.sidebar-content').css('height', (parseInt(win_height) - parseInt(230)));
                    $('.panel-inner').css('height', (parseInt(win_height) - parseInt(190)));
                }

                $(window).on('resize', function(){
                    var win_height = $(window).height();
//                    $('#discussion_container').css('height',(parseInt(win_height)-parseInt(150)));
                    if(win_height >= 350) {
                        $('.sidebar-content').css('height', (parseInt(win_height) - parseInt(230)));
                        $('.panel-inner').css('height', (parseInt(win_height) - parseInt(190)));
                    }
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