<?php
$this->load->view('header');
?>
<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/jquery.countdown.css">
<link href="<?php echo BASE; ?>assets/sliderengine/amazingslider-1.css" rel="stylesheet" type="text/css" />

<!-- /Main panel -->
<div class="listingpageview">

    <!-- /Search  panel -->
	<form action="<?php echo BASE; ?>/biddings" method="post" id="frm-search">
    <div class="search-pannel">
        <div class="container">
            <div class="col-md-8 col-md-offset-1 col-centered">
              	<input type="hidden" id="baseurl" value="<?php echo BASE; ?>">
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

                

            </div>
        </div>
    </div>
	</form>
    <!-- /Search  panel -->




    <div class="container">
        <div class="row">
            <div class="viewetails">

<div class="col-md-12">
<h1 class="pagetitle"><?php echo $product->title; ?></h1>
</div>


<!--left panel-->
<div class="col-md-8">
<!-- Slider start-->
 <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:550px;padding-left:0px; padding-right:83px;margin:0px auto 0px;">
      <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                <ul class="amazingslider-slides" style="display:none;">
                    <?php foreach ($product_imgs as $img){
                        if($img != '') {
                        ?>
                        <li><img src="<?php echo BASE; ?>uploads/products/<?php echo $product->product_id; ?>/<?php echo $img->product_img; ?>"/></li>
                    
                <?php
              }else{?>
                 
                        <li><img src="<?php echo BASE; ?>assets/images/view-slider.png" /></li>
                           
                      
                    <?php }
                } ?>
                </ul>
                
                <ul class="amazingslider-thumbnails" style="display:block;">
                  <?php foreach ($product_imgs as $img){
                  if($img != '') {
                      ?>
                        <li><img src="<?php echo BASE; ?>uploads/products/<?php echo $product->product_id; ?>/thumb/<?php echo $img->product_img; ?>"/></li>
                      <?php
                      }else{?>
                        <li><img src="<?php echo BASE; ?>assets/images/view-slider.png"/></li>
                                   
                          
                  <?php }
                  } ?>
              </ul>
              </div>
        </div>
    </div>
</div>
    <!--Slider end-->
    
<!--left panel-->


<!--right panel-->
<div class="col-md-4">
<div class="row">

    <style>
        .bid-view ul#example{
            margin: 0;
        }
        .bid-view ul#example li span{
            font-size: 25px;
        }
        .bid-view ul#example li p{
            font-size: 12px;
        }
    </style>

<!--Bid details panel-->
<div class="border-bg pad-b-view">
<div class="col-md-6 border-rw">
<div class="row">
<h3 class="bid-de-title">Bid Closes</h3>
<!--    00:15:12-->
    <?php if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) > date('Y-m-d H:i:s',strtotime('now')) ){ ?>
<div class="bid-view time">	
    <ul class="no-margin" id="example">
        <li><span class="days">00</span><p class="days_text">D</p></li>
        <li class="seperator">:</li>
        <li><span class="hours">00</span><p class="hours_text">H</p></li>
        <li class="seperator">:</li>
        <li><span class="minutes">00</span><p class="minutes_text">M</p></li>
        <li class="seperator">:</li>
        <li><span class="seconds">00</span><p class="seconds_text">S</p></li>
    </ul>
    <?php }else{ ?>
<div class="bid-view">	
    <?php  if($product->bid_winner == 0){ ?>
            <h4 class="label label-danger" style="padding: 10px 15px; font-size: 15px;">Bid Ends</h4>
        <?php }else{ ?>
            <h4 class="label bg-slate" style="padding: 10px 15px; font-size: 15px;">Bid Closed</h4>
        <?php }
    } ?>


</div>
</div>
</div>

<div class="col-md-6 last-up">
<div class="row">
<h3 class="bid-de-title">Last Updated</h3>
<div class="bid-view"><?php echo date('M d',strtotime($current_bid['updated_datetime'])); ?>, <span><?php echo date('h:i A',strtotime($current_bid['updated_datetime'])); ?></span></div>
</div>
</div>
</div>
<!--Bid details panel-->

<!--Current Bid panel-->
<div class="current-bit-pannel">
<div class="row">
<div class="col-md-7 text-center">
<h4 class="mart-25">Current Bid</h4>
<span class="mart-15"><?php echo $current_bid['current_price']; ?> <b>DH</b></span>
</div>

<div class="col-md-5">
<div class="view-watch">
<img src="<?php echo BASE; ?>assets/images/watch-icon.png">
<a href="javascript:void(0);" onclick = "watchlistupdate(<?php echo $product->product_id; ?>)">WATCH</a>
</div>
</div>

</div>
</div>
<!-- Current Bid panel-->


    <!--Place Bid panel-->
    <div class="placebid mart-35">
        <input type="text" name="bid_amt" id="bid_amt" onkeypress="return isNumberKey(event);"/>
        <a href="" class="site-btn" onclick="return bidingpriceinsert();">Place  Bid</a>
    </div>
    <!--Place Bid panel-->

</div>
</div>
<!--right panel-->


                <div class="row">
                    <div class="col-md-12 view-bid-det-list mart-35">
                        <!--left list details panel-->
                        <div class="col-md-8">
                            <h2 class="title">Vehicle Details</h2>
                            <ul>
                                <li>
                                    <div class="col-md-5 head">Brand</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->brand; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Model</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->model; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Year</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->year; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Kms Driven</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->km_driven; ?> km</p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Fuel</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->fuel; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Seating capacity</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->seating_capacity; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Transmission Type</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->transmission_type; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Registration / Plate Number</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->registration_number; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Registration Expiry Date</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->registration_expiry; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Chasis Number</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->chasis_number; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Engine Number</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->engine_number; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-5 head">Description</div>
                                    <div class="col-md-7 text-left"><p><?php echo $product->description; ?></p></div>
                                </li>

                            </ul>
                        </div>
                        <!--left list details panel-->


                        <!--right list details panel-->
                        <div class="col-md-4 insurance_det">
                            <h2 class="title">Insurance Details</h2>
                            <ul>
                                <li>
                                    <div class="col-md-6 head">Loss Type</div>
                                    <div class="col-md-6"><p><?php echo $product->loss_type; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-6 head">Location of Salvage</div>
                                    <div class="col-md-6"><p><?php echo $product->salvage_location; ?></p></div>
                                </li>


                                <li>
                                    <div class="col-md-6 head">Insurance Company Name </div>
                                    <div class="col-md-6"><p><?php echo $product->insurance_company; ?></p></div>
                                </li>
                                <div class="clearfix"></div>

                                <li>
                                    <div class="col-md-6 head">Policy Number </div>
                                    <div class="col-md-6"><p><?php echo $product->policy_number; ?> </p></div>
                                </li>

                                <li>
                                    <div class="col-md-6 head">Claim number</div>
                                    <div class="col-md-6"><p><?php echo $product->claim_number; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-6 head">Vehicle Owner Name</div>
                                    <div class="col-md-6"><p><?php echo $product->owner_name; ?></p></div>
                                </li>

                                <li>
                                    <div class="col-md-6 head">date</div>
                                    <div class="col-md-6"><p><?php echo $product->owner_change_date; ?></p></div>
                                </li>
                            </ul>
                        </div>
                        <!--right list details panel-->

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /Main panel -->

<?php
$this->load->view('footer');
?>
<script src="<?php echo BASE; ?>assets/sliderengine/jquery.js" type="text/javascript"></script>
<script src="<?php echo BASE; ?>assets/sliderengine/amazingslider.js" type="text/javascript"></script>
<script src="<?php echo BASE; ?>assets/sliderengine/initslider-1.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery.countdown.js"></script>

<?php if(date('Y-m-d H:i:s',strtotime($product->end_datetime)) > date('Y-m-d H:i:s',strtotime('now')) ){ ?>
    <script type="text/javascript">
        $('#example').countdown({
            date: '<?php echo date('Y-m-d H:i:s',strtotime($product->end_datetime)); ?>',
            offset: +5.5,
            day: 'D',
            days: 'D',
            hour: 'H',
            hours: 'H',
            minute: 'M',
            minutes: 'M',
            seconds: 'S',
            second: 'S',
        }, function () {
            alert('Done!');
            location.reload();
        });
    </script>
<?php } ?>



<script>
   
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
    function bidingpriceinsert()
    {
//        alert('sdgjkh');
        var bidamt = $('#bid_amt').val();
//        alert(bidamt);
        var userid = '<?php echo $_SESSION['user_id']; ?>';
        var productid = '<?php echo $product->product_id; ?>';

        var error = false;
        $('.placebid').find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(bidamt) == ''){
            error = true;
            $('#bid_amt').parent().addClass('has-error');
            $('#bid_amt').parent().after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo BASE; ?>biddings/bid_insert",
            type: 'POST',
            dataType: 'json',
            data: {uid:userid,pid:productid,amt:bidamt},
            beforeSend: function(){
                //swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
            },
            success: function(data){
                console.log(data);
                if(data.error){
                    //swal.close();
                    swal("Error", "Try higher bid amount", "error");
                    //$('#bid_amt').parent().addClass('has-error');
                    //$('#bid_amt').parent().after('<div class="c_error text-warning-800">'+data.error+'</div>');
                    return false;
                }else{
                    swal("Success", "Bidding Price Added succesfully", "success");
                    location.reload();
                }
            },
            error: function(){

            }
        });

        return false;
    }
	function watchlistupdate(proid)
	{
	    var userid = '<?php echo $_SESSION['user_id']; ?>';
        var productid = proid;
		    $.ajax({
            url: "<?php echo BASE; ?>biddings/watchlist_insert",
            type: 'POST',
            dataType: 'json',
            data: {uid:userid,pid:productid},
            success: function(data){
			  if(data == 1)
               swal("Success", "WatchList Added succesfully", "success");

               swal("error", "Already Added The WatchList", "error");
            },
           
        });
		
		
	}
</script>
<script>
$("#autosearch").on("keyup",function(){
	if($(this).val() != ''){
		$.ajax({
			url: $("#baseurl").val()+"biddings/autosearch",
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
</script>
