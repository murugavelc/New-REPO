<?php //print_r($roles);
$this->load->view('header');
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script>var target = {columnDefs: [{
        orderable: false,
        width: '250px',
        targets: [ 1 ]
    }],};</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
<!--    <div class="page-header">-->
<!--        <div class="page-header-content">-->
<!--            <div class="page-title">-->
<!--                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> User Roles</span></h4>-->
<!--            </div>-->
<!---->
<!--            <div class="heading-elements">-->
<!--                <div class="heading-btn-group">-->
<!--                    <a href="--><?php //echo BASE; ?><!--roles/add" class="btn btn-success"><i class="icon-user-plus"></i> Add New Role</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="breadcrumb-line">-->
<!--            <ul class="breadcrumb">-->
<!--                <li><a href="--><?php //echo BASE; ?><!--"><i class="icon-home2 position-left"></i> Home</a></li>-->
<!--                <li class="active">Roles</li>-->
<!--            </ul>-->
<!---->
<!--            <ul class="breadcrumb-elements">-->
<!--                <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>-->
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="icon-gear position-left"></i>-->
<!--                        Settings-->
<!--                        <span class="caret"></span>-->
<!--                    </a>-->
<!---->
<!--                    <ul class="dropdown-menu dropdown-menu-right">-->
<!--                        <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>-->
<!--                        <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>-->
<!--                        <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li><a href="#"><i class="icon-gear"></i> All settings</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="row page_header">
            <div class="col-sm-6">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> User Roles</span></h4>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo BASE; ?>roles/add" class="btn btn-success"><i class="icon-user-plus"></i> Add New Role</a>
            </div>
        </div>

        <div class="panel panel-flat">

            <table class="table datatable-basic table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Role Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(!empty($roles)){ foreach ($roles as $role){ ?>
                        <tr>
                            <td><?php echo $role->name; ?></td>
                            <td class="text-center">
                                <ul class="actions icons-list">
                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo BASE; ?>roles/edit/<?php echo $role->type_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $role->type_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>


<?php $this->load->view('footer'); ?>
