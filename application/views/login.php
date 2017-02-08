<?php $this->load->view('header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/bootstrap-datetimepicker.min.css">

    <!-- /Main panel -->
    <div class="login-pannel">
        <div class="container">
            <div class="row">

                <!-- /left panel -->
                <div class="col-md-4 col-xs-12">
                <div class="login-bg">
                    <h2 class="title">Sign In</h2>

                    <div id="LoginAlert">
                        <?php if($this->session->flashdata('login_msg') != ''){
                            echo $this->session->flashdata('login_msg');
                        }?>
                    </div>

                    <form id="LoginForm" role="form" action="" method="post" class="login-form">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="email" placeholder="Username..." class="form-username form-control" id="form-username" value="<?php if($this->session->userdata('email')!='') { echo $this->session->userdata('email'); }?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password" value="<?php if($this->session->userdata('password')!='') { echo $this->session->userdata('password'); }?>">
                        </div>


                        <div class="form-group frontend">
							<input type="checkbox" value="1" name="rememer" id="check1"><label for="check1" class="check-label">Remember me</label>
                            <a href="<?php echo BASE;?>login/forgetpassword" class="text-light-gray forgot-pass">Forgot your password?</a>
                        </div>
                        <div class="mart-25 text-center"><button type="submit" class="site-btn">Sign In</button></div>
                    </form>


                    </div>
                </div>
                <!-- /left panel -->


                <!-- /right panel -->
                <div class="col-md-8 col-xs-12 register">

                    <h4 class="text-center text-green">Customer Service number</h4>
                    <p class="text-center text-dgray">Please use the below Number to contact us or Do register in the below form</p>
                    <h3 class="text-center text-blue mart-35"><i class="fa fa-fw fa-phone"></i> +966 12 6516610</h3>
                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                    <div class="mart-25 text-center">
                    <a href="<?php echo BASE;?>login/register" class="site-btn">Register here </a>
                    </div>
                    

                </div>
                <!-- /right panel -->



            </div>
        </div>
    </div>
    <!-- /Main panel -->


<?php $this->load->view('footer'); ?>

<script>
    var base_url = '<?php echo BASE; ?>';

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

    $(document).ready(function(){

        $('#RegisterForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#RegisterForm')[0]);
            $(this).find('*').removeClass('has-error');
            $('.c_error').remove();
            $('#RegisterAlert').html('');
            var error = false;
            var fname = $('#RegisterForm input[name="first_name"]');
            var lname = $('#RegisterForm input[name="last_name"]');
            var email = $('#RegisterForm input[name="email"]');
            var mobile = $('#RegisterForm input[name="mobile"]');
            var file = $('#RegisterForm #file_attach');
            if(fname.val() == ''){
                fname.parent().addClass('has-error');
                fname.after('<div class="c_error">First name is required</div>');
                error = true;
            }
            if(lname.val() == ''){
                lname.parent().addClass('has-error');
                lname.after('<div class="c_error">Last name is required</div>');
                error = true;
            }
            if(email.val() == ''){
                email.parent().addClass('has-error');
                email.after('<div class="c_error">Email is required</div>');
                error = true;
            }else if(!isValidEmailAddress(email.val())){
                email.parent().addClass('has-error');
                email.after('<div class="c_error">Email is not valid</div>');
                error = true;
            }
            if(mobile.val() == ''){
                mobile.parent().addClass('has-error');
                mobile.after('<div class="c_error">Mobile is required</div>');
                error = true;
            }
            if(file.val() == ''){
                file.parent().addClass('has-error');
                file.parent().after('<div class="c_error">File is required</div>');
                error = true;
            }
            if(error){
                return false;
            }
            $.ajax({
                url: base_url+'login/register',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data);
                    if(data.success){
                        location.reload();
                    }else if(data.error){
                        $('#RegisterAlert').html(data.error);
                    }
                },
            });
        });

        $('#LoginForm').submit(function(e){
            e.preventDefault();
            $(this).find('*').removeClass('has-error');
            $('.c_error').remove();
            $('#LoginAlert').html('');
            var form = $(this).serializeArray();
            var error = false;
            var email = $('#LoginForm input[name="email"]');
            var password = $('#LoginForm input[name="password"]');
            if(email.val() == ''){
                email.parent().addClass('has-error');
                email.after('<div class="c_error">Email is required</div>');
                error = true;
            }
            if(password.val() == ''){
                password.parent().addClass('has-error');
                password.after('<div class="c_error">Password is required</div>');
                error = true;
            }
            if(error){
                return false;
            }
            $.ajax({
                url: base_url+'login/check_login',
                type: 'POST',
                data: form,
                dataType: 'json',
                success: function(data){
                    //console.log(data);
                    if(data.success){
                        location.reload();
                    }else if(data.error){
                        $('#LoginAlert').html(data.error);
                    }
                },
            });
            return false;
        });

    });
</script>
<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
