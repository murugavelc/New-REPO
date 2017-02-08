    <input type="hidden" id="TaskPreviewId" value="<?php echo $task->task_id; ?>">
    <?php
    $cmntView = FALSE;
    if($this->session->flashdata('cmnt') == TRUE){
        $cmntView = TRUE;
    } ?>
    <!-- Accordion with right control button -->
    <div class="panel-group panel-group-control panel-group-control-right content-group-lg animated fadeIn" id="accordion-control-right">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a class="<?php echo ($cmntView == TRUE)?'collapsed':''; ?>" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><b><i class="icon-list2"></i> <?php echo ucfirst($task->title); ?></b></a>
                    <button data-id="<?php echo $task->task_id; ?>" class="btn btn-xs bg-primary-800 editTask"><i class="icon-pencil7"></i> Edit</button>
                </h6>
            </div>
            <div id="accordion-control-right-group1" class="panel-collapse collapse <?php echo ($cmntView == FALSE)?'in':''; ?>">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><i class="icon-calendar2"></i> <?php echo date('d F, Y',strtotime($task->due_on)); ?></p>
                            <p><b>Created By :</b>
                                <a href="" data-popup="tooltip" title="<?php echo $task->cfirst.' '.$task->clast; ?>">
                                    <?php if($task->profile_img != '' && file_exists('./uploads/users/'.$task->created_by.'/'.$task->profile_img)){ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$task->created_by.'/'.$task->profile_img; ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    <?php } ?>
                                </a>
                                <?php echo $task->cfirst.' '.$task->clast; ?></p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p><b>Status :</b> <a id="ChangeTaskStatus" data-popup="tooltip" title="Click To Change Status" data-id="<?php echo $task->task_id; ?>" data-status="<?php echo $task->status; ?>"><?php echo $this->Tasks_model->getStatusView($task->status); ?></a></p>
                            <p><b>Assigned To :</b>
                                <a href="" data-popup="tooltip" title="<?php echo $task->afirst.' '.$task->alast; ?>">
                                    <?php if($task->aimg != '' && file_exists('./uploads/users/'.$task->assigned_to.'/'.$task->aimg)){ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$task->assigned_to.'/'.$task->aimg; ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                    <?php } ?>
                                </a>
                                <?php echo $task->afirst.' '.$task->alast; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><b>Description :</b></p> <p><?php echo $task->description; ?></p>
                        </div>
                        <?php if($task->attachment != ''){ ?>
                            <div class="col-sm-12">
                                <p><a href=""><i class="icon-attachment"></i></a><?php echo $task->attachment; ?></p>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a class="<?php echo ($cmntView == FALSE)?'collapsed':''; ?>" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><b><i class="icon-bubbles7"></i> Comments</b></a>
                </h6>
            </div>
            <div id="accordion-control-right-group2" class="panel-collapse collapse <?php echo ($cmntView == TRUE)?'in':''; ?>">
                <div class="panel-body">
                    <style>
                        .task_comment_thread{
                            height: 300px;
                            overflow: auto;
                            border:1px solid #ccc;
                        }
                    </style>
                    <div class="col-md-12">
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
        </div>
    </div>
    <!-- /accordion with right control button -->
    <script>

    </script>


    <script>
        $(document).ready(function () {

            $('.task_comment_thread').scrollTop($('.task_comment_thread')[0].scrollHeight);

            $('#accordion-control-right-group2').on('shown.bs.collapse',function () {
                $('.task_comment_thread').scrollTop($('.task_comment_thread')[0].scrollHeight);
//                $('.task_comment_thread').mCustomScrollbar({
//                    setHeight:300,
//                    theme:"minimal-dark"
//                }).mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});
            });

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
                var tid = '<?php echo $task->task_id; ?>';
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
//                                    location.reload();
                                $('#TaskRow'+tid).click();
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
<!--        <script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/plugins/forms/selects/select2.min.js"></script>-->
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