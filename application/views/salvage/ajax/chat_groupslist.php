
            <?php if(!empty($groups)){
                foreach ($groups as $group){
                    ?>
                    <li class="<?php if($group->group_id == $input['uid'] && $input['group'] == 1){ echo 'active'; }?>">
                        <a data-id="<?php echo $group->group_id; ?>" data-name="<?php echo $group->group_name; ?>" data-group="1" href="">
                            <div class="users-left">
                                <?php if($group->group_img != '' && file_exists('./uploads/message/group/'.$group->group_id.'/'.$group->group_img)){ ?>
                                    <img src="<?php echo BASE.'uploads/message/group/'.$group->group_id.'/'.$group->group_img; ?>" class="img-circle img-sm" alt="Profile Picture">
                                <?php }else{ ?>
                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle img-sm" alt="Profile Picture">
                                <?php } ?>
                            </div>
                            <div class="users-right">
                                <span class="usr-name"><?php echo $group->group_name; ?></span><br>
                                <span class="usr-time pull-right"></span>
                                <span class="usr-msg"><br></span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                <?php } }else{ ?>
                <li>
                    No Results Found
                </li>
            <?php } ?>