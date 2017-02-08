<ul class="media-list">
    <?php
    if(!empty($pusers)){
        foreach ($pusers as $pusr){ ?>
        <li data-id="<?php echo $pusr['user_id']; ?>" class="media">
            <div class="media-left">
                <?php if($pusr['profile_img'] != '' && file_exists('./uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img'])){ ?>
                    <img class="img-circle img-sm" src="<?php echo BASE.'uploads/users/'.$pusr['user_id'].'/'.$pusr['profile_img']; ?>" alt="">
                <?php }else{ ?>
                    <img class="img-circle img-sm" src="<?php echo BASE; ?>assets/images/placeholder.jpg" alt="">
                <?php } ?>
<!--                <img src="--><?php //echo BASE; ?><!--assets/images/placeholder.jpg" class="img-sm img-circle" alt="">-->
                <!--                                        <span class="badge bg-danger-400 media-badge">5</span>-->
            </div>
            <div class="media-body">
                <a href="#" class="media-heading">
                    <span class="uname text-semibold"><?php echo $pusr['first_name'].' '.$pusr['last_name']; ?></span>
                    <span class="media-annotation pull-right"><?php echo date('H:i A',strtotime($pusr['datetime'])); ?></span>
                </a>
                <span class="text-muted"><?php echo $pusr['message']; ?></span>
            </div>
        </li>
    <?php }
    }else{ ?>
        <li>No Results Found</li>
    <?php } ?>
</ul>