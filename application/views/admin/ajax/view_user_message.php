<?php
if(isset($group)){ ?>
    <div class="profile_pic">
        <?php if($group->group_img != '' && file_exists('./uploads/message/group/'.$group->group_id.'/'.$group->group_img)){ ?>
            <img src="<?php echo BASE.'uploads/message/group/'.$group->group_id.'/'.$group->group_img; ?>" class="img-circle img-responsive" alt="Profile Picture">
        <?php }else{ ?>
            <img class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
        <?php } ?>
    </div>
    <h1 class="profile_name"><?php echo $group->group_name;?></h1>
    <label for="" class="profile_role label label-success">Total Users : <?php echo count($group_users); ?></label>
    <ul class="team_users">
        <?php foreach ($group_users as $usr){ ?>
            <li>
                <a data-toggle="tooltip" title="<?php echo $usr->first_name.' '.$usr->last_name; ?>" href="">
                    <?php if($usr->profile_img != '' && file_exists('./uploads/users/'.$usr->user_id.'/'.$usr->profile_img)){ ?>
                        <img class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$usr->user_id.'/'.$usr->profile_img; ?>" alt="">
                    <?php }else{ ?>
                        <img class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                    <?php } ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    <?php if($is_admin){ ?>
        <a href="" class="btn btn-success btn-xs edit_group" data-gid="<?php echo $group->group_id; ?>" ><i class="icon-pencil3"></i> Edit Group</a>
        <a href="" class="btn btn-warning btn-xs exit_group"><i class="icon-exit"></i> Exit Group</a>
    <?php } ?>
<?php }else{ ?>
    <div class="profile_pic">
        <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
            <img class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
        <?php }else{ ?>
            <img class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
        <?php } ?>
    </div>
    <h1 class="profile_name"><?php echo $user->first_name.' '.$user->last_name;?></h1>
    <p class="profile_email"><?php echo $user->email; ?></p>
    <label for="" class="profile_role label label-success"><?php echo $user->name; ?></label>
<?php } ?>
<div class="clearfix"></div><br>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>