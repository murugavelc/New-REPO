<?php $this->load->view('header'); ?>

    <!-- /Main panel -->
    <div class="login-pannel">
        <div class="container">
            <div class="row">

          

                <!-- /right panel -->
                <div class="col-md-12 col-xs-12 register">

                    <h4 class="text-center text-green">هل نسيت كلمة المرور</h4>
                    <p class="text-center text-dgray">يرجى استخدام الرقم أدناه في conact لنا أو هل التسجيل في النموذج أدناه</p>
                    <h3 class="text-center text-blue mart-35"><i class="fa fa-fw fa-phone"></i> +966 12 6516610</h3>

                   

                    <div class="RegisterAlert">
                    <?php if($this->session->flashdata('register_success') != ''){
                        echo $this->session->flashdata('register_success');
                    }?>
                    </div>

                    <form id="fotgetpass" action="">


                    <div class="row">
                            <div class="col-md-6  col-md-offset-3 col-centered ">
                                <div class="form-group mart-25">
                                    <input name="first_name" id="first_name" class="form-control" tabindex="1" type="text" placeholder="عنوان الايميل">
                                </div>
                            </div>
                            
                        </div>



                         <div class="row">
                        
                            <div class="col-xs-12 col-md-12 text-center">
                                <button type="submit" class="site-btn mart-25">عرض</button>
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
            var middle_name=$('#RegisterForm input[name="middle_name"]');
            var street_name=$('#RegisterForm input[name="street_name"]');
            var building_number=$('#RegisterForm input[name="building_number"]');
            var city=$('#RegisterForm input[name="city"]');
            var district_name=$('#RegisterForm input[name="district_name"]');
            var postal_code=$('#RegisterForm input[name="postal_code"]');
            var additional_no=$('#RegisterForm input[name="additional_no"]');
            var unit_no=$('#RegisterForm input[name="unit_no"]');
            var nationality=$('#RegisterForm select[name="nationality"]');
            var country=$('#RegisterForm select[name="country"]');
            var dobday=$('#RegisterForm select[name="dobday"]');
            var dobmonth=$('#RegisterForm select[name="dobmonth"]');
            var dobyear=$('#RegisterForm select[name="dobyear"]');
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
            if(middle_name.val()==''){
                middle_name.parent().addClass('has-error');
                middle_name.parent().after('<div class="c_error">Middle Name is required</div>');
                error = true;
            }
            if(street_name.val()==''){
                street_name.parent().addClass('has-error');
                street_name.parent().after('<div class="c_error">Street Name is required</div>');
                error = true;
            }
            if(building_number.val()==''){
                building_number.parent().addClass('has-error');
                building_number.parent().after('<div class="c_error">Building Number is required</div>');
                error = true;
            }
            if(city.val()==''){
                city.parent().addClass('has-error');
                city.parent().after('<div class="c_error">City Name is required</div>');
                error = true;
            }
            if(district_name.val()==''){
                district_name.parent().addClass('has-error');
                district_name.parent().after('<div class="c_error">District Name is required</div>');
                error = true;
            }
            if(postal_code.val()==''){
                postal_code.parent().addClass('has-error');
                postal_code.parent().after('<div class="c_error">Postal Code is required</div>');
                error = true;
            }
            if(additional_no.val()==''){
                additional_no.parent().addClass('has-error');
                additional_no.parent().after('<div class="c_error">Additional Number is required</div>');
                error = true;
            }
            if(unit_no.val()==''){
                unit_no.parent().addClass('has-error');
                unit_no.parent().after('<div class="c_error">Unit Number is required</div>');
                error = true;
            }
            
            if(nationality.val()==''){
                nationality.parent().addClass('has-error');
                nationality.parent().after('<div class="c_error">Nationality is required</div>');
                error = true;
            }
            if(country.val()==''){
                country.parent().addClass('has-error');
                country.parent().after('<div class="c_error">Country is required</div>');
                error = true;
            }
            if(dobday.val()==''){
                dobday.parent().addClass('has-error');
                dobday.parent().after('<div class="c_error">Day is required</div>');
                error = true;
            }
            if(dobmonth.val()==''){
                dobmonth.parent().addClass('has-error');
                dobmonth.parent().after('<div class="c_error">Month is required</div>');
                error = true;
            }if(dobyear.val()==''){
                dobyear.parent().addClass('has-error');
                dobyear.parent().after('<div class="c_error">Year is required</div>');
                error = true;
            }
            if(error){
                return false;
            }
                    $.ajax({
                    url: base_url+'login/register_action',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                    window.location.reload();
;                    if(data.success){
                    location.reload();
                    }else if(data.error){
                    $('#RegisterAlert').html(data.error);
                    }
                    },
                    });
                    });
                    });
      </script>
<script>
      
        
        $("#country ").change(function(){
        var country_code=$("#country").val();
       
        $.ajax({
               url:base_url+'login/get_state',
               type: 'POST',
               dataType:'json', 
               data:{country:country_code},
                success: function(data)
                {
                
                $('#state').html(data);
                         
                },
                error:function()                    
                {
                    
                    
                } 
  
  
});
});

$("#state").change(function()
       {
        var state=$("#state").val();
        $.ajax({
        url:base_url+'login/getcities',
        type: 'POST',
        dataType:'json', 
        data:{state:state},
        success: function(data)
        {
        
        $('#city').html(data);
        
        },
        error:function()                    
        {
        } 
        
        
        });
        
        });
        

</script>
<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
