<?php //print_r($tasks); ?>


                        <table id="ProjectTaskList" class="datatable-basic animated fadeIn">
                            <thead style="display: none;">
                                <tr><th></th><th></th><th></th><th></th><th></th></tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($tasks)){ foreach ($tasks as $task){ ?>
                                <tr class="<?php echo ((date('Y-m-d',strtotime($task->due_on)) < date('Y-m-d',strtotime('now'))) && ($task->status != 3 and $task->status != 5)?'pastdue':''); ?>" id="TaskRow<?php echo $task->task_id; ?>" data-id="<?php echo $task->task_id; ?>">
                                    <td class="text-center">
                                    <?php if($task->status == 3 || $task->status == 5){ ?>
                                        <i class="icon-checkmark-circle"></i>
                                    <?php }else{ ?>
                                        <i class="icon-circle"></i>
                                    <?php } ?>
                                    </td>
                                    <td><?php echo ucfirst($task->title); ?></td>
                                    <td class="text-right"><?php echo $this->Tasks_model->getStatusView($task->status); ?></td>
                                    <td class="text-right"><?php echo date('M d, Y',strtotime($task->due_on)); ?></td>
                                    <td class="text-center">
                                        <a href="" data-popup="tooltip" title="<?php echo $task->afirst.' '.$task->alast; ?>">
                                            <?php if($task->aimg != '' && file_exists('./uploads/users/'.$task->assigned_to.'/'.$task->aimg)){ ?>
                                                <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$task->assigned_to.'/'.$task->aimg; ?>" alt="">
                                            <?php }else{ ?>
                                                <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                                            <?php } ?>
                                        </a>
                                    </td>
                                    <div class="clearfix"></div>
                                </tr>
                            <?php } } ?>
                            </tbody>
                        </table>
        <script>
            $(function() {

                var oTable = $('.datatable-basic').DataTable({
                    "rowCallback": function( row, data, index ) {
                        if($(row).attr('id') == 'TaskRow'+$('#TaskPreviewId').val()+''){
                            $(row).addClass('active');
                        }else{
                            $(row).removeClass('active');
                        }
                    },
                    dom: '<"datatable-scroll"t><"datatable-footer"ip>',
                });

                $('.search_filter').on('keyup', function () {
                    oTable.search( this.value ).draw();
                } );

                $(document).on('click','.addNewTask',function(e){
//
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/add_task_ajax',
                        'type': 'POST',
                        'data': {pid:'<?php echo $this->uri->segment(3); ?>'},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });

                $(document).on('click','.editTask',function(e){
                    var tid = $(this).data('id');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/edit_task_ajax',
                        'type': 'POST',
                        'data': {tid: tid,pid:'<?php echo $this->uri->segment(3); ?>'},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });


                $(document).on('click','.close_panel',function (e) {
                    $('#Task_preview').html('');
                    $('#ProjectTaskList tr').removeClass('active');
                });

                $(document).on('click','#ProjectTaskList tr',function(e){
//                    alert($(this).data('id'));
                    $(this).parent().find('tr').removeClass('active');
                    $(this).addClass('active');
                    $.ajax({
                        'url' : '<?php echo BASE; ?>tasks/task_preview',
                        'type': 'POST',
                        'data': {tid:$(this).data('id')},
                        success: function (data) {
                            $('#Task_preview').html(data);
                        }
                    });
                });


            });
        </script>