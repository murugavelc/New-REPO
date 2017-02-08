<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salvage::Admin - Reset Password</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
    <!-- /theme JS files -->

</head>

<body>

<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                <div id="LoginAlert"></div>
                <!-- Simple login form -->
                <form id="activate_account" action="">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Reset Password <small class="display-block">Enter your credentials below</small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Repeat Password" name="rpassword">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password <i class="icon-circle-right2 position-right"></i></button>
                        </div>


                    </div>
                </form>
                <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; <?php echo date('Y'); ?>. <a href="">company</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>

<script>
    var base_url = '<?php echo ADMIN_URL; ?>';
    $(document).ready(function(){

        $('#activate_account').submit(function(e){
            e.preventDefault();
            $(this).find('*').removeClass('has-error');
            $('.c_error').remove();
            $('#LoginAlert').html('');
            var form = $(this).serializeArray();
            var error = false;
            var password = $('input[name="password"]');
            var rpassword = $('input[name="rpassword"]');
            if(password.val() == ''){
                password.parent().addClass('has-error');
                password.after('<div class="c_error">Password is required</div>');
                error = true;
            }
            if(rpassword.val() == ''){
                rpassword.parent().addClass('has-error');
                rpassword.after('<div class="c_error">Repeat password is required</div>');
                error = true;
            }else if(password.val() != rpassword.val()){
                rpassword.parent().addClass('has-error');
                rpassword.after('<div class="c_error">Passwords are not matching</div>');
                error = true;
            }
            if(error){
                return false;
            }
            $.ajax({
                url: base_url+'login/reset_action',
                type: 'POST',
                data: form,
                dataType: 'json',
                success: function(data){
                    //console.log(data);
                    if(data.success){

                        window.location.href = base_url+'login';
                    }else if(data.error){
                        $('#LoginAlert').html(data.error);
                    }
                },
            });
        });

    });
</script>
<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
