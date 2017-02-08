<?php $this->load->view('header');
//print_r($user_det);
?>
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="project-header page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-stack2"></i> <span class="text-semibold">Projects</span>
                </h4>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
<!--                    <div class="form-group has-feedback">-->
<!--                        <input class="form-control" placeholder="Search ..." type="search">-->
<!--                        <div class="form-control-feedback">-->
<!--                            <i class="icon-search4 text-muted text-size-base"></i>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div class="btn-group heading-btn">
                    <button class="btn btn-warning btn-icon btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon-filter3"></i> <span class="caret"></span></button>
                    <ul id="ProjectFilter" class="dropdown-menu dropdown-menu-right">
                        <li class="<?php echo ((isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] == 'all') || (!isset($_SESSION['pro_filter'])) ?'active':'') ?>"><a data-id="all" href="">All</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] == '1'?'active':'') ?>"><a data-id="1" href="#">Active Projects</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] == '2'?'active':'') ?>"><a data-id="2" href="#">Inactive Projects</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] == '3'?'active':'') ?>"><a data-id="3" href="#">Completed Projects</a></li>
                    </ul>
                </div>
                <div class="btn-group heading-btn">
                    <button class="btn bg-primary-600 btn-icon btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon-sort"></i> <span class="caret"></span></button>
                    <ul id="ProjectSorting" class="dropdown-menu dropdown-menu-right">
                        <li class="<?php echo ((isset($_SESSION['pro_sort']) && $_SESSION['pro_sort'] == 'name_asc') || (!isset($_SESSION['pro_sort']))?'active':'') ?>"><a data-id="name_asc" href="#"><i class="icon-sort-alpha-asc"></i> Project Name</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_sort']) && $_SESSION['pro_sort'] == 'name_desc'?'active':'') ?>"><a data-id="name_desc" href="#"><i class="icon-sort-alpha-desc"></i> Project Name</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_sort']) && $_SESSION['pro_sort'] == 'act_asc'?'active':'') ?>"><a data-id="act_asc" href="#"><i class="icon-sort-time-asc"></i> Last Activity</a></li>
                        <li class="<?php echo (isset($_SESSION['pro_sort']) && $_SESSION['pro_sort'] == 'act_desc'?'active':'') ?>"><a data-id="act_desc" href="#"><i class="icon-sort-time-desc"></i> Last Activity</a></li>
                    </ul>
                </div>
                <div class="btn-group heading-btn">
                    <button class="btn bg-indigo-400 btn-xs"><i class="icon-grid"></i></button>
                    <button class="btn bg-indigo-400 btn-xs"><i class="icon-list"></i></button>
                </div>
                <div class="btn-group heading-btn">
                    <a href="<?php echo BASE; ?>projects/add" class="btn btn-success btn-icon btn-xs"><i class="icon-plus2"></i> Add New Project</a>
                </div>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <div id="ProjectsAlerts">

        </div>

        <div class="datatable-wrapper panel-flat">

            <div id="ProjectsViewPage" class="row">
                <?php if(!empty($projects)){
                    foreach ($projects as $project){ ?>
                        <div class="col-sm-3">
                            <div class="project_block">
                                <h5 class="">
                                    <?php if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){ ?>
                                        <img class="img-circle img-sm" src="<?php echo BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img; ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    <?php } ?>
                                    <a data-popup="tooltip" title="Click To View Dashboard" href="<?php echo BASE; ?>projects/dashboard/<?php echo encode($project->project_id); ?>"><?php echo $project->project_name; ?></a>
                                    <a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $project->project_id; ?>" class="project_delete text-danger delete"><i class="icon-trash"></i></a>
                                </h5>
                                <div class="project_block_body">
                                    <ul class="project_det_table">
                                        <li><p><i class="icon-user"></i> Client </p><p>: <?php echo $project->client_first.' '.$project->client_last; ?></p></li>
                                        <li><p><i class="icon-calendar2"></i> Start Date </p><p>: <?php echo date('Y-m-d',strtotime($project->start_date)); ?></p></li>
                                        <li><p><i class="icon-calendar2"></i> End Date </p><p>: <?php echo date('Y-m-d',strtotime($project->end_date)); ?></p></li>
                                        <li><p><i class="icon-notification2"></i> Status </p><p>:
                                                <?php if($project->status == 1){ ?>
                                                    <span class="label label-success">Active</span>
                                                <?php }elseif($project->status == 2){ ?>
                                                    <span class="label label-warning">Inactive</span>
                                                <?php }elseif($project->status == 3){ ?>
                                                    <span class="label bg-slate">Completed</span>
                                                <?php } ?>
                                            </p></li>
                                    </ul>
                                    <p class="text-center">
                                        <ul class="actions icons-list">
                                            <li class=""><a data-popup="tooltip" title="Dashboard" href="<?php echo BASE; ?>projects/dashboard/<?php echo encode($project->project_id); ?>" class="btn btn-success text-white btn-xs"><i class="icon-pie5"></i></a></li>
                                            <li class=""><a data-popup="tooltip" title="Tasks" href="<?php echo BASE; ?>projects/tasks/<?php echo encode($project->project_id); ?>" class="btn bg-purple-600 text-white btn-xs"><i class="icon-clipboard2"></i></a></li>
                                            <li class=""><a data-popup="tooltip" title="Discussions" href="<?php echo BASE; ?>projects/discussion/<?php echo encode($project->project_id); ?>" class="btn bg-primary-800 text-white btn-xs"><i class="icon-bubbles5"></i></a></li>
                                            <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo BASE; ?>projects/edit/<?php echo $project->project_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
<!--                                            <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="--><?php //echo $project->project_id; ?><!--" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>-->
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>

<?php $this->load->view('footer'); ?>
        <script>
            $(function() {
                var oTable = $('.datatable-basic').DataTable({
                    columnDefs: [{
                        orderable: false,
                        width: '200px',
                        targets: [ 5 ]
                    }],
                });

                $('.search_filter').on( 'keyup', function () {
                    oTable.search( this.value ).draw();
                } );

                $(document).on('click','#ProjectSorting li a',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#ProjectSorting li').removeClass('active');
                    $(this).parent().addClass('active');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>projects/sorting',
                        'type': 'POST',
                        'data': {id:id},
                        success: function (data) {
//                            console.log(data);
//                            location.reload();
                                $('#ProjectsViewPage').html(data);
                        }
                    });
                });

                $(document).on('click','#ProjectFilter li a',function(e){
                   e.preventDefault();
                    var id = $(this).data('id');
                    $('#ProjectFilter li').removeClass('active');
                    $(this).parent().addClass('active');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>projects/filter',
                        'type': 'POST',
                        'data': {id:id},
                        success: function (data) {
//                            console.log(data);
//                            location.reload();
                                $('#ProjectsViewPage').html(data);
                        }
                    });
                });

                $(document).on('click','.delete',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this project!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajax({
                            'url' : '<?php echo BASE; ?>projects/delete',
                            'type': 'POST',
                            'data': {id:id},
                            success: function (data) {
//                                console.log(data);
                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            }
                        });

                    });
                });
            });
        </script>