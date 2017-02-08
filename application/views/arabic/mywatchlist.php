<?php $this->load->view('arabic/header'); ?>

<!-- /Main panel -->
<div class="myaccount">
  <div class="container">
    <div class="row">
<h2 class="title mart-50">حسابي</h2>

<div class="row">
<div class="col-md-12">

<div class="col-md-3"> <div class="row"> <!-- required for floating -->
<!-- Nav tabs -->
<ul class="nav nav-tabs tabs-left">
<li><a href="<?php echo BASE; ?>myaccount">معلومات الحساب</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mybiddings">بلدي المناقصات</a></li>
<li class="active"><a href="<?php echo BASE; ?>myaccount/mywatchlist">قائمة الرغبات الخاصة بي</a></li>
<li><a href="<?php echo BASE; ?>myaccount/forgetpassword">تغيير كلمة السر</a></li>
</ul>
</div></div>




<div class="col-md-9">
<div class="row">
<!-- Tab panes -->
<div class="tab-content">


<!--- accountinfo-->

<!--- biddings-->
<div class="tab-pane active" id="biddings">
<h2 class="title">قائمة الرغبات الخاصة بي</h2>



            <?php
//                print_r($products);
                if(!empty($products)){
                    foreach ($products as $product){
                        ?>

                        <div class="bid-listing-bg">
                            <div class="row">

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
                                                <a href="<?php echo BASE; ?>biddings/view/<?php echo $product->product_id; ?>" class="start-bid">نشط</a>
												 <?php } else { ?>
													 <a href="javascript:void(0)" class="start-bid">محاولة مقفلة</a>
												 <?php } ?>			
                                            </div>
                                        </div>
                                    </div>
                                    <!---- ---- ---- -- -->

                                    <div class="bidding-footer">

                                       <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>عرض </h6>
                                            <p class="date">تاريخ البدء</p>
                                            <h3><?php echo date('d:m:Y',strtotime($product->start_datetime)); ?></h3>
                                        </div>

                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>عرض </h6>
                                            <p class="date">يغلق في</p>
                                            <h3><?php echo date('d:m:Y',strtotime($product->end_datetime)); ?></h3>
                                        </div>

                                        <?php $bidamt = $this->Products_model->highestbidamt($product->product_id);?>
                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>أعلى  </h6>
                                            <p class="date">عرض</p>
                                            <h3><?php if($bidamt != '') { echo $bidamt; } else { echo $product->base_price; }?> <span>درهم</span></h3>
                                        </div>

                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>عدد </h6>
                                            <p class="date">عطاءات</p>
                                            <h3 class="text-center"><?php echo $this->Products_model->biddingcount($product->product_id);?></h3>
                                        </div>

                                    </div>

                                </div>
                                <!-- /right pannel  -->

                               
                            </div>
                        </div>
						 <?php
                    }
                } else {?>
				<div class="text-center text-danger">لا توجد سجلات</div>
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


<?php $this->load->view('arabic/footer'); ?>

<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
