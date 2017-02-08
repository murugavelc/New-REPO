<?php //print_r($clients);
$this->load->view('header');

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

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header project-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Projects</span> - Add New Project</h4>
            </div>

            <div class="heading-elements">
                <a href="<?php echo BASE; ?>projects" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Projects</span></a>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
<!--        <div class="row page_header">-->
<!--            <div class="col-sm-6">-->
<!--                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Projects</span> - Add New Project</h4>-->
<!--            </div>-->
<!--            <div class="col-sm-6 text-right">-->
<!--                <a href="--><?php //echo BASE; ?><!--projects" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Projects</span></a>-->
<!--            </div>-->
<!--        </div>-->
        <!-- 2 columns form -->
        <form id="AddUser" action="#">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        <legend class="text-semibold"><i class="icon-user-plus position-left"></i> Add New Project</legend>
                        </div>
                        <div class="col-md-6">
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Project name:</label>
                                            <input type="text" placeholder="Project Name" name="project_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Client:</label>
                                            <select class="select" name="client">
                                                <?php foreach ($clients as $client){ echo '<option value="'.$client->user_id.'">'.$client->first_name.' '.$client->last_name.'</option>'; }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Start & End Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control daterange-basic" name="start_end_date" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Team Members:</label>
                                            <?php //print_r($users);
                                            //

                                             ?>
                                            <select multiple="multiple" id="teamMembers" name="project_users[]" class="">
                                                <?php foreach ($users as $user) {
                                                    if(file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img.'')){
                                                        echo '<option data-img="' . $user->profile_img . '" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                    }else {
                                                        echo '<option data-img="" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attachment:</label>
                                            <input type="file" id="project_img" name="project_img" class="file-styled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>More Information:</label>
                                    <textarea rows="5" cols="5" name="more_info" class="form-control" placeholder="Please Enter Information"></textarea>
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
<?php $this->load->view('footer'); ?>
<script>
    $(function() {
        $('#teamMembers').select2({
            templateResult: formatState,
            placeholder: "Type a Member Name",
        });
    });
    function formatState (state) {
        if (!state.id) { return state.text; }
        if(!state.element.dataset.img || !state.id){
            var $state = $('<span><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-usr" /> ' + state.text + '</span>');
        }else {
            var $state = $('<span><img src="<?php echo BASE; ?>uploads/users/' + state.element.value.toLowerCase() + '/' + state.element.dataset.img + '" class="img-usr" /> ' + state.text + '</span>');
        }
        return $state;
    }
$(document).ready(function () {

    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        var name = $('input[name="project_name"]');
        var team = $('#teamMembers');
        var pimg = $('#project_img');
//        var end = $('input[name="end_date"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(name.val()) == ''){
            error = true;
            name.parent().addClass('has-error');
            name.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if($.trim(team.val()) == ''){
            error = true;
            team.parent().addClass('has-error');
            team.parent().find('span.select2').after('<div class="c_error text-warning-800">Team Users is required</div>');
        }
//        if($.trim(start.val()) == ''){
//            error = true;
//            start.parent().addClass('has-error');
//            start.after('<div class="c_error text-warning-800">This field is required</div>');
//        }
//        if($.trim(end.val()) == ''){
//            error = true;
//            end.parent().addClass('has-error');
//            end.after('<div class="c_error text-warning-800">This field is required</div>');
//        }else{
//
//        }
        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo BASE; ?>projects/insert",
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
                    if(data.error.name){
                        name.parent().addClass('has-error');
                        name.after('<div class="c_error text-warning-800">'+data.error.name+'</div>');
                    }
                    if(data.error.img){
                        pimg.parent().addClass('has-error');
                        pimg.after('<div class="c_error text-warning-800">'+data.error.img+'</div>');
                    }
                }else{
                    swal({
                        title: "Success!",
                        text: "Project has been added successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        window.location.href = '<?php echo BASE; ?>projects';
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