<!--<ul id="regularUsersList" class="media-list">-->
    <li data-id="0" class="<?php echo ($active == 0?'active':''); ?> media">
        <div class="media-left">
            <?php if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){ ?>
                <img class="img-circle img-sm" src="<?php echo BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img; ?>" alt="">
            <?php }else{ ?>
                <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
            <?php } ?>
<!--            <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-sm img-circle" alt="">-->
            <!--                                        <span class="badge bg-danger-400 media-badge">5</span>-->
        </div>
        <?php $allLast = $this->Discussion_model->getLastOfProjectall($project->project_id); ?>
        <div class="media-body">
            <a href="#" class="media-heading">
                <span class="text-semibold uname">All Users</span>
                <span class="media-annotation pull-right"><?php echo date('H:i A',strtotime($allLast['datetime'])); ?></span>
            </a>
            <span class="text-muted"><?php print_r($allLast['message']);  ?></span>
        </div>
    </li>
    <?php
    if(!empty($pusers)){  foreach ($pusers as $pusr){ ?>
        <li data-id="<?php echo $pusr['user_id']; ?>" class="<?php echo ($active == $pusr['user_id']?'active':''); ?> media">
            <div class="media-left">
                <?php if($pusr['profile_img'] != '' && file_exists('./uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img'])){ ?>
                    <img class="img-circle img-sm" src="<?php echo BASE.'uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img']; ?>" alt="">
                <?php }else{ ?>
                    <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                <?php } ?>
<!--                <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-sm img-circle" alt="">-->
                <?php if($pusr['unread'] > 0){ ?>
                <span class="badge bg-warning-400 media-badge"><?php echo $pusr['unread']; ?></span>
                <?php } ?>
            </div>
            <div class="media-body">
                <a href="#" class="media-heading">
                    <span class="uname text-semibold"><?php echo $pusr['first_name'].' '.$pusr['last_name']; ?></span>
                    <span class="media-annotation pull-right"><?php echo date('H:i A',strtotime($pusr['datetime'])); ?></span>
                </a>
                <span class="text-muted"><?php echo $pusr['message']; ?></span>
            </div>
        </li>
    <?php }} ?>
<!--</ul>-->