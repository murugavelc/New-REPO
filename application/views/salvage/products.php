<?php $this->load->view('salvage/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script>var target = {columnDefs: [{
        orderable: false,
        width: '200px',
        targets: [ 3 ]
    }],};</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> Products</span></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo SALVAGE_URL; ?>products/add" class="btn btn-success"><i class="icon-user-plus"></i> Add Product</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo SALVAGE_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Products</li>
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
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Base Price</th>
<!--                    <th>Email Address</th>-->
<!--                    <th>User Role</th>-->
<!--                    <th>Status</th>-->
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php GLOBAL $USER_ROLES; if(!empty($products)){ foreach ($products as $product){ ?>
                    <tr>
                        <td><?php echo $product->product_id; ?></td>
                        <td><?php echo $product->title; ?></td>
                        <td><?php echo $product->base_price; ?><small> dh</small></td>
<!--                        <td>--><?php //echo $USER_ROLES[$user->user_type]; ?><!--</td>-->
<!--                        <td><span class="label label-success">Active</span></td>-->
                        <td class="text-center">
                            <ul class="actions icons-list">
                                <li class=""><a data-popup="tooltip" title="View" href="<?php echo SALVAGE_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo SALVAGE_URL; ?>products/edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
<!--                                <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="--><?php //echo $product->product_id; ?><!--" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>-->
                            </ul>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>


        <?php $this->load->view('salvage/footer'); ?>
