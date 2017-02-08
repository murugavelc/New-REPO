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
    <div class="project-header page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-stack2"></i> <span class="text-semibold">Edit Project</span> - <?php echo $project->project_name; ?>
                </h4>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a href="<?php echo BASE; ?>projects" class="btn btn-success btn-icon btn-xs"><i class="icon-circle-left2"></i> Back to Project</a>
                </div>
            </div>
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
                        <div class="col-md-12">
                        <legend class="text-semibold"><i class="icon-stack2 position-left"></i> Edit Project</legend>
                        </div>
                        <div class="col-md-6">
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Project name:</label>
                                            <input type="text" placeholder="Project Name" name="project_name" value="<?php echo $project->project_name; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Client:</label>
                                            <select class="select" name="client">
                                                <?php foreach ($clients as $client){
                                                    if($project->client_id == $client->user_id){
                                                        echo '<option selected="selected" value="' . $client->user_id . '">' . $client->first_name . ' ' . $client->last_name . '</option>';
                                                    }else {
                                                        echo '<option value="' . $client->user_id . '">' . $client->first_name . ' ' . $client->last_name . '</option>';
                                                    }
                                                }?>
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
                                                <input type="text" class="form-control daterange-basic" name="start_end_date" value="<?php echo date('m/d/Y',strtotime($project->start_date)).' - '.date('m/d/Y',strtotime($project->end_date)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Team Members:</label>
                                            <?php //print_r($pusers); ?>
                                            <select multiple="multiple" id="teamMembers" name="project_users[]" class="">
                                                <?php foreach ($users as $user) {
                                                    if(in_array($user->user_id,$pusers)){
                                                        if(file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img.'')){
                                                            echo '<option selected="selected" data-img="' . $user->profile_img . '" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                        }else {
                                                            echo '<option selected="selected" data-img="" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                        }
                                                    }else{
                                                        if(file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img.'')){
                                                            echo '<option data-img="' . $user->profile_img . '" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                        }else {
                                                            echo '<option data-img="" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                        }
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
                                    <div class="col-md-6 text-center">
                                        <?php if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){ ?>
                                            <img id="blah" width="90px" height="90px" class="img-circle" src="<?php echo BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img; ?>" alt="">
                                        <?php }else{ ?>
                                            <img id="blah" width="90px" height="90px" class="img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                        <?php } ?>
<!--                                        <img width="120px" src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-circle img-responsive" alt="">-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>More Information:</label>
                                    <textarea rows="5" cols="5" name="more_info" class="form-control" placeholder="Please Enter Information"><?php echo $project->more_info; ?></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="hidden" name="project_id" value="<?php echo $project->project_id; ?>">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('footer'); ?>
<script>
    function formatState (state) {
        if (!state.id) { return state.text; }
        if(!state.element.dataset.img || !state.id){
            var $state = $('<span><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-usr" /> ' + state.text + '</span>');
        }else {
            var $state = $('<span><img src="<?php echo BASE; ?>uploads/users/' + state.element.value.toLowerCase() + '/' + state.element.dataset.img + '" class="img-usr" /> ' + state.text + '</span>');
        }
        return $state;
    }
    $(function() {
        $('#teamMembers').select2({
            templateResult: formatState,
            placeholder: "Type a Member Name",
        });
    });
$(document).ready(function () {
    $('#AddUser').submit(function(e){
        var formData = new FormData($('#AddUser')[0]);
        e.preventDefault();
        var name = $('input[name="project_name"]');
//        var start = $('input[name="start_end_date"]');
//        var end = $('input[name="end_date"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(name.val()) == ''){
            error = true;
            name.parent().addClass('has-error');
            name.after('<div class="c_error text-warning-800">This field is required</div>');
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
            url: "<?php echo BASE; ?>projects/update",
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
                }else{
                    swal({
                        title: "Success!",
                        text: "Project has been updated successfully!",
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