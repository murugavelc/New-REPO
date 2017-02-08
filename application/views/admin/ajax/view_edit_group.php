<div class="modal-header bg-info">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h5 class="modal-title">Edit Group - <?php echo $group->group_name; ?></h5>
</div>

<div class="modal-body">
    <form id="UpdateGroup" action="#">
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Group Name:</label>
                        <input type="text" id="edit_group_name" name="group_name" value="<?php echo $group->group_name; ?>" placeholder="Group Name" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Attachment:</label>
                        <div id="file_input" class="row">
                            <div class="col-sm-9">
                                <input type="file" id="edit_group_img" name="group_img" class="file-styled">
                            </div>
                            <div class="col-sm-3">
                                <a href="" class="btn bg-slate change_file"><i class="icon-cross2"></i></a>
                            </div>
                        </div>
                        <div id="file_view" class="text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <img style="width: 120px;" class="img-circle img-responsive" src="<?php echo BASE.'uploads/message/group/'.$group->group_id.'/'.$group->group_img; ?>" alt="">
                                </div>
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary change_file">Change</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Group Users:</label>
                        <?php $gusers = array(); foreach($group_users as $grpu){
                            $gusers[] = $grpu->user_id;
                        } ?>
                        <select multiple name="group_users[]" class="select" placeholder="Select Group Users" id="edit_group_users">
                            <?php foreach ($users as $usr){
                                if(in_array($usr->user_id,$gusers)){
                                    echo '<option selected="selected" value="' . $usr->user_id . '">' . $usr->first_name . ' ' . $usr->last_name . '</option>';
                                }else {
                                    echo '<option value="' . $usr->user_id . '">' . $usr->first_name . ' ' . $usr->last_name . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" id="grp_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="group_id" id="edit_group_id" value="<?php echo $group->group_id; ?>">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.select').select2();

        $(".file-styled").uniform({
            fileButtonHtml: '<i class="icon-googleplus5"></i>',
            wrapperClass: 'bg-warning'
        });

        $('.change_file').on('click',function(e){
            e.preventDefault();
            $('#file_view').toggle();
            $('#file_input').toggle();
        });

        $('#UpdateGroup').on('submit',function(e){
            e.preventDefault();
            var formData = new FormData($("#UpdateGroup")[0]);
            var error = false;
            $('#UpdateGroup').find('*').removeClass('has-error');
            $('.c_error').remove();
            var name = $('#edit_group_name');
            var users = $('#edit_group_users');
            if(name.val() == ''){
                name.parent().addClass('has-error');
                name.after('<div class="c_error text-warning-800">This field is required</div>');
                error = true;
            }
            alert(users.val());
            if(users.val() == '' || users.val() == null){
                users.parent().addClass('has-error');
                users.parent().after('<div class="c_error text-warning-800">This field is required</div>');
                error = true;
            }
            if(error){
                return false;
            }
            $.ajax({
                url: base_url + 'messages/update_group',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if(data.error){
                        swal.close();
                        if(data.error.img){
                            $('#edit_group_img').parent().addClass('has-error');
                            $('#edit_group_img').after('<div class="c_error text-warning-800">'+data.error.img+'</div>');
                        }
                        if(data.error.name){
                            name.parent().addClass('has-error');
                            name.after('<div class="c_error text-warning-800">'+data.error.name+'</div>');
                        }
                    }else if(data.success){
                        swal({
                            title: "Success!",
                            text: "Group has been updated successfully!",
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        },function(){
                            location.reload();
                        });
                    }
                }
            });
        });
    });
</script>