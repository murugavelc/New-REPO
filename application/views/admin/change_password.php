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
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Change Password</span> - <?php echo ucfirst($user->first_name.' '.$user->last_name); ?></h4>
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
                <li><a href="<?php echo ADMIN_URL; ?>profile/change_password"> Change Password</a></li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <!-- 2 columns form -->
        <div class="row">
            <div class="col-sm-12">
                <form id="ChangePass" action="#">
                    <div class="panel panel-flat">
                        <div class="panel-body">
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
                                    <fieldset>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password:</label>
                                                    <input type="text" placeholder="Password" name="password" class="form-control">
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Repeat Password:</label>
                                                    <input type="text" placeholder="Repeat Password" name="rpassword" class="form-control" >
                                                </div>
                                            </div>


                                        </div>


                                    </fieldset>
<!--                                </div>-->
<!---->
<!---->
<!--                            </div>-->

                            <div class="text-right">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- /2 columns form -->
<?php $this->load->view('admin/footer'); ?>
<script>
$(document).ready(function () {
    $('#ChangePass').submit(function(e){
        e.preventDefault();
        var pass = $('input[name="password"]');
        var rpass = $('input[name="rpassword"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(pass.val()) == ''){
            error = true;
            pass.parent().addClass('has-error');
            pass.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if($.trim(rpass.val()) == ''){
            error = true;
            rpass.parent().addClass('has-error');
            rpass.after('<div class="c_error text-warning-800">This field is required</div>');
        }else if($.trim(pass.val()) != $.trim(rpass.val())){
            error = true;
            rpass.parent().addClass('has-error');
            rpass.after('<div class="c_error text-warning-800">Password is not matching</div>');
        }

        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo ADMIN_URL; ?>profile/password_update",
            type: 'POST',
            dataType: 'json',
            data: $('#ChangePass').serializeArray(),
            beforeSend: function(){
                swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
            },
            success: function(data){
                console.log(data);
                if(data.success){
                    swal({
                        title: "Success!",
                        text: "User Password has been updated successfully!",
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


});
</script>