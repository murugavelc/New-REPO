
<!-- Theme JS files -->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/selects/select2.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/styling/uniform.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/notifications/jgrowl.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/ui/moment/moment.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/daterangepicker.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/anytime.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/pickadate/picker.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/pickadate/picker.date.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/pickadate/picker.time.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/pickers/pickadate/legacy.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/picker_date.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/styling/switchery.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/styling/switch.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/core/app.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/form_layouts.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/form_checkboxes_radios.js"></script>-->
<!-- /theme JS files -->


        <!-- 2 columns form -->
        <form id="AddTask" action="#" class="animated fadeIn">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-user-plus position-left"></i> Add New Task</h5>
                    <div class="heading-elements">
                        <a class="btn btn-default close_panel"><i class="icon-cross"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Task name:</label>
                                        <input type="text" placeholder="Task Name" name="task_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Due Date:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control daterange-single" name="due_date" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="project" value="<?php echo $project_id; ?>">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Attachment:</label>
                                        <input type="file" name="attach_file" class="file-styled">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assigned To:</label>
                                        <select id="projectUsers" class="select" name="projectUsers">
                                            <?php foreach ($project_users as $user){ echo '<option value="'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</option>'; }?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Priority:</label>
                                        <div class="checkbox checkbox-switch no-margin">
                                            <label>
                                                <input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Low" data-off-text="High" class="switch" checked="checked">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>More Information:</label>
                                    <textarea rows="5" cols="5" name="more_info" class="form-control" placeholder="Please Enter Information"></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->

<script>
$(document).ready(function () {

    $('.select').select2();

    $(".switch").bootstrapSwitch();

    $('.daterange-single').daterangepicker({
        singleDatePicker: true
    });

    $(".file-styled").uniform({
        fileButtonHtml: '<i class="icon-googleplus5"></i>',
        wrapperClass: 'bg-warning'
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
            url: "<?php echo BASE; ?>tasks/insert",
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
                        text: "Task has been added successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        location.reload();
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