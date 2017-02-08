<?php $this->load->view('salvage/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/picker_date.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_checkboxes_radios.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Products</span> - Add Product</h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a class="btn btn-success" href="<?php echo SALVAGE_URL; ?>products"><i class="icon-circle-left2"></i> Back to Products</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo SALVAGE_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo SALVAGE_URL; ?>products"> Products</a></li>
                <li class="active">Add</li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <!-- 2 columns form -->
        <form id="AddUser" action="#">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <!-- TAB STARTS -->
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="active"><a href="#basic-tab1" data-toggle="tab">English</a></li>
                            <li><a href="#basic-tab2" data-toggle="tab">Arabic</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="basic-tab1">
                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="display-block1">Motor / Non-Motor:</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="motor_non" value="1" class="styled" checked="checked">
                                                Motor
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="motor_non" value="0" class="styled">
                                                Non-Motor
                                            </label>
                                        </div>

                                        <fieldset class="content-group">
                                            <legend class="text-bold">Vehicle details</legend>


                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vehicle Type:</label>
                                                        <input type="text" name="vehicle_type" class="form-control" placeholder="Vehicle Type">
<!--                                                        <select name="vehicle_type" id="" class="form-control select2">-->
<!--                                                            <option value="">Select Vehicle Type</option>-->
<!--                                                            <option value="1">Truck</option>-->
<!--                                                            <option value="2">Car</option>-->
<!--                                                        </select>-->
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Brand:</label>
                                                        <input type="text" name="brand" class="form-control" placeholder="Brand">
<!--                                                        <select name="brand" id="" class="form-control select2">-->
<!--                                                            <option value="">Select Brand</option>-->
<!--                                                            <option value="1">BMW</option>-->
<!--                                                            <option value="2">Mercedez Benz</option>-->
<!--                                                            <option value="3">Toyota</option>-->
<!--                                                        </select>-->
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Model:</label>
                                                        <input type="text" class="form-control" name="model" placeholder="Model">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Year:</label>
                                                        <select name="year" class="form-control">
                                                            <option value="">Year</option>
                                                            <?php $startdate = 1960;
                                                            $enddate = date('Y');
                                                            $years = range($startdate,$enddate);
                                                            $years = array_reverse($years);
                                                            foreach($years as $year)
                                                            {
                                                                    echo '<option value=' . $year . '>' . $year . '</option>';
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>KM Driven:</label>
                                                        <input type="text" placeholder="Ex: 1,000 KM" name="km_driven" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Fuel:</label>
                                                        <select name="fuel" id="" class="form-control select2">
                                                            <option value="">Select Fuel</option>
                                                            <option value="1">Petrol</option>
                                                            <option value="2">Diesel</option>
                                                            <option value="3">Gasoline</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Seating Capacity:</label>
                                                        <input type="text" placeholder="Seat Capacity" name="seat_capacity" class="form-control">
                                                    </div>
                                                </div>

                                                <!--                                    <div class="col-md-3">-->
                                                <!--                                        <div class="form-group">-->
                                                <!--                                            <label>Price:</label>-->
                                                <!--                                            <input type="text" placeholder="Price" name="price" class="form-control">-->
                                                <!--                                        </div>-->
                                                <!--                                    </div>-->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Transmission Type:</label>
                                                        <select name="transmission" id="" class="form-control select2">
                                                            <option value="">Select Transmission</option>
                                                            <option value="1">Automatic</option>
                                                            <option value="2">Manual</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Registration Number:</label>
                                                        <input type="text" class="form-control" name="registration_number" placeholder="Registration Number">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group has-feedback">
                                                        <label>Registration Date:</label>
                                                        <input type="text" name="registration_date" class="daterange-single form-control">
                                                        <div class="form-control-feedback">
                                                            <i class="icon-calendar2"></i>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Chase Number:</label>
                                                        <input type="text" class="form-control" name="chasis_number" placeholder="Chase Number">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Engine Number:</label>
                                                        <input type="text" class="form-control" name="engine_number" placeholder="Engine Number">
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset class="content-group">
                                            <legend class="text-bold">Insurance details</legend>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Loss Type:</label>
                                                        <input type="text" class="form-control" name="loss_type" placeholder="Loss Type">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="display-block">In Stock Yard:</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="in_stock_yard" value="1" class="styled" checked="checked">
                                                            Yes
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" name="in_stock_yard" value="0" class="styled">
                                                            No
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Location of Salvage:</label>
                                                        <input type="text" class="form-control" name="salvage_location" placeholder="Loss Type">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Insurance Company Name:</label>
                                                        <input type="text" class="form-control" name="company_name" placeholder="Company Name">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Policy Number:</label>
                                                        <input type="text" placeholder="Policy Number" name="policy_number" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Claim number:</label>
                                                        <input type="text" class="form-control" name="claim_number" placeholder="Claim Number">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea rows="5" cols="5" name="description" class="form-control" placeholder="Please Enter Information"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <fieldset class="content-group">
                                                    <legend class="text-bold">Owner details</legend>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Owner's Name:</label>
                                                                <input type="text" placeholder="Owner's Name" name="owner_name" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label>Owner Change Date:</label>
                                                                <input type="text" name="owner_change_date" class="daterange-single form-control">
                                                                <div class="form-control-feedback">
                                                                    <i class="icon-calendar2"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--                                            <div class="col-md-12">-->
                                                        <!--                                                <div class="form-group">-->
                                                        <!--                                                    <label>Owner's Address:</label>-->
                                                        <!--                                                    <textarea rows="5" cols="5" name="description" class="form-control" placeholder="Please Enter Information"></textarea>-->
                                                        <!--                                                </div>-->
                                                        <!--                                            </div>-->

                                                    </div>

                                                </fieldset>
                                            </div>
                                            <div class="col-sm-6">
                                                <fieldset class="content-group">
                                                    <legend class="text-bold">Bidding details</legend>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Title:</label>
                                                                <input type="text" placeholder="Title" name="title" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Base Price:</label>
                                                                <input type="text" placeholder="Base Price" name="base_price" class="form-control numeric">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label>Start & End Datetime:</label>
                                                                <input type="text" name="startend_datetime" class="daterange-time form-control">
                                                                <div class="form-control-feedback">
                                                                    <i class="icon-calendar2"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--                                            <div class="col-md-6">-->
                                                        <!--                                                <div class="form-group has-feedback">-->
                                                        <!--                                                    <label>End Date:</label>-->
                                                        <!--                                                    <input type="text" name="end_date" class="form-control">-->
                                                        <!--                                                    <div class="form-control-feedback">-->
                                                        <!--                                                        <i class="icon-calendar2"></i>-->
                                                        <!--                                                    </div>-->
                                                        <!--                                                </div>-->
                                                        <!--                                            </div>-->
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <div class="col-sm-12">
                                                                        <label><b>Product Image:</b></label>
                                                                        <div class="pull-right">
                                                                            <a href="" class="btn btn-success add_more_image">Add Image</a>
                                                                        </div>

                                                                        <div id="imgerror"></div>
                                                                    </div>
                                                                </div><br>

                                                                <div id="MultipleImageBlock">
                                                                    <div class="row imageSingleBox">
                                                                        <div class="col-sm-2 text-center">
                                                                            <img id="blah" width="50px" height="50px" class="" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                            <input type="file" accept="image/*" name="profile_img[]" class="file-styled">
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <!--                                                <a href=""><i class="icon-cross2"></i></a>-->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>



                                                </fieldset>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="basic-tab2">
                                <fieldset class="content-group">
                                    <legend class="text-bold">Bidding details</legend>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title:</label>
                                                <input type="text" placeholder="Title" name="title_arabic" dir="rtl" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="content-group">
                                    <legend class="text-bold">Product details</legend>


                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea rows="5" cols="5" name="description_arabic" class="form-control" dir="rtl" placeholder="Please Enter Information"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!-- TAB ENDS -->


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('salvage/footer'); ?>
<script>
$(document).ready(function () {

    $('.select2').select2();

    $(document).on('click','.remove_img',function (e) {
        e.preventDefault();

        var thisd = $(this).parent().parent();


                thisd.remove();

    });

    $('.numeric').keypress(function(e) {
        var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
        if (verified) {e.preventDefault();}
    });

    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        var title = $('input[name="title"]');
        var base_price = $('input[name="base_price"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        $('#imgerror').html('');
        if($.trim(title.val()) == ''){
            error = true;
            title.parent().addClass('has-error');
            title.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if($.trim(base_price.val()) == ''){
            error = true;
            base_price.parent().addClass('has-error');
            base_price.after('<div class="c_error text-warning-800">This field is required</div>');
        }

        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo ADMIN_URL; ?>products/insert",
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
                    if(data.error.img){
                        $('#imgerror').html('<div class="c_error text-warning-800">'+data.error.img+'</div>');
                    }
                    if(data.error.title){
                        title.parent().addClass('has-error');
                        title.after('<div class="c_error text-warning-800">'+data.error.title+'</div>');
                    }
                }else{
                    swal({
                        title: "Success!",
                        text: "Product has been added successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        window.location.href = '<?php echo SALVAGE_URL; ?>products';
                    });
                }
            },
            error: function(){

            }
        });
    });

    $(document).on('click','.add_more_image',function (e) {
        e.preventDefault();
        var html = '<div class="row imageSingleBox"><div class="col-sm-2 text-center"><img id="blah" width="50px" height="50px" class="" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt=""></div><div class="col-sm-9"><input type="file" accept="image/*" name="profile_img[]" class="file-styled"></div><div class="col-sm-1"><a class="remove_img" href=""><i class="icon-cross2"></i></a></div></div>';
        $('#MultipleImageBlock').append(html);
        $(".file-styled").uniform({
            fileButtonHtml: '<i class="icon-googleplus5"></i>',
            wrapperClass: 'bg-warning'
        });
    });

    $(document).on('change','.file-styled',function(e){
        var imgbox = $(this).parent().parent().parent().find('#blah');
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgbox.attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>