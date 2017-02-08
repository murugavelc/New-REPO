<?php $this->load->view('admin/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script>var target = {columnDefs: [{
        orderable: false,
        width: '200px',
        targets: [ 5 ]
    }],};</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> Salvage Users</span></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo ADMIN_URL; ?>users/add/2" class="btn btn-success"><i class="icon-user-plus"></i> Add New Salvage</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Users - Salvage</li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">


        <div class="panel panel-flat">

            <table class="table datatable-basic table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>User Role</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php GLOBAL $USER_ROLES; if(!empty($users)){ foreach ($users as $user){ ?>
                        <tr>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $USER_ROLES[$user->user_type]; ?></td>
                            <td><span class="label label-success">Active</span></td>
                            <td class="text-center">
                                <ul class="actions icons-list">
<!--                                    <li class=""><a data-popup="tooltip" title="View" href="--><?php //echo ADMIN_URL; ?><!--users/view/--><?php //echo $user->user_id; ?><!--" class="btn btn-info text-white btn-xs"><i class="icon-eye"></i></a></li>-->
                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>users/edit/<?php echo $user->user_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $user->user_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>


<?php $this->load->view('admin/footer'); ?>
