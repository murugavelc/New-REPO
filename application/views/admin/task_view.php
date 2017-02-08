<?php //print_r($task);
$this->load->view('header');
global $TASK_STATUS;
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/form_checkboxes_radios.js"></script>-->
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">Tasks</span> - <?php echo ucfirst($task->title); ?></h4>
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
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title">Task thread</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row task_comment_thread">
                            <div class="col-lg-12 cmt_left">
                                <div class="user-part">
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 no-padding user_img">
                                        <?php if($task->profile_img != ''){ ?>
                                            <img src="<?php echo BASE.'uploads/users/'.$task->created_by.'/'.$task->profile_img; ?>" class="img-circle">
                                        <?php }else{ ?>
                                            <img src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" class="img-circle">
                                        <?php } ?>

                                    </div>
                                    <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 tcmt_area">
                                        <div class="tcmt_text">
                                            <div class="cmt_head"><b><?php echo $task->cfirst.' '.$task->clast; ?></b> has created a task and assigned <b><?php echo $task->afirst.' '.$task->alast; ?></b></div>
                                            <p class="datetime_cmt"><i class="icon-calendar"></i> <?php echo date('d M, Y',strtotime($task->created_on));?> &nbsp;&nbsp;<i class="icon-alarm"></i> <?php echo date('H:i A',strtotime($task->created_on));?></p>
                                            <p><?php echo ucfirst($task->description); ?></p>
                                            <?php if($task->attachment != ''){ ?>
                                                <p><i class="icon-attachment"></i> <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$task->attachment;?>"><?php echo $task->attachment; ?></a></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php if(!empty($comments)){ foreach($comments as $comment){
                                if($comment->user_id == $task->created_by){
                                    if($comment->status != 0){ ?>
                                        <div class="col-lg-12 cmt_left">
                                            <div class="user-part">
                                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 no-padding user_img">
                                                    <?php if($comment->profile_img != ''){ ?>
                                                        <img src="<?php echo BASE.'uploads/users/'.$comment->user_id.'/'.$comment->profile_img; ?>" class="img-circle">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" class="img-circle">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 tcmt_area">
                                                    <div class="tcmt_text">
                                                        <div class="cmt_head"><b><?php echo $comment->first.' '.$comment->last; ?></b> has changed the status to <b><?php echo $this->Tasks_model->getStatusView($comment->status); ?></b></div>
                                                        <p class="datetime_cmt"><i class="icon-calendar"></i> <?php echo date('d M, Y',strtotime($comment->created_on));?> &nbsp;&nbsp;<i class="icon-alarm"></i> <?php echo date('H:i A',strtotime($comment->created_on));?></p>
                                                        <p><?php echo ucfirst($comment->comment); ?></p>
                                                        <?php if($comment->attachment != ''){ ?>
                                                            <p><i class="icon-attachment"></i> <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$comment->attachment;?>"><?php echo $comment->attachment; ?></a></p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }else{
                                ?>
                                <div class="col-lg-12 cmt_left">
                                    <div class="user-part">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 no-padding user_img">
                                            <?php if($comment->profile_img != ''){ ?>
                                                <img src="<?php echo BASE.'uploads/users/'.$comment->user_id.'/'.$comment->profile_img; ?>" class="img-circle">
                                            <?php }else{ ?>
                                                <img src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" class="img-circle">
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 tcmt_area">
                                            <div class="tcmt_text">
                                                <div class="cmt_head"><b><?php echo $comment->first.' '.$comment->last; ?></b> has commented on this task</div>
                                                <p class="datetime_cmt"><i class="icon-calendar"></i> <?php echo date('d M, Y',strtotime($comment->created_on));?> &nbsp;&nbsp;<i class="icon-alarm"></i> <?php echo date('H:i A',strtotime($comment->created_on));?></p>
                                                <p class="cmt_full"><?php echo ucfirst($comment->comment); ?></p>
                                                <?php if($comment->attachment != ''){ ?>
                                                    <p><i class="icon-attachment"></i> <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$comment->attachment;?>"><?php echo $comment->attachment; ?></a></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } }else{
                                    if($comment->status != 0){ ?>
                                        <div class="col-lg-12 cmt_right">
                                            <div class="user-part">
                                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 tcmt_area">
                                                    <div class="tcmt_text">
                                                        <div class="cmt_head"><b><?php echo $comment->first.' '.$comment->last; ?></b> has changed the status to <b><?php echo $this->Tasks_model->getStatusView($comment->status); ?></b></div>
                                                        <p class="datetime_cmt"><i class="icon-calendar"></i> <?php echo date('d M, Y',strtotime($comment->created_on));?> &nbsp;&nbsp;<i class="icon-alarm"></i> <?php echo date('H:i A',strtotime($comment->created_on));?></p>
                                                        <p><?php echo ucfirst($comment->comment); ?></p>
                                                        <?php if($comment->attachment != ''){ ?>
                                                            <p><i class="icon-attachment"></i> <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$comment->attachment;?>"><?php echo $comment->attachment; ?></a></p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 no-padding user_img">
                                                    <?php if($comment->profile_img != ''){ ?>
                                                        <img src="<?php echo BASE.'uploads/users/'.$comment->user_id.'/'.$comment->profile_img; ?>" class="img-circle">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" class="img-circle">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                   <?php }else{
                                ?>
                                <div class="col-lg-12 cmt_right">
                                    <div class="user-part">
                                        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 tcmt_area">
                                            <div class="tcmt_text">
                                                <div class="cmt_head"><b><?php echo $comment->first.' '.$comment->last; ?></b> has commented on this task</div>
                                                <p class="datetime_cmt"><i class="icon-calendar"></i> <?php echo date('d M, Y',strtotime($comment->created_on));?> &nbsp;&nbsp;<i class="icon-alarm"></i> <?php echo date('H:i A',strtotime($comment->created_on));?></p>
                                                <p><?php echo ucfirst($comment->comment); ?></p>
                                                <?php if($comment->attachment != ''){ ?>
                                                    <p><i class="icon-attachment"></i> <a target="_blank" href="<?php echo BASE.'uploads/projects/'.$task->project_id.'/tasks/'.$task->sno.'/'.$comment->attachment;?>"><?php echo $comment->attachment; ?></a></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 no-padding user_img">
                                            <?php if($comment->profile_img != ''){ ?>
                                                <img src="<?php echo BASE.'uploads/users/'.$comment->user_id.'/'.$comment->profile_img; ?>" class="img-circle">
                                            <?php }else{ ?>
                                                <img src="<?php echo BASE.'assets/images/placeholder.jpg'; ?>" class="img-circle">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                               <?php } }
                            } } ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <form id="AddTaskComment" action="#">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><b>Comment:</b></h6>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="task_comment" id="task_comment" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" name="task_id" value="<?php echo $task->task_id; ?>">
                                        <div class="form-group">
                                            <div class="btn btn-primary btn-icon btn-file"> <i class="icon-attachment"></i> Attachment <input type="file" name="attachment" class="file-input" data-show-caption="false" data-show-upload="false" id="task_attachment"></div>
                                            <button type="submit" class="btn btn-success pull-right">Add Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title">Task Details</h5>
                    </div>
                    <div class="panel-body">
                        <h5><b>Title :</b> <?php echo $task->title; ?></h5>
                        <p><b>Project :</b> <?php echo $task->project_name; ?></p>
                        <p><b>Due Date :</b> <?php echo date('d F, Y',strtotime($task->due_on)); ?></p>
                        <p><b>Status :</b> <a id="ChangeTaskStatus" data-popup="tooltip" title="Click To Change Status" data-id="<?php echo $task->task_id; ?>" data-status="<?php echo $task->status; ?>"><?php echo $this->Tasks_model->getStatusView($task->status); ?></a></p>
                        <p><b>Created By :</b> <?php echo $task->cfirst.' '.$task->clast; ?></p>
                        <p><b>Assigned To :</b> <?php echo $task->afirst.' '.$task->alast; ?></p>
                        <p><b>Description :</b> <?php echo $task->description; ?></p>
                        <?php //print_r($task); ?>
                    </div>
                </div>
            </div>
        </div>
        
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

                $('#AddTaskComment').submit(function(e){
                    var formData = new FormData($('#AddTaskComment')[0]);
                    e.preventDefault();
                    var comment = $('#task_comment');
                    var error = false;
                    $(this).find('*').removeClass('has-error');
                    $('.c_error').remove();
                    if($.trim(comment.val()) == ''){
                        error = true;
                        comment.parent().addClass('has-error');
                        comment.after('<div class="c_error text-warning-800">Comment is required</div>');
                    }
                    if(error){
                        return false;
                    }

                    $.ajax({
                        url: "<?php echo BASE; ?>tasks/comment_insert",
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
                            if(data.success){
                                swal({
                                    title: "Success!",
                                    text: "Task comment has been added successfully!",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success"
                                },function(){
                                    location.reload();
                                });
                            }else{

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
        <div id="modal_theme_info" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Change Status</h5>
                    </div>

                    <div class="modal-body">
                        <form id="AddTaskComment2" action="#">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for=""><b>Task Status:</b></label>
                                        <select name="task_status" id="TaskStatus" class="select">
                                            <?php
                                            global $TASK_STATUS;
                                            foreach ($TASK_STATUS as $id => $status){
                                                echo '<option value="'.$id.'">'.$status.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div><br>
                                    <div class="col-md-12">
                                        <label><b>Comment:</b></label>
                                        <div class="form-group">
                                            <textarea name="task_comment" id="task_comment_change" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" name="task_id" id="task_id" value="">
                                        <div class="form-group">
                                            <div class="btn btn-primary btn-icon btn-file"> <i class="icon-attachment"></i> Attachment <input type="file" name="attachment" class="file-input" data-show-caption="false" data-show-upload="false" id="task_attachment"></div>
                                            <button type="submit" class="btn btn-success pull-right">Add Comment</button>
                                            <button type="button" class="btn btn-link pull-right" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.select').select2({
                minimumResultsForSearch: -1,
                width:'100%',
            });

            $(document).on('click','#ChangeTaskStatus',function(e){
                var status = $(this).data('status');
                var task_id = $(this).data('id');
                $('#task_id').val(task_id);
                $('#TaskStatus').val(status);
                $('#TaskStatus').trigger('change');
                $('#modal_theme_info').modal('show');
            });

            $('#AddTaskComment2').submit(function(e){
                var formData = new FormData($('#AddTaskComment2')[0]);
                e.preventDefault();
                var comment = $('#task_comment_change');
                var error = false;
                $(this).find('*').removeClass('has-error');
                $('.c_error').remove();
                if($.trim(comment.val()) == ''){
                    error = true;
                    comment.parent().addClass('has-error');
                    comment.after('<div class="c_error text-warning-800">Comment is required</div>');
                }
                if(error){
                    return false;
                }

                $.ajax({
                    url: "<?php echo BASE; ?>tasks/comment_insert",
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
                        if(data.success){
                            swal({
                                title: "Success!",
                                text: "Task comment has been added successfully!",
                                confirmButtonColor: "#66BB6A",
                                type: "success"
                            },function(){
                                location.reload();
                            });
                        }else{

                        }
                    },
                    error: function(){

                    }
                });
            });
        </script>