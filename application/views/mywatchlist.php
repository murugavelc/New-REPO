<?php $this->load->view('header'); ?>

<!-- /Main panel -->
<div class="myaccount">
  <div class="container">
    <div class="row">
<h2 class="title mart-50">My Account</h2>

<div class="row">
<div class="col-md-12">

<div class="col-md-3"> <div class="row"> <!-- required for floating -->
<!-- Nav tabs -->
<ul class="nav nav-tabs tabs-left">
<li><a href="<?php echo BASE; ?>myaccount">Account Info</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mybiddings">My Biddings</a></li>
<li class="active"><a href="<?php echo BASE; ?>myaccount/mywatchlist">My Watchlist</a></li>
<li><a href="<?php echo BASE; ?>myaccount/forgetpassword">Change Password</a></li>
</ul>
</div></div>




<div class="col-md-9">
<div class="row">
<!-- Tab panes -->
<div class="tab-content">


<!--- accountinfo-->

<!--- biddings-->
<div class="tab-pane active" id="biddings">
<h2 class="title">My Watchlist</h2>



            <?php
//                print_r($products);
                if(!empty($products)){
                    foreach ($products as $product){
                        ?>

                        <div class="bid-listing-bg">
                            <div class="row">
                                <!-- /left pannel  -->
                                <div class="col-md-9">
                                    <!---- ---- ---- -- -->
                                    <div class="lising-head">
                                        <div class="col-md-8">
                                            <div class="row">
                                               <h4><?php echo $product->title; ?></h4>
                                                <p><?php echo $product->salvage_location; ?></p>
                                                <h5><?php echo $product->insurance_company; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pull-right">
                                            <div class="row">
                                                <?php if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) > date('Y-m-d H:i:s',strtotime('now')) ){ ?>
                                                <a href="<?php echo BASE; ?>biddings/view/<?php echo $product->product_id; ?>" class="start-bid">Active</a>
												 <?php } else { ?>
													 <a href="javascript:void(0)" class="start-bid">Bid Closed</a>
												 <?php } ?>			
                                            </div>
                                        </div>
                                    </div>
                                    <!---- ---- ---- -- -->

                                    <div class="bidding-footer">

                                       <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>Bid </h6>
                                            <p class="date">Start date</p>
                                            <h3><?php echo date('d:m:Y',strtotime($product->start_datetime)); ?></h3>
                                        </div>

                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>Bid </h6>
                                            <p class="date">closes in</p>
                                            <h3><?php echo date('d:m:Y',strtotime($product->end_datetime)); ?></h3>
                                        </div>

                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>Highest  </h6>
                                            <p class="date">Bid</p>
                                            <h3><?php echo $product->base_price; ?> <span>dh</span></h3>
                                        </div>

                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>Number of  </h6>
                                            <p class="date">Bids</p>
                                            <h3 class="text-center"><?php echo $this->Products_model->biddingcount($product->product_id);?></h3>
                                        </div>

                                    </div>

                                </div>
                                <!-- /right pannel  -->

                                <div class="col-md-3 col-xs-12">
                                    <a href="#">
                                        <?php
                                        $product_imgs = $this->Products_model->getProductImagesById($product->product_id);
                                        if(isset($product_imgs[0]->product_img) && $product_imgs[0]->product_img != ''){ ?>
                                            <img class="img-responsive" src="<?php echo BASE; ?>uploads/products/<?php echo $product->product_id; ?>/thumb/<?php echo $product_imgs[0]->product_img; ?>" alt="">
                                        <?php }else{ ?>
                                            <img class="img-responsive" src="<?php echo BASE; ?>assets/images/products-img.png" alt="">
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                        </div>
						 <?php
                    }
                } else {?>
				<div class="text-center text-danger">No records found</div>
				<?php } ?>

            


              <div class="pagenation"><?php  echo $this->pagination->create_links();?></div>



</div>
<!--- biddings-->

</div>
</div>
</div>
</div></div>



   </div>
  </div>
</div>
<!-- /Main panel -->


<?php $this->load->view('footer'); ?>

<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
