<?php $this->load->view('arabic/header'); ?>

<!-- /Main panel -->
<div class="myaccount">
  <div class="container">
    <div class="row">
<h2 class="title mart-50">حسابي</h2>

<div class="row">
<div class="col-md-12">

<div class="col-md-3"> <div class="row"> <!-- required for floating -->
<!-- Nav tabs -->
<ul class="nav nav-tabs tabs-left">
<li><a href="<?php echo BASE; ?>myaccount">معلومات الحساب</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mybiddings">بلدي المناقصات</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mywatchlist">قائمة الرغبات الخاصة بي</a></li>
<li class="active"><a href="<?php echo BASE; ?>myaccount/forgetpassword">تغيير كلمة السر</a></li>
</ul>
</div></div>




<div class="col-md-9">
<div class="row">
<!-- Tab panes -->
<div class="tab-content">



<!--- changepassword-->
<form  id="forgetPassword" >
<div class="tab-pane active" id="changepassword">
<h2 class="title">تغيير كلمة السر</h2>
<div class="RegisterAlert">
                    <?php if($this->session->flashdata('forgot_update_success') != ''){
                        echo $this->session->flashdata('forgot_update_success');
                    }?>
                    <?php if($this->session->flashdata('forgot_update_error') != ''){
                        echo $this->session->flashdata('forgot_update_error');
                    }?>
                    </div>
                              <div class="col-md-6 col-md-offset-3">
                               <div class="form-group">
                                <label>كلمة المرور القديمة</label>
                                    <input name="old_password" id="old_password" class="form-control" tabindex="1"  type="text">
                                </div>
                            </div>
							
                            <div class="col-md-6 col-md-offset-3">
                               <div class="form-group">
                                <label>كلمة المرور الجديدة</label>
                                    <input name="new_password" id="new_password" class="form-control" tabindex="1" type="text">
                                </div>
                            </div>

                            <div class="col-md-6 col-md-offset-3">
                               <div class="form-group">
                                <label>تأكيد كلمة المرور الجديدة</label>
                                    <input name="confirm_password" id="confirm_password" class="form-control" tabindex="1" type="text">
                                <div class="c_error" id="confirm_error">وغير مطابقة تأكيد كلمة المرور</div>
                                </div>
                            </div>


                              <div class="col-md-6 col-md-offset-3 text-center mart-50">
                               <a href="" id="forgetPasswords" class="site-btn">تغيير كلمة السر</a>
                            </div>



</div>
</form>
<!--- changepassword-->
</div>
</div>
</div>
</div></div>



   </div>
  </div>
</div>
<!-- /Main panel -->


<?php $this->load->view('arabic/footer'); ?>
<script type="text/javascript">

$(document).ready(function(){
      $('#confirm_error').hide();
  var new_password = $('#forgetPassword input[name="new_password"]');
  var confirm_password = $('#forgetPassword input[name="confirm_password"]');
  $('#confirm_password').focusout(function(){
    if(new_password.val()==confirm_password.val()){
        $('#confirm_error').hide();
      
       return true;
    }else{
        $('#confirm_error').show();
        return false;
        }
    
  });
});



</script>
<script>
 var base_url = '<?php echo BASE; ?>';
$(document).ready(function(){
    
$('#forgetPasswords').click(function(e){
           
            e.preventDefault();
            //var formData = new FormData($('#forgetPassword')[0]);
            $(this).find('*').removeClass('has-error');
            $('.c_error').remove();
            $('#RegisterAlert').html('');
            var error = false;
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var confirm_password=$('#confirm_password').val();
            
            if(old_password == ''){
                $('#old_password').parent().addClass('has-error');
                $('#old_password').after('<div class="c_error">Old password is required</div>');
                error = true;
            }
            if(new_password == ''){
                $('#new_password').parent().addClass('has-error');
                $('#new_password').after('<div class="c_error">New password is required</div>');
                error = true;
            }
            if(confirm_password == ''){
                $('#confirm_password').parent().addClass('has-error');
                $('#confirm_password').after('<div class="c_error">Confirm password is required</div>');
                error = true;
            }
             if(error){
                return false;
            }
        $.ajax({
                url: base_url+'Myaccount/forget_password_update',
                type: 'POST',
                 data:$('#forgetPassword').serialize(),
                //data:formData,
               // processData: false,
                //contentType: false,
                success: function(data){
                 
                    },
                   error:function(){
                    
                  
                    
                   }
                
     
             });

});

});
</script>

<!--<script src="--><?php //BASE; ?><!--assets/js/custom.js"></script>-->
