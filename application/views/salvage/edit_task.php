<?php //print_r($task);
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
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_checkboxes_radios.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Tasks</span> - Edit - <?php echo $task->title; ?></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="<?php echo BASE; ?>tasks" class="btn btn-success"><i class="icon-circle-left2"></i><span> Back to Tasks</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

<!--        <div class="row page_header">-->
<!--            <div class="col-sm-6">-->
<!--                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Projects</span></h4>-->
<!--            </div>-->
<!--            <div class="col-sm-6 text-right">-->
<!--                <a href="--><?php //echo BASE; ?><!--projects/add" class="btn btn-success"><i class="icon-plus2"></i><span> Add New Project</span></a>-->
<!--            </div>-->
<!--        </div>-->

        <!-- 2 columns form -->
        <form id="AddTask" action="#">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        <legend class="text-semibold"><i class="icon-user-plus position-left"></i> Edit Task</legend>
                        </div>
                        <div class="col-md-6">
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Task name:</label>
                                            <input type="text" placeholder="Task Name" name="task_name" value="<?php echo $task->title; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Due Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control daterange-single" name="due_date" value="<?php echo date('m/d/Y',strtotime($task->due_on)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Project:</label>
                                            <select disabled class="select" name="project">
                                                <?php foreach ($projects as $project){
                                                    if($task->project_id == $project->project_id){
                                                        echo '<option selected="selected" value="'.$project->project_id.'">'.$project->project_name.'</option>';
                                                    }else{
                                                        echo '<option value="'.$project->project_id.'">'.$project->project_name.'</option>';
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attachment:</label>
                                            <div id="input_file_old" class="<?php echo ($task->attachment == '')?'hide':''; ?>">
                                                <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$task->attachment; ?>"><?php echo $task->attachment; ?></a>
                                                &nbsp;&nbsp;<a class="btn bg-slate-400 btn-xs btnChange">Change</a>
                                            </div>
                                            <div id="input_attach" class="<?php echo ($task->attachment != '')?'hide':''; ?>">
                                                <input type="file" name="attach_file" class="file-styled">
                                                <a class="btn btnChange bg-warning-400 btn-xs  <?php echo ($task->attachment == '')?'hide':''; ?>">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Assigned To:</label>
                                            <select id="projectUsers" class="select" name="projectUsers">
                                                <?php foreach ($project_users as $user){
                                                    if($user->user_id == $task->assigned_to){
                                                        echo '<option selected="selected" value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                    }else {
                                                        echo '<option value="' . $user->user_id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                    </div>




                                </div>


                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset>

<!--                                <div class="form-group">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label>More Information:</label>
                                            <textarea rows="5" cols="5" name="more_info" class="form-control" placeholder="Please Enter Information"><?php echo $task->description; ?></textarea>
                                                </div>
                                        </div>
                                    </div>

<!--                                </div>-->
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="hidden" name="task_id" value="<?php echo $task->task_id; ?>">
                        <input type="hidden" name="project_id" value="<?php echo $task->project_id; ?>">
                        <input type="hidden" name="sno" value="<?php echo $task->sno; ?>">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('footer'); ?>
<script>
$(document).ready(function () {
    $(document).on('click','.btnChange',function(e){
        e.preventDefault();
        if($('#input_attach').hasClass('hide')){
            $('#input_attach').removeClass('hide');
            $('#input_file_old').addClass('hide');
        }else if($('#input_file_old').hasClass('hide')){
            $("input[name='attach_file']").val('');
            $("input[name='attach_file']").parent().find('span.filename').html('');
            $('#input_file_old').removeClass('hide');
            $('#input_attach').addClass('hide');
        }
    });

    $('#AddTask').submit(function(e){
        var formData = new FormData($('#AddTask')[0]);
        e.preventDefault();
        var name = $('input[name="task_name"]');
        var pusers = $('#projectUsers');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(name.val()) == ''){
            error = true;
            name.parent().addClass('has-error');
            name.after('<div class="c_error text-warning-800">Task name is required</div>');
        }
//        alert(pusers.val());
        if($.trim(pusers.val()) == ''){
            error = true;
            pusers.parent().addClass('has-error');
            pusers.parent().find('span.select2').after('<div class="c_error text-warning-800">Assigned to is required</div>');
        }
        if(error){
            return false;
        }

        $.ajax({
            url: "<?php echo BASE; ?>tasks/update",
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
                        text: "Task has been updated successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        window.location.href = '<?php echo BASE; ?>tasks';
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