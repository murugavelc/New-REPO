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
                <h4><i class="icon-stack2"></i><span class="text-semibold">Projects</span>
                </h4>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a href="<?php echo BASE; ?>projects/add" class="btn btn-success btn-icon btn-sm"><i class="icon-plus2"></i> Add New Project</a>
                </div>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
<!--        <div class="row page_header">-->
<!--            <div class="col-sm-6">-->
<!--                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Projects</span></h4>-->
<!--            </div>-->
<!--            <div class="col-sm-6 text-right">-->
<!--                <form class="search_filter_form navbar-form">-->
<!--                    <div class="form-group has-feedback">-->
<!--                        <input class="form-control search_filter" placeholder="Search Filter..." type="search">-->
<!--                        <div class="form-control-feedback">-->
<!--                            <i class="icon-search4 text-muted text-size-base"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
                <a href="<?php echo BASE; ?>projects/add" class="btn btn-success"><i class="icon-plus2"></i><span> Add New Project</span></a>
<!--            </div>-->
<!--        </div>-->

        <div class="datatable-wrapper panel-flat">

            <div class="row">
                <?php if(!empty($projects)){
                    foreach ($projects as $project){ ?>
                        <div class="col-sm-3">
                            <div class="project_block">
                                <h5><?php echo $project->project_name; ?></h5>
                                <p>Client Name : <?php echo $project->project_name; ?></p>
                                <p><?php echo date('Y-m-d',strtotime($project->start_date)); ?></p>
                                <p><?php echo date('Y-m-d',strtotime($project->end_date)); ?></p>
                                <p><span class="label label-success">Active</span></p>
                                <p class="text-center">
                                    <ul class="actions icons-list">
                                        <li class=""><a data-popup="tooltip" title="Discussions" href="<?php echo BASE; ?>projects/discussion/<?php echo encode($project->project_id); ?>" class="btn bg-primary-800 text-white btn-xs"><i class="icon-bubbles7"></i></a></li>
                                        <li class=""><a data-popup="tooltip" title="Tasks" href="<?php echo BASE; ?>projects/tasks/<?php echo encode($project->project_id); ?>" class="btn bg-primary-800 text-white btn-xs"><i class="icon-googleplus5"></i></a></li>
                                        <li class=""><a data-popup="tooltip" title="View" href="<?php echo BASE; ?>projects/dashboard/<?php echo encode($project->project_id); ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                        <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo BASE; ?>projects/edit/<?php echo $project->project_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $project->project_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    <?php } } ?>

            </div>

            <table class="table datatable-basic table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(!empty($projects)){
                        foreach ($projects as $project){ ?>
                        <tr>
                            <td><?php echo $project->project_name; ?></td>
                            <td><?php echo $project->client_first.' '.$project->client_last; ?></td>
                            <td><?php echo date('Y-m-d',strtotime($project->start_date)); ?></td>
                            <td><?php echo date('Y-m-d',strtotime($project->end_date)); ?></td>
                            <td><span class="label label-success">Active</span></td>
                            <td class="text-center">
                                <ul class="actions icons-list">
                                    <li class=""><a data-popup="tooltip" title="Discussions" href="<?php echo BASE; ?>projects/discussion/<?php echo encode($project->project_id); ?>" class="btn bg-primary-800 text-white btn-xs"><i class="icon-bubbles7"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Tasks" href="<?php echo BASE; ?>projects/tasks/<?php echo encode($project->project_id); ?>" class="btn bg-primary-800 text-white btn-xs"><i class="icon-googleplus5"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo BASE; ?>projects/dashboard/<?php echo encode($project->project_id); ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo BASE; ?>projects/edit/<?php echo $project->project_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $project->project_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
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
            });
        </script>