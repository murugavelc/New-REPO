<?php $this->load->view('admin/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_extension_buttons_html5.js"></script>
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
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> Reports</span> - Product Biddings</h4>
            </div>

            <div class="heading-elements">
                <div class="forn-group">
                    <select name="" class="selectbox" style="max-width: 250px; width:100%;" id="ProductDrop">
                        <?php
                        $i = 1;
                        foreach($products as $product){
                            if($i == 1){
                                echo '<option selected="selected" value="' . $product->product_id . '">' . $product->title . ' ( #'.$product->product_id.')</option>';
                            }else {
                                echo '<option value="' . $product->product_id . '">' . $product->title . ' ( #'.$product->product_id.')</option>';
                            }
                            $i++;
                        }
                        ?>
                    </select>
                </div>
                <div class="heading-btn-group">
<!--                    <a href="--><?php //echo ADMIN_URL; ?><!--products/add" class="btn btn-success"><i class="icon-user-plus"></i> Add Product</a>-->
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Reports - Product Biddings</li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="panel panel-flat">
            <div id="TableContent" class="content">
                <table class="table datatable-button-html5-basic2 table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Bidder Name</th>
                        <th>Bid Amount</th>
                        <th>Datetime</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($biddings)){ $i = 1;
                        foreach ($biddings as $bid){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $bid->first_name.' '.$bid->last_name; ?></td>
                                <td><?php echo $bid->bid_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                <td><?php echo date('d M, Y h:i:s A',strtotime($bid->created_on)); ?></td>
                            </tr>
                            <?php $i++; }
                    } ?>

                    </tbody>
                </table>
            </div>
        </div>


        <?php $this->load->view('admin/footer'); ?>
        <script>
            var base_url = '<?php echo BASE; ?>';
            $(document).ready(function(){

                $('.selectbox').select2({ width: '250px' });



                $(document).on('change','#ProductDrop',function (e) {
                    e.preventDefault();
                    var id = $(this).val();
//                    alert(id);
                    $.ajax({
                        'url' : base_url+'admin/reports/bidding_ajax',
                        'type': 'POST',
                        'data': {id:id},
                        beforeSend: function(){
                            swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                        },
                        success: function (data) {
//                                console.log(data);
                            swal.close();
                            $('#TableContent').html(data);
                        }
                    });
                    return false;
                });
            });
        </script>