<?php $this->load->view('admin/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script>
    var target = {columnDefs: [{ orderable: false, width: '200px', targets: [ 5 ] }],};
    var target2 = {columnDefs: [{ orderable: false, width: '200px', targets: [ 7 ] }],};
    var target3 = {columnDefs: [{ orderable: false, width: '200px', targets: [ 8 ] }],};
</script>
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
                    <?php if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2){ ?>
                    <a href="<?php echo ADMIN_URL; ?>products/add" class="btn btn-success"><i class="icon-user-plus"></i> Add Product</a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Products</li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">


        <div class="panel panel-flat">

            <!-- TAB STARTS -->
            <div class="tabbable">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="active"><a href="#basic-tab1" data-toggle="tab">Active Biddings</a></li>
                    <li><a href="#basic-tab2" data-toggle="tab">Upcoming Biddings</a></li>
                    <li><a href="#completed" data-toggle="tab">Completed Biddings</a></li>
                    <li><a href="#approval" data-toggle="tab">Awaiting Approval</a></li>
                    <li><a href="#basic-tab3" data-toggle="tab">Closed Biddings</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="basic-tab1">
                        <div class="content">
                            <table class="table datatable-basic2 table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Base Price</th>
                                    <th>Current Bid</th>
                                    <th>Total Bid</th>
                                    <th>Start Datetime</th>
                                    <th>End Datetime</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php GLOBAL $USER_ROLES; if(!empty($active)){ foreach ($active as $product){ ?>
                                    <tr>
                                        <td><?php echo $product->product_id; ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php $current = $this->Products_model->getHighestBidByProduct($product->product_id); echo $current['current_price']; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php echo $this->Products_model->getTotalBidsByProduct($product->product_id); ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?></td>
                                        <td class="text-center">
                                            <ul class="actions icons-list">
                                                <?php if($_SESSION['user_type'] == 5){ ?>
<!--                                                    <li><label class="btn btn-danger text-white disabled btn-xs" href="">No Access</label></li>-->
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                <?php }else{ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                    <?php if($product->bid_winner == 0){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>products/edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                                    <?php } ?>
                                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $product->product_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="basic-tab2">
                        <div class="content">
                            <table class="table datatable-basic table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Base Price</th>
                                    <th>Start Datetime</th>
                                    <th>End Datetime</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php GLOBAL $USER_ROLES; if(!empty($upcoming)){ foreach ($upcoming as $product){ ?>
                                    <tr>
                                        <td><?php echo $product->product_id; ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?></td>
                                        <td class="text-center">
                                            <ul class="actions icons-list">
                                                <?php if($_SESSION['user_type'] == 5){ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                <?php }else{ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                    <?php if($product->bid_winner == 0){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>products/edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                                    <?php } ?>
                                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $product->product_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="completed">
                        <div class="content">
                            <table class="table datatable-basic2 table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Base Price</th>
                                    <th>Current Bid</th>
                                    <th>Total Bid</th>
                                    <th>Start Datetime</th>
                                    <th>End Datetime</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php GLOBAL $USER_ROLES; if(!empty($completed)){ foreach ($completed as $product){ ?>
                                    <tr>
                                        <td><?php echo $product->product_id; ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php $current = $this->Products_model->getHighestBidByProduct($product->product_id); echo $current['current_price']; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php $totBids = $this->Products_model->getTotalBidsByProduct($product->product_id); echo $totBids; ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?></td>
                                        <td class="text-center">
                                            <ul class="actions icons-list">
                                                <?php if($_SESSION['user_type'] == 5){ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                <?php }else{ ?>
                                                    <?php if($this->session->userdata('user_type') == 2 && $totBids > 0){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Initiate Approval" data-id="<?php echo $product->product_id; ?>" href="" class="btn bg-slate text-white btn-xs iapproval"><i class="icon-thumbs-up2"></i></a></li>
                                                    <?php }?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                    <?php if($product->bid_winner == 0){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>products/edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                                    <?php } ?>
                                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $product->product_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="approval">
                        <div class="content">
                            <table class="table datatable-basic3 table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Base Price</th>
                                    <th>Current Bid</th>
                                    <th>Total Bid</th>
                                    <th>Approver 1</th>
                                    <th>Approver 2</th>
                                    <th>Approver 3</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php GLOBAL $USER_ROLES; if(!empty($approval)){ foreach ($approval as $product){ ?>
                                    <tr>
                                        <td><?php echo $product->product_id; ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php $current = $this->Products_model->getHighestBidByProduct($product->product_id); echo $current['current_price']; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                        <td><?php echo $this->Products_model->getTotalBidsByProduct($product->product_id); ?></td>
                                        <td class="text-center">
                                            <?php if($product->approver_1 != 1){
                                                if($_SESSION['approver_no'] == 1){ ?>
                                                    <button data-popup="tooltip" title="Click to approve" data-id="<?php echo $product->product_id; ?>" data-approver="1" class="btn bg-slate approverClick">Pending</button>
                                                <?php }else{ ?>
                                                    <span class="label bg-teal">Pending</span>
                                                <?php }
                                            }else{ ?>
                                                <span class="label bg-success">Approved</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($product->approver_2 != 1){
                                                if($_SESSION['approver_no'] == 2){ ?>
                                                    <button data-popup="tooltip" title="Click to approve" data-id="<?php echo $product->product_id; ?>" data-approver="2" class="btn bg-slate  approverClick">Pending</button>
                                                <?php }else{ ?>
                                                    <span class="label bg-teal">Pending</span>
                                                <?php }
                                            }else{ ?>
                                                <span class="label bg-success">Approved</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($product->approver_3 != 1){
                                                if($_SESSION['approver_no'] == 3){ ?>
                                                    <button data-popup="tooltip" title="Click to approve" data-id="<?php echo $product->product_id; ?>" data-approver="3" class="btn btn-xs bg-slate approverClick">Pending</button>
                                                <?php }else{ ?>
                                                    <span class="label bg-teal">Pending</span>
                                                <?php }
                                            }else{ ?>
                                                <span class="label bg-success">Approved</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <ul class="actions icons-list">
                                                <?php if($_SESSION['user_type'] == 5){ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                <?php }else{ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                    <?php if($product->bid_winner == 0 ){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>products/closed_edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                                    <?php } ?>
                                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $product->product_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="basic-tab3">
                        <div class="content">
                            <table class="table datatable-basic table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Base Price</th>
<!--                                    <th>Close Price</th>-->
<!--                                    <th>In Stock Yard</th>-->
                                    <th>Start Datetime</th>
                                    <th>End Datetime</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php GLOBAL $USER_ROLES; if(!empty($closed)){ foreach ($closed as $product){ ?>
                                    <tr>
                                        <td><?php echo $product->product_id; ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
<!--                                        <td>--><?php //echo $product->bid_close_price; ?><!--<small> dh</small></td>-->
<!--                                        <td>--><?php //echo ($product->in_stock_yard == 1 ? 'Yes':'No'); ?><!--</td>-->
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?></td>
                                        <td><?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?></td>
                                        <td class="text-center">
                                            <ul class="actions icons-list">
                                                <?php if($_SESSION['user_type'] == 5){ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                <?php }else{ ?>
                                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>products/closed_edit/<?php echo $product->product_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                                        <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $product->product_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <?php $this->load->view('admin/footer'); ?>
        <script>
            var base_url = '<?php echo BASE; ?>';
            $(document).ready(function(){

                $(document).on('click','.iapproval',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        'url' : base_url+'admin/products/approval_init',
                        'type': 'POST',
                        'data': {id:id},
                        beforeSend: function(){
                            swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                        },
                        success: function (data) {
//                                console.log(data);
                            swal({
                                title: "Approval Initiated!",
                                text: "Approval initiation has been done successfully!",
                                confirmButtonColor: "#66BB6A",
                                type: "success"
                            },function(){
                                location.reload();
                            });
                        }
                    });
                });

                $(document).on('click','.approverClick',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var approver = $(this).data('approver');
                    $.ajax({
                        'url' : base_url+'admin/products/product_approval',
                        'type': 'POST',
                        'data': {id:id,approver:approver},
                        beforeSend: function(){
                            swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                        },
                        success: function (data) {
//                                console.log(data);
                            swal({
                                title: "Success!",
                                text: "Product has been approved successfully!",
                                confirmButtonColor: "#66BB6A",
                                type: "success"
                            },function(){
                                location.reload();
                            });
                        }
                    });
                });

                $(document).on('click','.delete',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this product!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: false
                        },
                        function(){
                            $.ajax({
                                'url' : base_url+'admin/products/delete',
                                'type': 'POST',
                                'data': {id:id},
                                beforeSend: function(){
                                    swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                                },
                                success: function (data) {
//                                console.log(data);
                                    swal({
                                        title: "Deleted!",
                                        text: "Product has been deleted successfully!",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success"
                                    },function(){
                                        location.reload();
                                    });
                                }
                            });

                        });
                    return false;
                });
            });
        </script>