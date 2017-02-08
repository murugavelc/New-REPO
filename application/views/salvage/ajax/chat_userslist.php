
            <?php foreach ($users as $user){ ?>
                <li class="<?php if($user->user_id == $input['uid'] && $input['group'] == 0){ echo 'active'; }?>">
                    <a data-id="<?php echo $user->user_id; ?>" data-name="<?php echo $user->first_name.' '.$user->last_name; ?>"  href="">
                        <div class="users-left">
                            <?php if($user->profile_img != '' && file_exists('./uploads/users/'.$user->user_id.'/'.$user->profile_img)){ ?>
                                <img id="blah" class="img-responsive img-circle" src="<?php echo BASE.'uploads/users/'.$user->user_id.'/'.$user->profile_img; ?>" alt="">
                            <?php }else{ ?>
                                <img id="blah" class="img-responsive img-circle" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                            <?php } ?>
                        </div>
                        <div class="users-right">
                            <span class="usr-name"><?php echo $user->first_name.' '.$user->last_name; ?></span><br>
                            <span class="usr-time pull-right">
                                                            <?php if($user->datetime ==''){
                                                                echo '';
                                                            }elseif(date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($user->datetime))){
                                                                echo date('H:i A', strtotime($user->datetime));
                                                            }else {
                                                                echo date('M d, y', strtotime($user->datetime));
                                                            }
                                                            ?>
                                                        </span>
                            <span class="usr-msg">
                                                            <?php if($user->message == '' && $user->file != '') {
                                                                echo '<i class="icon-attachment"></i>'.$user->file;
                                                            }elseif($user->message != ''){
                                                                if($_SESSION['user_id'] == $user->sender){
                                                                    echo 'Me: '.$user->message;
                                                                }else {
                                                                    echo $user->message;
                                                                }
                                                            }else{
                                                                echo '<br>';
                                                            }?>
                                                        </span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
            <?php } ?>
