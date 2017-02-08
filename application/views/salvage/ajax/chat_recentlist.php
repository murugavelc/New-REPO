<?php foreach ($recent as $user){
    if($user['gu_id'] == $input['uid'] && $user['is_group'] == $input['group']){ ?>
        <li class="active">
            <a data-id="<?php echo $user['gu_id']; ?>" data-name="<?php echo $user['name']; ?>" data-group="<?php echo $user['is_group']; ?>" href="">
                <div class="users-left">
                    <?php if($user['img'] != '' && file_exists('./uploads/users/'.$user['gu_id'].'/'.$user['img'])){ ?>
                        <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user['gu_id'].'/'.$user['img']; ?>" alt="">
                    <?php }else{ ?>
                        <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                    <?php } ?>
                </div>
                <div class="users-right">
                    <span class="usr-name"><?php echo $user['name']; ?></span><br>
                    <span class="usr-time pull-right">
                                                <?php if(date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($user['datetime']))){
                                                    echo date('H:i A', strtotime($user['datetime']));
                                                }else {
                                                    echo date('M d, y', strtotime($user['datetime']));
                                                }
                                                ?>
                                            </span>
                    <span class="usr-msg">
                                                <?php if($user['message'] != '') {
                                                    if($_SESSION['user_id'] == $user['sender']){
                                                        echo 'Me: '.$user['message'];
                                                    }else {
                                                        echo $user['message'];
                                                    }
                                                }else{
                                                    echo '<i class="icon-attachment"></i>'.$user['file'];
                                                }?>
                                            </span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
    <?php }else{ ?>
    <li class="">
        <a data-id="<?php echo $user['gu_id']; ?>" data-name="<?php echo $user['name']; ?>" data-group="<?php echo $user['is_group']; ?>" href="">
            <div class="users-left">
                <?php if($user['img'] != '' && file_exists('./uploads/users/'.$user['gu_id'].'/'.$user['img'])){ ?>
                    <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user['gu_id'].'/'.$user['img']; ?>" alt="">
                <?php }else{ ?>
                    <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                <?php } ?>
            </div>
            <div class="users-right">
                <span class="usr-name"><?php echo $user['name']; ?></span><br>
                <span class="usr-time pull-right">
                                                <?php if(date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($user['datetime']))){
                                                    echo date('H:i A', strtotime($user['datetime']));
                                                }else {
                                                    echo date('M d, y', strtotime($user['datetime']));
                                                }
                                                ?>
                                            </span>
                <span class="usr-msg">
                                                <?php if($user['message'] != '') {
                                                    if($_SESSION['user_id'] == $user['sender']){
                                                        echo 'Me: '.$user['message'];
                                                    }else {
                                                        echo $user['message'];
                                                    }
                                                }else{
                                                    echo '<i class="icon-attachment"></i>'.$user['file'];
                                                }?>
                                            </span>
            </div>
            <div class="clearfix"></div>
        </a>
    </li>
<?php } } ?>