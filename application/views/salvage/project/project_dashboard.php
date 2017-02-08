<?php //print_r($taskstatus);
$this->load->view('header'); ?>
<script>var base = '<?php echo BASE; ?>';</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/visualization/echarts/echarts.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/charts/echarts/pies_donuts.js"></script>-->
<script type="text/javascript" >
    $(function () {
        var topen = '<?php echo $taskstatus['Open']; ?>';
        var tprogress = '<?php echo $taskstatus['Progress']; ?>';
        var tcompleted = '<?php echo $taskstatus['Completed']; ?>';
        var treopen = '<?php echo $taskstatus['Reopen']; ?>';
        var tclosed = '<?php echo $taskstatus['Closed']; ?>';

        // Completion Chart
        var completion_color = 'green';

        // Set paths
        // ------------------------------
        require.config({
            paths: {
                echarts: '<?php echo BASE; ?>assets/js/plugins/visualization/echarts'
            }
        });

        require(
            [
                'echarts',
                'echarts/theme/limitless',
                'echarts/chart/pie',
                'echarts/chart/funnel'
            ],


            // Charts setup
            function (ec, limitless) {
                var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);

                basic_donut_options = {

                    // Add title
                    title: {
                        text: 'Task Status',
                        subtext: 'Task Status Information',
                        x: 'center'
                    },

                    // Enable drag recalculate
                    calculable: false,

                    // Add series
                    series: [
                        {
                            name: 'Tasks',
                            type: 'pie',
                            radius: ['45%', '70%'],
                            center: ['50%', '57.5%'],
                            itemStyle: {
                                normal: {
                                    label: {
                                        show: true
                                    },
                                    labelLine: {
                                        show: true
                                    }
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                                        position: 'center',
                                        textStyle: {
                                            fontSize: '17',
                                            fontWeight: '500'
                                        }
                                    }
                                }
                            },
                            data: [
                                {value: topen, name: 'Open',
                                    itemStyle : {
                                        normal : {
                                            color : '#2196f3',
                                            label : {
                                                textStyle : {
                                                    color : '#2196f3',
                                                }
                                            },
                                            labelLine : {
                                                lineStyle : {
                                                    color : '#2196f3',
                                                }
                                            }
                                        }
                                    }
                                },
                                {value: tprogress, name: 'Progress',
                                    itemStyle : {
                                        normal : {
                                            color : '#00838f',
                                            label : {
                                                textStyle : {
                                                    color : '#00838f',
                                                }
                                            },
                                            labelLine : {
                                                lineStyle : {
                                                    color : '#00838f',
                                                }
                                            }
                                        }
                                    }
                                },
                                {value: tcompleted, name: 'Completed',
                                    itemStyle : {
                                        normal : {
                                            color : '#4caf50',
                                            label : {
                                                textStyle : {
                                                    color : '#4caf50',
                                                }
                                            },
                                            labelLine : {
                                                lineStyle : {
                                                    color : '#4caf50',
                                                }
                                            }
                                        }
                                    }
                                },
                                {value: treopen, name: 'Reopen',
                                    itemStyle : {
                                        normal : {
                                            color : '#f44336',
                                            label : {
                                                textStyle : {
                                                    color : '#f44336',
                                                }
                                            },
                                            labelLine : {
                                                lineStyle : {
                                                    color : '#f44336',
                                                }
                                            }
                                        }
                                    }
                                },
                                {value: tclosed, name: 'Closed',
                                    itemStyle : {
                                        normal : {
                                            color : '#37474f',
                                            label : {
                                                textStyle : {
                                                    color : '#37474f',
                                                }
                                            },
                                            labelLine : {
                                                lineStyle : {
                                                    color : '#37474f',
                                                }
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                };

                basic_donut.setOption(basic_donut_options);

                window.onresize = function () {
                    setTimeout(function (){
                        basic_donut.resize();
                    }, 200);
                }

            }
        );


    });
</script>

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
<!--                    <img class="img-circle" style="width:30px;" src="--><?php //echo BASE.'assets/images/placeholder.jpg'; ?><!--" alt="">-->
                    <span class="text-semibold">Project</span> - <?php echo $project->project_name; ?>
                </h4>
            </div>

            <div class="project_top_nav pull-right">
                <ul class="heading-btn-group">
                    <li class="active"><a href="<?php echo BASE; ?>projects/dashboard/<?php echo $this->uri->segment(3); ?>"><i class="icon-pie5"></i> <span>Summary</span></a></li>
                    <li><a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>"><i class="icon-clipboard2"></i> <span>Tasks</span></a></li>
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
            <div class="col-md-3">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-stats-dots"></i> Overview</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Completed Status</h6>
                                <?php
                                $totaltasks = array_sum($taskstatus);
                                if($totaltasks > 0) {
                                    $perTasks = round($taskstatus['Closed'] / $totaltasks * 100);
                                }else{
                                    $perTasks = 0;
                                }
                                $compcolor = 'progress-bar-primary';
                                if($perTasks <= 25){
                                    $compcolor = 'progress-bar-danger';
                                }elseif($perTasks <= 50 && $perTasks > 25){
                                    $compcolor = 'progress-bar-warning';
                                }elseif($perTasks <= 75 && $perTasks > 50){
                                    $compcolor = 'progress-bar-info';
                                }elseif($perTasks > 75){
                                    $compcolor = 'progress-bar-success';
                                }
                                ?>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active <?php echo $compcolor; ?>" style="width: <?php echo $perTasks; ?>%">
                                        <span><?php echo $perTasks; ?>% Completed</span>
                                    </div>
                                </div>
                                <ul class="navigation navigation-alt navigation-accordion">
                                    <li class="navigation-divider"></li>
                                    <li><a class="text-grey" href="#"><i class="icon-calendar"></i> Start Date :  <?php echo date('Y-m-d',strtotime($project->start_date)); ?></a></li>
                                    <li><a class="text-grey" href="#"><i class="icon-calendar"></i> End Date :  <?php echo date('Y-m-d',strtotime($project->end_date)); ?></a></li>
                                    <li><a class="text-grey" href="#"><i class="icon-user"></i> Client :  <?php echo $project->client_first.' '.$project->client_last; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="TeamMembers" class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-users4"></i> Team Users</h5>
                        <div class="heading-elements">
                            <a id="addTeamUsers" class="btn btn-xs btn-success heading-btn" href="">Add New User</a>
                        </div>

                    </div>
                    <div class="panel-body project_dash no-padding">
                        <ul id="ProjectTeamUsers" class="navigation navigation-alt navigation-accordion">
                            <?php foreach ($pusers as $puser) { ?>
                                <li>
                                    <?php if($puser->profile_img != '' && file_exists('./uploads/users/'.$puser->user_id.'/'.$puser->profile_img)){ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$puser->user_id.'/'.$puser->profile_img; ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    <?php } ?>
                                    <span class="team-name"><?php echo $puser->first_name.' '.$puser->last_name; ?></span>
                                    <span class="label bg-info-600"><?php echo $puser->name; ?></span>
                                    <a data-id="<?php echo $puser->pu_id;?>" class="removeUser bg-danger-600" href="">Remove</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
<!--                <div class="category-content">-->
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>" class="btn bg-teal-400 btn-block btn-float btn-float-lg " href="">
                                <i class="icon-clipboard2"></i> <span> Tasks</span>
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="<?php echo BASE; ?>projects/discussion/<?php echo $this->uri->segment(3); ?>" class="btn bg-purple-300 btn-block btn-float btn-float-lg">
                                <i class="icon-mail-read"></i> <span>Discussions</span>
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="<?php echo BASE; ?>projects/team/<?php echo $this->uri->segment(3); ?>" class="btn bg-blue btn-block btn-float btn-float-lg">
                                <i class="icon-people"></i> <span>Users</span>
                            </a>
                        </div>
                    </div>
<!--                </div>-->
                <div class="clearfix"></div><br>
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-clipboard2"></i> Tasks Status</h5>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container" >
                            <div class="chart" style="width: 100%; min-height: 350px" id="basic_donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-clipboard2"></i> Overdue Tasks
                            <?php if(!empty($tasks)){ ?>
                            <span class="label label-danger position-right"><?php echo count($tasks); ?></span>
                            <?php } ?>
                        </h5>
                    </div>
                    <div class="panel-body2">
                        <?php //print_r($tasks); ?>
                        <table id="ProjectTaskList" class="">
                            <tbody>
                            <?php if(!empty($tasks)){
                                $tasks = array_slice($tasks, 0, 10);
                                foreach ($tasks as $task){ ?>
                                <tr class="<?php echo (date('M d, Y',strtotime($task->due_on)) < date('M d, Y',strtotime('now'))?'pastdue':''); ?>" id="TaskRow<?php echo $task->task_id; ?>" data-id="<?php echo $task->task_id; ?>">
                                    <td><?php echo ucfirst($task->title); ?></td>
                                    <td class="text-center"><?php echo $this->Tasks_model->getStatusView($task->status); ?></td>
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
                                </tr>
                            <?php } }else{ ?>
                                <tr class="text-center">
                                    <td colspan="4">No Overdue Tasks</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-heading text-center">
                        <a href="<?php echo BASE; ?>projects/tasks/<?php echo $this->uri->segment(3); ?>" class="btn bg-success-400">View Tasks</a>
                    </div>
                </div>
            </div>


        </div>


<?php $this->load->view('footer'); ?>
<script>
    var base_url = '<?php echo BASE; ?>';
    $(document).ready(function () {
        $(document).on('click','#addTeamUsers',function (e) {
            e.preventDefault();
            var pid = '<?php echo $this->uri->segment(3); ?>';
            $.ajax({
                url: base_url + 'projects/team_users_popup',
                type: 'POST',
                data: {pid: pid},
                success: function (data) {
                    $('#AddTeamMembersModal .modal-content').html(data);
                    $('#AddTeamMembersModal').modal('show');
                }
            });

        });

        $(document).on('click','.removeUser',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to undo this action!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    'url' : '<?php echo BASE; ?>projects/remove_user',
                    'type': 'POST',
                    'data': {id:id},
                    success: function (data) {
//                                console.log(data);
                        swal("Removed!", "User has been removed.", "success");
                        location.reload();
                    }
                });

            });
        });
    });
</script>
<!--   MODAL FOR TEAM USERS ADD     -->
<div id="AddTeamMembersModal" class="modal fade ">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
