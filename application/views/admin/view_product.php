<?php
//print_r($user);
$this->load->view('admin/header');
?>
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.countdown.css">
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/media/fancybox.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/components_thumbnails.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Products</span> - View - <?php echo ucfirst($product->title); ?></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo ADMIN_URL; ?>products" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Products</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo ADMIN_URL; ?>products"> Products</a></li>
                <li class="active">View - <?php echo ucfirst($product->title); ?></li>
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
                            <div class="col-md-6">
                                <small><i class="icon-calendar2"></i> <b>Start Date&nbsp;:</b> <?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?> </small><br>

                            </div>
                            <div class="col-md-6 text-right">
                                <small><i class="icon-calendar2"></i> <b>End Date&nbsp;:</b> <?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?> </small>
                            </div>
                            <br>

                            <hr>
                            <?php if($product->is_motor == 1){ ?>
                                <div class="col-md-12">
                                    <h4 class="vehicle-heading">Vehicle Information :</h4>
                                    <table class="table vehicle">
                                        <tr>
                                            <th>Vehicle Type:</th>
                                            <td><?php echo $product->vehicle_type; ?></td>
                                            <th>Brand:</th>
                                            <td><?php echo $product->brand; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Model:</th>
                                            <td><?php echo $product->model; ?></td>
                                            <th>Year:</th>
                                            <td><?php echo $product->year; ?></td>
                                        </tr>
                                        <tr>
                                            <th>KM Driven:</th>
                                            <td><?php echo $product->km_driven; ?></td>
                                            <th>Fuel:</th>
                                            <td>
                                                <?php
                                                switch($product->fuel)
                                                {
                                                    case 0:
                                                        echo '-';
                                                        break;
                                                    case 1:
                                                        echo 'Petrol';
                                                        break;
                                                    case 2:
                                                        echo 'Diesel';
                                                        break;
                                                    case 3:
                                                        echo 'Gasoline';
                                                        break;
                                                }

                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Seating Capacity:</th>
                                            <td><?php echo $product->seating_capacity; ?></td>
                                            <th>Transmission Type:</th>
                                            <td><?php //echo $product->transmission_type;
                                                switch($product->transmission_type)
                                                {
                                                    case 0:
                                                        echo '-';
                                                        break;
                                                    case 1:
                                                        echo 'Automatic';
                                                        break;
                                                    case 2:
                                                        echo 'Manual';
                                                        break;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th>Registration/Plate Number:</th>
                                            <td><?php echo $product->registration_number; ?></td>
                                            <th>Registration Expiry:</th>
                                            <td><?php echo date('d M, Y',strtotime($product->registration_expiry)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Chasis Number:</th>
                                            <td><?php echo $product->chasis_number; ?></td>
                                            <th>Engine Number:</th>
                                            <td><?php echo $product->engine_number; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <h4 class="insurance_heading">Insurance Information :</h4>
                                <table class="table insurance">
                                    <tr>
                                        <th>Loss Type:</th>
                                        <td><?php echo $product->loss_type; ?></td>
                                        <th>In Stock Yard:</th>
                                        <td><?php echo ($product->in_stock_yard == 1 ? 'Yes':'No'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Location of Salvage:</th>
                                        <td><?php echo $product->salvage_location; ?></td>
                                        <th>Insurance Company Name:</th>
                                        <td><?php echo $product->insurance_company; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Policy Number:</th>
                                        <td><?php echo $product->policy_number; ?></td>
                                        <th>Claim Number:</th>
                                        <td><?php echo $product->claim_number; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Owner Name:</th>
                                        <td><?php echo $product->owner_name; ?></td>
                                        <th>Owner Change Date:</th>
                                        <td><?php echo date('d M, Y',strtotime($product->owner_change_date)); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <hr>

                            <?php if($product->description != ''){ ?>
                                <div class="col-md-12">
                                    <h6><b>More Information :</b></h6>
                                    <p><?php echo $product->description; ?> </p>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                            <?php } ?>

                        </div>
                        <div class="text-center">
                            <?php if($product->bid_winner == 0 && $product->approval_init == 0 && $_SESSION['user_type'] != 5){ ?>
                            <a class="btn bg-blue-300" href="<?php echo ADMIN_URL; ?>products/edit/<?php echo $product->product_id; ?>"><i class="icon-pencil"></i> Edit Product</a>
                            <?php }elseif($_SESSION['user_type'] != 5){ ?>
                                <a class="btn bg-blue-300" href="<?php echo ADMIN_URL; ?>products/closed_edit/<?php echo $product->product_id; ?>"><i class="icon-pencil"></i> Edit Product</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-4">

                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Bidding Details</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
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
                                <h1 class="no-margin"><small>Current Bid: </small><br><?php echo $current_bid['current_price']; ?><small> <?php echo PRICE_PRE; ?></small></h1>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h1 class="no-margin"><small>Total Bids: </small><br><?php echo $total_bids; ?></h1>
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
                                alert('Done!');
                                location.reload();
                            });
                        </script>
                        <?php } ?>


                    </div>
                    <div class="panel-footer text-center" style="padding:15px">
                        <a class="btn bg-success" href="<?php echo ADMIN_URL; ?>products/view_biddings/<?php echo $product->product_id; ?>"><i class="icon-eye"></i> View Biddings</a>
                    </div>
                </div>

                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Product Images</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <?php if(!empty($product_imgs)){
                            foreach ($product_imgs as $img){
                            ?>
                                <?php if($img->product_img != '' && file_exists('./uploads/products/'.$product->product_id.'/thumb/'.$img->product_img)){ ?>
                                    <div class="thumb col-sm-6 no-padding product-img">
                                        <img src="<?php echo BASE.'uploads/products/'.$product->product_id.'/thumb/'.$img->product_img; ?>" alt="">
                                        <div class="caption-overflow">
                                            <span>
                                                <a rel="<?php echo $product->title; ?>" href="<?php echo BASE.'uploads/products/'.$product->product_id.'/'.$img->product_img; ?>" class="btn bg-teal-300 btn-rounded btn-icon" data-popup="lightbox"><i class="icon-zoomin3"></i></a>
                                            </span>
                                        </div>
                                    </div>
<!--                                    <img id="blah" width="49%" height="49%" class="" src="--><?php //echo BASE.'uploads/products/'.$product->product_id.'/thumb/'.$img->product_img; ?><!--" alt="">-->
                                <?php }else{ ?>
                                    <div class="thumb col-sm-6 no-padding">
                                        <img class="" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    </div>
                                <?php } ?>

                        <?php }
                        } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('admin/footer'); ?>