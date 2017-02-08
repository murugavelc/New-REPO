<?php $this->load->view('admin/header');
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
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Products</span> - Edit Product - <?php echo $product->title; ?></h4>
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
                <li class="active">Edit - <?php echo $product->title; ?></li>
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
<!--                        <ul class="nav nav-tabs nav-tabs-highlight">-->
<!--                            <li class="active"><a href="#basic-tab1" data-toggle="tab">English</a></li>-->
<!--                            <li><a href="#basic-tab2" data-toggle="tab">Arabic</a></li>-->
<!--                        </ul>-->

                        <div class="tab-content">
                            <div class="tab-pane active" id="basic-tab1">
                                <div class="row">


                                    <div class="col-sm-6">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Owner details</legend>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Owner's Name:</label>
                                                        <input type="text" placeholder="Owner's Name" name="owner_name" class="form-control" value="<?php echo $product->owner_name; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                                        <label>Owner Change Date:</label>
                                                        <input type="text" name="owner_change_date" class="daterange-single form-control" value="<?php echo date('m/d/Y',strtotime($product->owner_change_date)); ?>">
                                                        <div class="form-control-feedback">
                                                            <i class="icon-calendar2"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Insurance details</legend>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="display-block">In Stock Yard:</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="in_stock_yard" value="1" class="styled" <?php echo ($product->in_stock_yard == 1?'checked="checked"':''); ?>>
                                                            Yes
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" name="in_stock_yard" value="0" class="styled" <?php echo ($product->in_stock_yard == 0?'checked="checked"':''); ?>>
                                                            No
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Location of Salvage:</label>
                                                        <input type="text" class="form-control" name="salvage_location" placeholder="Salvage Location" value="<?php echo $product->salvage_location; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </div>







                                </div>
                            </div>

                            <div class="tab-pane" id="basic-tab2">
                                <fieldset class="content-group">
                                    <legend class="text-bold">Product details</legend>


                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea rows="5" cols="5" name="description_arabic" class="form-control" dir="rtl" placeholder="Please Enter Information"><?php echo $product->description_arabic; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!-- TAB ENDS -->

                    <div class="text-right">
                        <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
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

    $(document).on('click','.remove_input',function(e){
        e.preventDefault();
        var thisd = $(this).parent().parent();
        thisd.remove();
    });

    $(document).on('click','.remove_img',function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        var thisd = $(this).parent().parent();

        $.ajax({
            url: "<?php echo ADMIN_URL; ?>products/remove_img",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            beforeSend: function(){
                swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
            },
            success: function(data){
                swal.close();
                console.log(data);
                thisd.remove();
            },
            error: function(){

            }
        });
    });

    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        
        $.ajax({
            url: "<?php echo ADMIN_URL; ?>products/closed_update",
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
                        text: "Product has been updated successfully!",
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
        var html = '<div class="row imageSingleBox"><div class="col-sm-2 text-center"><img id="blah" width="50px" height="50px" class="" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt=""></div><div class="col-sm-9"><input type="file" accept="image/*" name="profile_img[]" class="file-styled"></div><div class="col-sm-1"><a class="remove_input" href=""><i class="icon-cross2"></i></a></div></div>';
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
//                $('#blah').attr('src', e.target.result);
                imgbox.attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>