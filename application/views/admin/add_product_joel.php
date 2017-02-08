<?php $this->load->view('admin/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

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
                    <a class="btn btn-success" href="<?php echo ADMIN_URL; ?>products"><i class="icon-circle-left2"></i> Back to Products</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo ADMIN_URL; ?>products"> Products</a></li>
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
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product Name:</label>
                                            <input type="text" placeholder="Product Name" name="title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Base Price:</label>
                                            <input type="text" placeholder="Base Price" name="base_price" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vehicle Type:</label>
                                            <select name="vehicle_type" id="" class="form-control select2">
                                                <option value="">Select Vehicle Type</option>
                                                <option value="1">Truck</option>
                                                <option value="2">Car</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand:</label>
                                            <select name="brand" id="" class="form-control select2">
                                                <option value="">Select Brand</option>
                                                <option value="1">BMW</option>
                                                <option value="2">Mercedez Benz</option>
                                                <option value="3">Toyota</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Model:</label>
                                            <input type="text" class="form-control" name="model" placeholder="Model">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Year:</label>
                                            <input type="text" placeholder="Year" name="year" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fuel:</label>
                                            <select name="fuel" id="" class="form-control select2">
                                                <option value="">Select Brand</option>
                                                <option value="1">BMW</option>
                                                <option value="2">Mercedez Benz</option>
                                                <option value="3">Toyota</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transmission:</label>
                                            <input type="text" placeholder="Year" name="year" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Condition:</label>
                                            <input type="text" class="form-control" name="model" placeholder="Model">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>In Stock Yard:</label>
                                            <input type="text" placeholder="Year" name="year" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Insurance Company Name:</label>
                                            <input type="text" class="form-control" name="model" placeholder="Model">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Policy Number:</label>
                                            <input type="text" placeholder="Year" name="year" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Claim number:</label>
                                            <input type="text" class="form-control" name="model" placeholder="Model">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vechicle Extras:</label>
                                            <input type="text" placeholder="Year" name="year" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>More Information:</label>
                                    <textarea rows="5" cols="5" name="description" class="form-control" placeholder="Please Enter Information"></textarea>
                                </div>

                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset>

                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label>Product Image:</label>
                                            <div class="pull-right">
                                                <a href="" class="btn btn-success add_more_image">Add Image</a>
                                            </div>
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


                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('admin/footer'); ?>
<script>
$(document).ready(function () {

    $('.select2').select2();

    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        var title = $('input[name="title"]');
        var base_price = $('input[name="base_price"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
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
                        $('input[name="profile_img"]').parent().addClass('has-error');
                        $('input[name="profile_img"]').after('<div class="c_error text-warning-800">'+data.error.img+'</div>');
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
                        window.location.href = '<?php echo ADMIN_URL; ?>products';
                    });
                }
            },
            error: function(){

            }
        });
    });

    $(document).on('click','.add_more_image',function (e) {
        e.preventDefault();
        var html = '<div class="row imageSingleBox"><div class="col-sm-2 text-center"><img id="blah" width="50px" height="50px" class="" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt=""></div><div class="col-sm-9"><input type="file" accept="image/*" name="profile_img[]" class="file-styled"></div><div class="col-sm-1"><a href=""><i class="icon-cross2"></i></a></div></div>';
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