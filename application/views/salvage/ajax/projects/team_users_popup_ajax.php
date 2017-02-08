<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_checkboxes_radios.js"></script>
<div class="modal-header bg-teal-300">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h5 class="modal-title">Team Users - <?php echo $project->project_name; ?></h5>
</div>
<form id="UpdateTeamUsers" action="">
    <div class="modal-body">
        <div id="TeamPopAlert"></div>
        <div id="TeamUserSelect" class="row">
        <?php //print_r($pusers);
        if(!empty($users)){
            foreach ($users as $user){
    //            print_r($user);
                $Act = FALSE;
                if(in_array($user->user_id,$pusers)){ $Act = TRUE; } ?>
                <label class="col-sm-6 user_container <?php echo ($Act == TRUE ? 'active':''); ?>" for="TUser<?php echo $user->user_id; ?>">
                    <div class="user_block">
                        <div class="user_blk_img">
                        <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
                            <img class="img-usr img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
                        <?php }else{ ?>
                            <img class="img-usr img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                        <?php } ?>
                        </div>
                        <div class="user_blk_text">
                            <b><?php echo $user->first_name.' '.$user->last_name; ?></b><br>
                            <span class="label bg-teal-400"><?php echo $user->name; ?></span>
                        </div>
                        <div class="checkboxright">
                        <div class="checkbox">
                            <label>
                                <input id="TUser<?php echo $user->user_id; ?>" name="tusers[]" type="checkbox" value="<?php echo $user->user_id; ?>" class="checkbx control-success" <?php echo ($Act == TRUE ? 'checked="checked"':''); ?>>
                            </label>
                        </div>
                        </div>
                    </div>
                </label>
            <?php }
        }?>
        </div>
    </div>
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <div class="modal-footer text-center">
        <button type="submit" class="btn bg-teal-600">Save changes</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $(document).on('change',".checkbx",function() {
            if($(this).is(':checked')) {
                $(this).closest('.user_container').addClass('active');
            }else{
                $(this).closest('.user_container').removeClass('active');
            }
        });

        $('#UpdateTeamUsers').submit(function(e){
            var formData = new FormData($('#UpdateTeamUsers')[0]);
            e.preventDefault();
            $.ajax({
                url: "<?php echo BASE; ?>projects/updateTeamUsers",
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                },
                success: function(data){
                    if(data.error){
                        swal.close();
                        $('#TeamPopAlert').html(data.error);
                    }else{
                        swal({
                            title: "Success!",
                            text: "Team users has been updated successfully!",
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

    });
</script>