<?php
//print_r($tasks);
$this->load->view('header');
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>

<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Content area -->
    <div class="content">

        <!-- Page header -->
<!--        <div class="page-header page-header-xs">-->
<!--            <div class="page-header-content">-->
<!--                <div class="page-title">-->
<!--                    <h4><i class="icon-stack2 position-left"></i> <span class="text-semibold"> Tasks</span></h4>-->
<!--                </div>-->
<!---->
<!--                <div class="heading-elements">-->
<!--                    <div class="heading-btn-group">-->
<!--                        <a href="--><?php //echo BASE; ?><!--tasks/add" class="btn btn-success"><i class="icon-user-plus"></i> Add New Task</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- /page header -->
        <div class="row page_header">
            <div class="col-sm-6">
                <h4><i class="icon-googleplus5 position-left"></i> <span class="text-semibold">Tasks</span></h4>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo BASE; ?>tasks/add" class="btn btn-success"><i class="icon-plus2"></i><span> Add New Task</span></a>
            </div>
        </div>

        <div class="panel panel-flat">

            <table class="table datatable-basic table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Assignor</th>
                    <th>Assignee</th>
                    <th>Due On</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(!empty($tasks)){
                        foreach ($tasks as $task){ ?>
                        <tr>
                            <td><?php echo $task->sno; ?></td>
                            <td><?php echo $task->title; ?></td>
                            <td><?php echo $task->project_name; ?></td>
                            <td><?php echo $task->cfirst.' '.$task->clast; ?></td>
                            <td><?php echo $task->afirst.' '.$task->alast; ?></td>
                            <td><?php echo date('Y-m-d',strtotime($task->due_on)); ?></td>
                            <td class="text-center"><a id="ChangeTaskStatus" data-popup="tooltip" title="Click To Change Status" data-id="<?php echo $task->task_id; ?>" data-status="<?php echo $task->status; ?>"><?php echo $this->Tasks_model->getStatusView($task->status); ?></a></td>
                            <td class="text-center">
                                <ul class="actions icons-list">
                                    <li class=""><a data-popup="tooltip" title="View" href="<?php echo BASE; ?>tasks/view/<?php echo encode($task->task_id); ?>" class="btn btn-success text-white btn-xs"><i class="icon-eye"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo BASE; ?>tasks/edit/<?php echo $task->task_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $task->task_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

<?php $this->load->view('footer'); ?>
<script>
    $(function() {
        var oTable = $('.datatable-basic').DataTable({
            columnDefs: [{
                orderable: false,
                width: '200px',
                targets: [ 5 ]
            }],
        });

        $('.search_filter').on( 'keyup', function () {
            oTable.search( this.value ).draw();
        } );
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