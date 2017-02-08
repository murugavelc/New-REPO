<?php $this->load->view('header'); ?>
<script>
 function selectOptionByValue( elem, value ){  
    
    var opt, i = 0;
    while( opt = elem.options[i++] ){
        if ( opt.value == value ){
        opt.selected = true;
        return;
        }
    }
}
</script>
<!-- /Main panel -->
<div class="myaccount">
  <div class="container">
    <div class="row">
<h2 class="title mart-50">My Account</h2>
   
<div class="row">
<div class="col-md-12">

<div class="col-md-3"> <div class="row"> <!-- required for floating -->
<!-- Nav tabs -->
<ul class="nav nav-tabs tabs-left">
<li class="active"><a href="<?php echo BASE; ?>myaccount">Account Info</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mybiddings">My Biddings</a></li>
<li><a href="<?php echo BASE; ?>myaccount/mywatchlist">My Watchlist</a></li>
<li><a href="<?php echo BASE; ?>myaccount/forgetpassword">Change Password</a></li>
</ul>
</div></div>




<div class="col-md-9">
<div class="row">
<!-- Tab panes -->
<div class="tab-content">

<!--- accountinfo-->

<div class="tab-pane active" id="accountinfo">

                    <div class="RegisterAlert">
                    <?php if($this->session->flashdata('register_success1') != ''){
                          echo $this->session->flashdata('register_success1');
                    }?>
                    </div>

                    <form id="RegisterForm" action="" >

                    <?php foreach($result as $value){ ?>
                    <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name="first_name" id="first_name" class="form-control" tabindex="1" type="text" value="<?php echo $value['first_name'];?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input name="middle_name" id="middle_name" class="form-control" tabindex="2" type="text" value="<?php echo $value['middle_name'];?>">
                                </div>
                            </div>
                        </div>


                       <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name="last_name" id="last_name" class="form-control"  tabindex="3" type="text" value="<?php echo $value['last_name'];?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input name="mobile" id="mobile" class="form-control"  tabindex="4" type="text" value="<?php echo $value['phone'];?>">
                                </div>
                            </div>
                        </div>


                         <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" id="email" class="form-control" tabindex="5" type="text"  readonly  value="<?php echo $value['email'];?>">
                                </div>
                            </div>
                           <!-- <option value="<?php echo $types['user_type_id']; ?>" <?php if($admin->usertype==$types['user_type_id']){echo "Selected";  if($types['user_type']=='Agent'){ $none="block"; } }?> class="<?php echo $class; ?>"><?php echo $types['user_type']; ?></option> -->
                       <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Nationality </label>
                                    <div class="styled-select" tabindex="6">
                                    
                                    <select name="nationality" >
                                    <?php global $NATIONALITY; 
                                    
                                    foreach($NATIONALITY as $nationality){
                                    
                                    ?>
                                    <option value="<?php echo $nationality?>"><?php echo $nationality?></option>
                                    
                                    <?php }?>
                                    </select>
                                    <script type='text/javascript'>selectOptionByValue(document.forms['RegisterForm'].elements['nationality'], '<?php echo $value['nationality']; ?>') </script>
                                    </div>	
                                </div>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-xs-12 col-md-6">
                          <div class="form-group">
                           <div class="col-md-12"><div class="row"><label>Date of Birth</label></div></div>
                           <div class="row">
							<div class="col-xs-4">
                            <?php 
                                    $dob=$value['dob'];
                                    $dateValue = strtotime($dob);
                                    $year = date('Y',$dateValue);
                                    $month = date('F',$dateValue);
                                    $day= date('d',$dateValue); 
                                    $nmonthcode= date("m", strtotime($month));
                                    
                                    ?>
							<div class="styled-select" tabindex="7">
							<select id="dobdays" name="dobdays" class="form-control input-lg" name="date"><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
                            <script type='text/javascript'>selectOptionByValue(document.forms['RegisterForm'].elements['dobdays'], '<?php echo $day; ?>') </script>
							</div></div>

							<div class="col-xs-4"><div class="styled-select" name="month" tabindex="8">
							<select id="dobmonth" name="dobmonth" class="form-control input-lg"><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>
							<script type='text/javascript'>selectOptionByValue(document.forms['RegisterForm'].elements['dobmonth'], '<?php echo $nmonthcode; ?>') </script>
                            </div></div>

							<div class="col-xs-4"><div class="styled-select" name="year" tabindex="9">
							<select id="dobyear" name="dobyear" class="form-control input-lg"><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option></select>
							<script type='text/javascript'>selectOptionByValue(document.forms['RegisterForm'].elements['dobyear'], '<?php echo $year; ?>') </script>
                            </div></div>
                            </div>


                           </div>
                            </div>
                        
                            <div class="col-xs-12 col-md-6">
                           <div class="form-group">
                                    <label>Building Number </label>
                                    <input name="building_number" id="building_number" class="form-control" tabindex="10" type="text" value="<?php echo $value['building_number'];?>">
                                </div>
							 </div>
                           </div>



                           <div class="row">
                            <div class="col-xs-12 col-md-6">
                             <div class="form-group">
                             <label>Street Name</label>
                            <input name="street_name" id="street_name" class="form-control" tabindex="11" type="text" value="<?php echo $value['address_line'];?>">
                            </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                               <div class="form-group">
                                    <label>Country</label>
									 <div class="styled-select" tabindex="12">
									  <select name="country" id="country" >
									 
                                <?php   $sql ="SELECT * FROM sv_countries";
										$query = $this->db->query($sql);
										if ($query->num_rows() > 0) {
										foreach ($query->result() as $row) {?> 
                                       <option value="<?php echo $row->id;?>"<?php if($row->id==$value['country']){
                                            echo "Selected";}?>><?php echo $row->name;?></option>
                                       <?php } }?>
									  </select>
									</div>  
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                    <label>District Name </label>
                                   <div class="styled-select" tabindex="13">
                                <select name="state" id="state"> 
                                <?php   
                                        $state=$value['state'];
                                        $sql ="SELECT * FROM sv_states where id='$state'";
										$query = $this->db->query($sql);
										if ($query->num_rows() > 0) {
										foreach ($query->result() as $row) { ?>
									<option  value="<?php echo $row->id ;?>" <?php if($row->name!=''){  echo "Selected";}?>><?php echo $row->name ?></option>
									<?php  } }?>
                                      </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                               <div class="form-group">
                                    <label>City</label>
                                    <div class="styled-select" tabindex="14">
                                <select name="city" id="city" >
								 <?php   
                                        $city=$value['city'];
                                        $sql ="SELECT * FROM sv_cities where id='$city'";
										$query = $this->db->query($sql);
										if ($query->num_rows() > 0) {
										foreach ($query->result() as $row) { ?>
                                        	<option  value="<?php echo $row->id ;?>" <?php if($row->name!=''){  echo "Selected";}?>><?php echo $row->name ?></option>
									<?php  } }?>
									  </select>
                                </div>
                                </div>
                            </div>
                        </div>


                         <div class="row">
                            <div class="col-xs-12 col-md-6">
                             <div class="form-group">
                                    <label>Postal code</label>
                                    <input name="postal_code" id="postal_code" class="form-control" tabindex="15" type="text" value="<?php echo $value['zip_code'];?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                               <div class="form-group">
                                    <label>wasel</label>
                                 
                                <input name="unit_no" id="unit_no" class="form-control" tabindex="16" type="text" value="<?php echo $value['unit_number'];?>">
                                </div>
                            </div>
                        </div>



                         <div class="row">
                            <div class="col-xs-12 col-md-6" tabindex="17">
                                <div class="form-group">
                                    <label>NationalAddress</label>
                                    <input name="additional_no" id="additional_no" class="form-control"  type="text" value="<?php echo $value['additional_number'];?>">
                                </div>
                            </div>
                             <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>National ID</label>
                                <input name="national_id" id="national_id"  class="form-control" value="<?php echo $value['national_id'];?>" tabindex="19" type="text">
                             </div>
                          </div>
                        </div>
                          <div class="row"  tabindex="18">
                         <div class="col-xs-12 col-md-12 text-center">
                                <button type="submit" class="site-btn mart-25">Submit</button>
                            </div>
                        </div>
                        <?php } ?>
                        
                        </form>
                        
</div>

<!--- accountinfo-->


</div>
</div>
</div>
</div></div>



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
            var city=$('#RegisterForm select[name="city"]');
            var district_name=$('#RegisterForm input[name="district_name"]');
            var postal_code=$('#RegisterForm input[name="postal_code"]');
            var additional_no=$('#RegisterForm input[name="additional_no"]');
            var unit_no=$('#RegisterForm input[name="unit_no"]');
            var nationality=$('#RegisterForm select[name="nationality"]');
            var country=$('#RegisterForm select[name="country"]');
            var dobday=$('#RegisterForm select[name="dobday"]');
            var dobmonth=$('#RegisterForm select[name="dobmonth"]');
            var dobyear=$('#RegisterForm select[name="dobyear"]');
            var national_id=$('#RegisterForm input[name="national_id"]');
            if(fname.val().trim() == ''){
                fname.parent().addClass('has-error');
                fname.after('<div class="c_error">First name is required</div>');
                error = true;
            }
            if(lname.val().trim() == ''){
                lname.parent().addClass('has-error');
                lname.after('<div class="c_error">Last name is required</div>');
                error = true;
            }
            if(email.val().trim() == ''){
                email.parent().addClass('has-error');
                email.after('<div class="c_error">Email is required</div>');
                error = true;
            }else if(!isValidEmailAddress(email.val())){
                email.parent().addClass('has-error');
                email.after('<div class="c_error">Email is not valid</div>');
                error = true;
            }
            if(mobile.val().trim() == ''){
                mobile.parent().addClass('has-error');
                mobile.after('<div class="c_error">Mobile is required</div>');
                error = true;
            }
            if(file.val() == ''){
                file.parent().addClass('has-error');
                file.parent().after('<div class="c_error">File is required</div>');
                error = true;
            }
            if(middle_name.val().trim()==''){
                middle_name.parent().addClass('has-error');
                middle_name.parent().after('<div class="c_error">Middle Name is required</div>');
                error = true;
            }
            if(street_name.val().trim()==''){
                street_name.parent().addClass('has-error');
                street_name.parent().after('<div class="c_error">Street Name is required</div>');
                error = true;
            }
            if(building_number.val().trim()==''){
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
            if(postal_code.val().trim()==''){
                postal_code.parent().addClass('has-error');
                postal_code.parent().after('<div class="c_error">Postal Code is required</div>');
                error = true;
            }
            if(additional_no.val().trim()==''){
                additional_no.parent().addClass('has-error');
                additional_no.parent().after('<div class="c_error">Additional Number is required</div>');
                error = true;
            }
            if(unit_no.val().trim()==''){
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
             if(national_id.val().trim()=='')
            {
                national_id.parent().addClass('has-error');
                national_id.after('<div class="c_error">National Id is required</div>');
                error=true;
                
            }
            if(error){
                return false;
                
            }
            $.ajax({
                url: base_url+'Myaccount/edit_myaccount',
                type: 'POST',
                data:formData,
                processData: false,
                contentType: false,
                success: function(data){
                   
                window.location.reload();
                 
                },
                error:function(e){
                    
                  
                }
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
