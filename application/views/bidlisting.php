<?php
$this->load->view('header');
?>

<!-- /Main panel -->
<div class="listingpage">

    <!-- /Search  panel -->
	<form action="<?php echo BASE; ?>/biddings" method="post" id="frm-search">
	<input type="hidden" id="url" value="<?php echo BASE; ?>">
    <div class="search-pannel">
        <div class="container">
            <div class="col-md-8 col-md-offset-1 col-centered">

                <div class="col-md-12">
                    <div class="row">
                        <input type="text" class="form-control" placeholder="Search" id="autosearch" name="autosearch" value="<?php echo $_POST['autosearch']; ?>" autocomplete="off"/>
                        <button class="search-icon" type="submit"></button>
						<input type="hidden" name="product_id" id="product_id" value="<?php echo $_POST['product_id']; ?>">
                    </div>
					<div class="product-dropdown">
						<ul class="dropdown-menu" id="product-dropdown" style="width:100%">
						
						</ul>
					 </div>
                </div>

                <!-- <div class="col-md-1 text-center">
                    <h2 class="or">Or</h2>
                </div>

                <div class="col-md-3">
                    <div class="row">
                        <a href="" class="search-btn">Advance Search</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- /Search  panel -->


    <div class="container">
        <div class="row">

            <!-- /Left  panel -->
            <div class="col-md-4">
            <h2 class="title">Search Filters</h2>

            <div class="form-group">
            <label class="formlabel">Brand</label>
            <input  class="form-control"  type="text" name="brand" value="<?php echo $_POST['brand']; ?>">
            </div>

            <div class="form-group">
            <label class="formlabel">Model</label>
            <input  class="form-control"  type="text" name="model" value="<?php echo $_POST['model']; ?>">
            </div>


            <div class="form-group">
            <label class="formlabel">Year</label><br>
            <input id="ex16b" type="text" name="year" />
            </div>

             <div class="form-group">
            <label class="formlabel">Price</label>
            <div class="row">
            <div class="col-md-6"><input  class="form-control"  type="text" name="price_from" value="<?php echo $_POST['price_from']; ?>" onkeypress="return isNumberKey(event);"></div>
            <div class="col-md-6"><input  class="form-control"  type="text" name="price_to" value="<?php echo $_POST['price_to']; ?>" onkeypress="return isNumberKey(event);"></div>
            </div></div>

            <div class="form-group">
            <label class="formlabel">Location</label>
            <input  class="form-control"  type="text" name="location" value="<?php echo $_POST['location']; ?>">
            </div>

            <div class="form-group fual-type">
            <label class="formlabel">Fuel Type</label><br>
            <ul class="frontend">
            <li><input type="checkbox" value="1" name="fuel-diesel" id="check1" <?php echo ($_POST['fuel-diesel'] ==1)?"checked":""; ?>><label for="check1">Diesel</label></li>
            <li><input type="checkbox" value="2" name="fuel-petrol" id="check2" <?php echo ($_POST['fuel-petrol'] ==2)?"checked":""; ?>><label for="check2">Petrol</label></li>
            <li><input type="checkbox" value="3" name="fuel-gas" id="check3" <?php echo ($_POST['fuel-gas'] == 3)?"checked":""; ?>><label for="check3" >Gasoline</label></li>
            </ul>
            </div>

            <div class="col-md-12 mart-35 text-center showfitbtn">
             <div class="row">
             <button type="submit" class="site-btn">Search</button> 
             </div>
            </div>


            </div>
            <!-- /Left  panel -->

            <!-- /right  panel -->
            <div class="col-md-8">

                <?php
//                print_r($products);
                if(!empty($products)){
                    foreach ($products as $product){
                        ?>
                        <!-- /listing pannel  -->
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
                                        <div class="col-md-4 stat-bidding-btn">
                                            <div class="row">
                                                <a href="<?php echo BASE; ?>biddings/view/<?php echo $product->product_id; ?>" class="start-bid">Start Bidding</a>
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
                                        <?php $bidamt = $this->Products_model->highestbidamt($product->product_id);?>
                                        <div class="col-md-3 col-xs-6 left-bor">
                                            <h6>Highest  </h6>
                                            <p class="date">Bid</p>
                                            <h3><?php if($bidamt != '') { echo $bidamt; } else { echo $product->base_price; }?> <span>dh</span></h3>
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
                        <!-- /listing pannel  -->
                        <?php
                    }
                } else {?>
				<div class="text-center text-danger">No records found</div>
				<?php } ?>

            


              <div class="pagenation"><?php  echo $this->pagination->create_links();?></div>
            </div>
            <!-- /right pannel panel -->

        </div>
    </div>
	</form>
</div>
<!-- /Main panel -->

<?php

$this->load->view('footer');
?>
<script>
$("#autosearch").on("keyup",function(){
	if($(this).val() != ''){
		$.ajax({
			url: $("#url").val()+"biddings/autosearch",
			method: "post",
			data: {search:$(this).val()}
		}).done(function(response){
			var json = JSON.parse(response);
			console.log(json.count);
			var list = '';
			if(json.count > 0){
				for(var key in json.list){
					list += '<li><a href="#" onclick="selectopt('+json.list[key]['id']+','+"'"+json.list[key]['product_name']+"'"+');return false;">'+json.list[key]['product_name']+'</a></li>';
				}
				$("ul#product-dropdown").html(list);
				$("ul#product-dropdown").show();
			} else{
				$("ul#product-dropdown").html('<li><a href="#" onclick="return false;">No records match</a></li>');
				$("ul#product-dropdown").show();
			}
		});
	} else{
		$("ul#product-dropdown").hide();
	}
});
function selectopt(id,name){	
	$("#product_id").val(id);
	$("#autosearch").val(name);
	$("ul#product-dropdown").hide();
	$("#frm-search").submit();
}
function isNumberKey(evt) {
	if(evt.which!=0) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode == 46) return true;
		else if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	} else {
		return true;
	}
}
</script>