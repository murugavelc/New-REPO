<?php
//print_r($user);
$this->load->view('admin/header');
?>
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.countdown.css">
<!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/media/fancybox.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/components_thumbnails.js"></script>
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
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Products</span> - View Biddings - <?php echo ucfirst($product->title).' (#'.$product->product_id.')'; ?></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Product</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo ADMIN_URL; ?>products"> Products</a></li>
                <li class="active">View Biddings - <?php echo ucfirst($product->title).' (#'.$product->product_id.')'; ?></li>
            </ul>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="row">

            <div class="col-md-8">

                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Bidding Details</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <h1 class="no-margin"><small>Bid Closes in: </small></h1>
                                <?php
                                //                                echo 'end:'.date('Y-m-d H:i:s',strtotime($product->end_datetime));
                                //                                echo 'now:'.date('Y-m-d H:i:s',strtotime('now'));
                                if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) > date('Y-m-d H:i:s',strtotime('now')) ){ ?>
                                    <ul class="no-margin adTimer" id="example">
                                        <li><span class="days">00</span><p class="days_text">Days</p></li>
                                        <li class="seperator">:</li>
                                        <li><span class="hours">00</span><p class="hours_text">Hours</p></li>
                                        <li class="seperator">:</li>
                                        <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
                                        <li class="seperator">:</li>
                                        <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
                                    </ul>
                                <?php }else{
                                    if($product->bid_winner == 0){ ?>
                                    <h4 class="label label-danger" style="padding: 10px 15px; font-size: 15px;">Bid Ends</h4>
                                <?php }else{ ?>
                                    <h4 class="label bg-slate" style="padding: 10px 15px; font-size: 15px;">Bid Closed</h4>
                                <?php }
                                } ?>
                                <!--                                <h1 class="no-margin">--><?php //echo $product->end_datetime; ?><!--</h1>-->
                            </div>
                            <div class="col-sm-6">
                                <h1 class="no-margin display-inline-block"><small>Current Bid: </small><br><?php echo $current_bid['current_price']; ?><small> <?php echo PRICE_PRE; ?></small></h1>

                                <h1 class="no-margin pull-right"><small>Total Bids: </small><br><?php echo $total_bids; ?></h1>
                            </div>

                        </div>


                        <?php if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) > date('Y-m-d H:i:s',strtotime('now')) ){ ?>
                            <script type="text/javascript">
                                $('#example').countdown({
                                    date: '<?php echo date('Y-m-d H:i:s',strtotime($product->end_datetime)); ?>',
                                    offset: +5.5,
                                    day: 'Day',
                                    days: 'Days'
                                }, function () {
                                    swal({
                                        title: "Success!",
                                        text: "Bidding has been completed successfully!",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success"
                                    },function(){
                                        location.reload();
                                    });
                                });
                            </script>
                        <?php } ?>

                        <hr>

                        <table class="table datatable-basic table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Bidder Name</th>
                                    <th>Bid Amount</th>
                                    <th>Datetime</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($all_bids)){ $i = 1;
                                    foreach ($all_bids as $bid){ ?>
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
                    <div class="panel-footer text-center" style="padding:15px">

                        <?php if(!empty($winner)){
                            echo '<h1>Winner : '.$winner->first_name.' '.$winner->last_name.'</h1>';
                            echo '<h4>Close Price :'.$winner->bid_price.'<small> '.PRICE_PRE.'</small></h4>';
                        }else{
                            echo '<h1>Winner : TBA</h1>';
                        } ?>
                        <?php if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) < date('Y-m-d H:i:s',strtotime('now')) ){
                            if($product->bid_winner == 0){
                                if(!empty($winner)){
                                ?>
                                    <h4 class="label bg-teal" style="padding: 10px 15px; font-size: 15px;">Awaiting Approval</h4>
                            <?php }else{ ?>
                                    <h4 class="label label-danger" style="padding: 10px 15px; font-size: 15px;">No Bids Available</h4>
                                <?php }
                            }else{
                                if($product->bid_winner == 0){ ?>
                                    <h4 class="label label-danger" style="padding: 10px 15px; font-size: 15px;">Bid Ends</h4>
                                <?php }else{ ?>
                                    <h4 class="label bg-slate" style="padding: 10px 15px; font-size: 15px;">Bid Closed</h4>
                                <?php }
                            }
                         } ?>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Product Details</h4>
                    </div>
                    <div class="panel-body">
                        <div id="ProfileView" class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin"><?php echo $product->title; ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4 class="no-margin">Base Price :</h4>
                                <h1 class="no-margin"><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></h1>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="col-md-12">
                                <small><i class="icon-calendar2"></i> <b>Start Date&nbsp;:</b> <?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?> </small><br> <br>
                                <small><i class="icon-calendar2"></i> <b>End Date&nbsp;:</b> <?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?> </small>
                            </div>

                            <?php if($product->description != ''){ ?>
                                <div class="col-md-12">
                                    <h6><b>More Information :</b></h6>
                                    <p><?php echo $product->description; ?> </p>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                            <?php } ?>

                        </div>
                        <br/>
                        <div class="text-center">
                            <a class="btn bg-blue-300" href="<?php echo ADMIN_URL; ?>products/view/<?php echo $product->product_id; ?>"><i class="icon-eye"></i> View Product</a>
                        </div>
                    </div>
                </div>


            </div>


        </div>
<?php $this->load->view('admin/footer'); ?>
        <script>
            $(document).ready(function(){
                $(document).on('submit','#CloseBidForm',function(e){
                    var formData = new FormData($('#CloseBidForm')[0]);
                    e.preventDefault();
                    $.ajax({
                        url: "<?php echo ADMIN_URL; ?>products/close_bid",
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function(){
                            swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                        },
                        success: function(data){
                            console.log(data);
                            if(data.error){
                                swal.close();
                            }else{
                                swal({
                                    title: "Success!",
                                    text: "Product bid has been closed successfully!",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success"
                                },function(){
                                    location.reload();
                                });
                            }
                        },
                        error: function(){

                        }
                    });
                })
            });
        </script>
