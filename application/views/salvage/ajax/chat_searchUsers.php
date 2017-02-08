<?php if(!empty($recent)){
    foreach ($recent as $user){ ?>
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
                <span class="usr-time pull-right"></span>
                <span class="usr-msg"><br></span>
            </div>
            <div class="clearfix"></div>
        </a>
    </li>
<?php }
}else{ ?>
    <li class="no_results">No Results Found.</li>
<?php }  ?>