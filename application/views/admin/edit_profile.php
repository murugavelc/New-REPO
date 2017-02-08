<?php
//print_r($user);
$this->load->view('admin/header');
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
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"><?php echo $title; ?></span> - <?php echo ucfirst($user->first_name.' '.$user->last_name); ?></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a class="btn btn-success" href="<?php echo ADMIN_URL; ?>"><i class="icon-circle-left2"></i> Back to Dashboard</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo ADMIN_URL.$redirect; ?>"> <?php echo $title; ?></a></li>
                <li class="active">Edit - <?php echo ucfirst($user->first_name.' '.$user->last_name); ?></li>
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
                                            <label>First name:</label>
                                            <input type="text" placeholder="First Name" name="first_name" value="<?php echo $user->first_name; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Middle name:</label>
                                            <input type="text" placeholder="Middle Name" name="middle_name" class="form-control" value="<?php echo $user->middle_name; ?>" >
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name:</label>
                                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $user->last_name; ?>" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="text" placeholder="Email Address" name="email" value="<?php echo $user->email; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="display: none;">
                                        <div class="form-group">
                                            <label>Role:</label>
                                            <select class="select" name="role">
                                                <?php foreach ($roles as $rkey => $role){
                                                    if($user->user_type == $rkey){
                                                        echo '<option selected="selected" value="' . $rkey . '">' . $role . '</option>';
                                                    }else {
                                                        echo '<option value="' . $rkey . '">' . $role . '</option>';
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee Number</label>
                                            <input type="text" placeholder="Employee Number" name="employee_number" value="<?php echo $user->employee_number; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label>Nationality </label>
                                            <div class="styled-select">
                                                <select name="nationality" class="form-control">
                                                    <?php
                                                    GLOBAL $NATIONALITY;
                                                    foreach ($NATIONALITY as $nat){
                                                        if($user->nationality == $nat){
                                                            echo '<option selected="selected" value="' . $nat . '">' . $nat . '</option>';
                                                        }else {
                                                            echo '<option value="' . $nat . '">' . $nat . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>Phone #:</label>-->
<!--                                            <input type="text" placeholder="Phone Number" name="phone" value="--><?php //echo $user->phone; ?><!--" class="form-control">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>Address line:</label>-->
<!--                                            <input type="text" placeholder="Address Line" name="address" value="--><?php //echo $user->address_line; ?><!--" class="form-control">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>Country:</label>-->
<!--                                            <select data-placeholder="Select your country" name="country" class="select">-->
<!--                                                --><?php //foreach ($countries as $country){
//                                                    if($user->country == $country->sortname){
//                                                        echo '<option selected="selected" value="' . $country->sortname . '">' . $country->name . '</option>';
//                                                    }else {
//                                                        echo '<option value="' . $country->sortname . '">' . $country->name . '</option>';
//                                                    }
//                                                }?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>State/Province:</label>-->
<!--                                            <input type="text" placeholder="State/Province" name="state" value="--><?php //echo $user->state; ?><!--" class="form-control">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>City:</label>-->
<!--                                            <input type="text" placeholder="City" name="city" value="--><?php //echo $user->city; ?><!--" class="form-control">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>ZIP code:</label>-->
<!--                                            <input type="text" placeholder="ZIP Code" name="zip_code" value="--><?php //echo $user->zip_code; ?><!--" class="form-control">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset>

                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-9">
                                            <label>Profile Image:</label>
                                            <input type="file" accept="image/*" name="profile_img" class="file-styled">
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
                                                <img id="blah" width="90px" height="90px" class="img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
                                            <?php }else{ ?>
                                                <img id="blah" width="90px" height="90px" class="img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>More Information:</label>
                                    <textarea rows="5" cols="5" name="more_info" class="form-control" placeholder="Please Enter Information"><?php echo $user->more_info; ?></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('admin/footer'); ?>
<script>
$(document).ready(function () {
    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        var first = $('input[name="first_name"]');
        var last = $('input[name="last_name"]');
        var email = $('input[name="email"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(first.val()) == ''){
            error = true;
            first.parent().addClass('has-error');
            first.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if($.trim(last.val()) == ''){
            error = true;
            last.parent().addClass('has-error');
            last.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if($.trim(email.val()) == ''){
            error = true;
            email.parent().addClass('has-error');
            email.after('<div class="c_error text-warning-800">This field is required</div>');
        }else{

        }
        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo ADMIN_URL; ?>users/update",
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
                    if(data.error.email){
                        email.parent().addClass('has-error');
                        email.after('<div class="c_error text-warning-800">'+data.error.email+'</div>');
                    }
                }else{
                    swal({
                        title: "Success!",
                        text: "User has been updated successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        window.location.href = '<?php echo ADMIN_URL.$redirect; ?>';
                    });
                }
            },
            error: function(){

            }
        });
    });

    $(document).on('change','.file-styled',function(e){
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>