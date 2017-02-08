<?php //print_r($project);
$this->load->view('header'); ?>
<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.mCustomScrollbar.css">
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>
<script type="application/javascript" src="<?php echo BASE; ?>assets/js/plugins/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>


<!-- Main content -->
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
                    <li class="active"><a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>"><i class="icon-clipboard2"></i> <span>Tasks</span></a></li>
                    <li><a href="<?php echo BASE; ?>projects/discussion/<?php echo $this->uri->segment(3); ?>"><i class="icon-bubbles5"></i> <span>Discussion</span></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <div style="display: inline-block; max-width: 200px;">
                                <input type="text" class="form-control search_filter" placeholder="Search Filter ...">
                            </div>
                        </h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success heading-btn addNewTask"><i class="icon-plus3"></i> Add Task</button>
                            <div class="btn-group heading-btn">
                                <button type="button" class="btn btn-warning btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-filter3"></i> <span class="caret"></span></button>
                                <ul id="ProTaskList" class="dropdown-menu dropdown-menu-right">
                                    <li class="<?php echo ((isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'all') OR (!isset($_SESSION['task_filter'])) ?'active':'') ?>"><a data-id="all" href="#">All Tasks</a></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'due_today'?'active':'') ?>"><a data-id="due_today" href="#">Tasks Due Today</a></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'past_due'?'active':'') ?>"><a data-id="past_due" href="#">Due Tasks</a></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'completed'?'active':'') ?>"><a data-id="completed" href="#">Completed Tasks</a></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'closed'?'active':'') ?>"><a data-id="closed" href="#">Closed Tasks</a></li>
                                    <li class="divider"></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'assignedme'?'active':'') ?>"><a data-id="assignedme" href="#">Assigned To Me</a></li>
                                    <li class="<?php echo (isset($_SESSION['task_filter']) && $_SESSION['task_filter'] == 'assignedothers'?'active':'') ?>"><a data-id="assignedothers" href="#">Assigned To Others</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="ProjectTaskView" class="panel-body2">
                        <?php //print_r($tasks); ?>
                        <table id="ProjectTaskList" class="datatable-basic">
                            <thead style="display: none;">
                                <tr><th></th><th></th><th></th><th></th><th></th></tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($tasks)){ foreach ($tasks as $task){ ?>
                                <tr class="<?php echo ((date('Y-m-d',strtotime($task->due_on)) < date('Y-m-d',strtotime('now'))) && ($task->status != 3 and $task->status != 5)?'pastdue':''); ?>" id="TaskRow<?php echo $task->task_id; ?>" data-id="<?php echo $task->task_id; ?>">
                                    <td class="text-center">
                                    <?php if($task->status == 3 || $task->status == 5){ ?>
                                        <i class="icon-checkmark-circle"></i>
                                    <?php }else{ ?>
                                        <i class="icon-circle"></i>
                                    <?php } ?>
                                    </td>
                                    <td><?php echo ucfirst($task->title); ?></td>
                                    <td class="text-right"><?php echo $this->Tasks_model->getStatusView($task->status); ?></td>
                                    <td class="text-right"><?php echo date('M d, Y',strtotime($task->due_on)); ?></td>
                                    <td class="text-center">
                                        <a href="" data-popup="tooltip" title="<?php echo $task->afirst.' '.$task->alast; ?>">
                                            <?php if($task->aimg != '' && file_exists('./uploads/users/'.$task->assigned_to.'/'.$task->aimg)){ ?>
                                                <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$task->assigned_to.'/'.$task->aimg; ?>" alt="">
                                            <?php }else{ ?>
                                                <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                            <?php } ?>
                                        </a>
                                    </td>
                                    <div class="clearfix"></div>
                                </tr>
                            <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div id="Task_preview" style="min-height: 500px" class="">
                    <input type="hidden" id="TaskPreviewId" value="">
                </div>
            </div>

        </div>


<?php $this->load->view('footer'); ?>

        <?php if($this->session->flashdata('tid') != ''){ ?>
            <script>$(window).load(function(){ $('#TaskRow<?php echo $this->session->flashdata('tid'); ?>').click(); }); </script>
        <?php }else{ ?>
<!--            <script> $(window).load(function(){ $('#ProjectTaskList tbody tr:first').click(); });  </script>-->
        <?php } ?>
        <script>
            $(function() {

                var oTable = $('.datatable-basic').DataTable({
                    "rowCallback": function( row, data, index ) {
                        if($(row).attr('id') == 'TaskRow'+$('#TaskPreviewId').val()+''){
                            $(row).addClass('active');
                        }else{
                            $(row).removeClass('active');
                        }
                    },
                    dom: '<"datatable-scroll"t><"datatable-footer"ip>',
                });

                $('.search_filter').on('keyup', function () {
                    oTable.search( this.value ).draw();
                } );

                $(document).on('click','.addNewTask',function(e){
//
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/add_task_ajax',
                        'type': 'POST',
                        'data': {pid:'<?php echo $this->uri->segment(3); ?>'},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });

                $(document).on('click','.editTask',function(e){
                    var tid = $(this).data('id');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/edit_task_ajax',
                        'type': 'POST',
                        'data': {tid: tid,pid:'<?php echo $this->uri->segment(3); ?>'},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });


                $(document).on('click','.close_panel',function (e) {
                    $('#Task_preview').html('');
                    $('#ProjectTaskList tr').removeClass('active');
                });

                $(document).on('click','#ProTaskList li a',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#ProTaskList li').removeClass('active');
                    $(this).parent().addClass('active');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>projects/taskfilter',
                        'type': 'POST',
                        'data': {id:id,pid:'<?php echo decode($this->uri->segment(3)); ?>'},
                        success: function (data) {
                            console.log(data);
//                            location.reload();
                            $('#ProjectTaskView').html(data);
                        }
                    });
                });

                $(document).on('click','#ProjectTaskList tr',function(e){
//                    alert($(this).data('id'));
                    $(this).parent().find('tr').removeClass('active');
                    $(this).addClass('active');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/task_preview',
                        'type': 'POST',
                        'data': {tid:$(this).data('id')},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });


            });
        </script>