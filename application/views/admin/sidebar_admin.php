<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="<?php echo BASE; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"><?php echo ($user_det->first_name == ''?$user_det->email : $user_det->first_name.' '.$user_det->last_name); ?></span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-user text-size-small"></i> &nbsp;<?php echo $user_det->name; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <?php
                    $mparent = $this->uri->segment(1);
                    $mchild = $this->uri->segment(2);
                    ?>
                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="<?php echo ($mparent == 'dashboard')?'active':''; ?>"><a href="<?php echo BASE; ?>dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li class="<?php echo ($mparent == 'projects')?'active':''; ?>">
                        <a href="#"><i class="icon-stack2"></i> <span>Projects</span></a>
                        <ul>
                            <li class="<?php echo ($mparent == 'projects' && $mchild == '')?'active':''; ?>"><a href="<?php echo BASE; ?>projects">All Projects</a></li>
                            <li class="<?php echo ($mparent == 'projects' && $mchild == 'add')?'active':''; ?>"><a href="<?php echo BASE; ?>projects/add">Add New Project</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($mparent == 'users')?'active':''; ?>">
                        <a href="#"><i class="icon-user-plus"></i> <span>Users</span></a>
                        <ul>
                            <li class="<?php echo ($mparent == 'users' && $mchild == '')?'active':''; ?>"><a href="<?php echo BASE; ?>users">All Users</a></li>
                            <li class="<?php echo ($mparent == 'users' && $mchild == 'add')?'active':''; ?>"><a href="<?php echo BASE; ?>users/add">Add New User</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($mparent == 'roles')?'active':''; ?>">
                        <a href="#"><i class="icon-user-plus"></i> <span>User Roles</span></a>
                        <ul>
                            <li class="<?php echo ($mparent == 'roles' && $mchild == '')?'active':''; ?>"><a href="<?php echo BASE; ?>roles">All Roles</a></li>
                            <li class="<?php echo ($mparent == 'roles' && $mchild == 'add')?'active':''; ?>"><a href="<?php echo BASE; ?>roles/add">Add New Role</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->