
<?php if(!empty($projects)){
    foreach ($projects as $project){ ?>
        <div class="col-sm-3 animated fadeIn">
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
<script>
    $(function () {
        $('[data-popup="tooltip"]').tooltip();
    });
</script>