<?php $this->load->view('header'); ?>

    <!-- /Main panel -->
    <div class="login-pannel">
        <div class="container">
            <div class="row">

          

                <!-- /right panel -->
                <div class="col-md-12 col-xs-12 register">

                    <h4 class="text-center text-green">Forgot Password</h4>
                    <p class="text-center text-dgray">Please use the below Number to conact us or Do register in the below form</p>
                    <h3 class="text-center text-blue mart-35"><i class="fa fa-fw fa-phone"></i> +966 12 6516610</h3>

                   

                    <div class="RegisterAlert">
                    <?php if($this->session->flashdata('forgot_success') != ''){
                        echo $this->session->flashdata('forgot_success');
                    }?>
                    <?php if($this->session->flashdata('forgot_fail') != ''){
                        echo $this->session->flashdata('forgot_fail');
                    }?>
                    </div>

                    <form id="fotgetpass" action="<?php echo base_url();?>index.php/login/forgotpass" method="post">


                    <div class="row">
                            <div class="col-md-6  col-md-offset-3 col-centered ">
                                <div class="form-group mart-25">
                                    <input name="email" id="email" class="form-control" tabindex="1" type="text" placeholder="Email id">
                                </div>
                            </div>
                            </div>

                         <div class="row">
                        
                            <div class="col-xs-12 col-md-12 text-center">
                                <button type="submit" class="site-btn mart-25">Submit</button>
                            </div>
                        </div>



                        

                    </form>

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
            
            
            
            $('#fotgetpass').submit(function(){
            $(this).find('*').removeClass('has-error');
            $('.c_error').remove();
            $('#RegisterAlert').html('');
            var error = false;
            
            var email = $('#fotgetpass input[name="email"]');
            
            if(email.val() == ''){
            email.parent().addClass('has-error');
            email.after('<div class="c_error">Email is required</div>');
            error = true;
            }else if(!isValidEmailAddress(email.val())){
            email.parent().addClass('has-error');
            email.after('<div class="c_error">Email is not valid</div>');
            error = true;
            }
            
            if(error){
            return false;
            }
            });
            
            </script>
            

<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
