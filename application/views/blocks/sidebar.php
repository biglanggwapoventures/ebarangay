<?php $url = base_url(); ?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/img/display-photo-placeholder.png') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= user_id_number() ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for activities...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->
            
            <li class="<?= $active_nav ===  NAV_HOME ? 'active' : '' ?>">
                <a href="<?= "{$url}home" ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            
            <?php if(user_has_access_to(MODULE_ITEM_DATA)):?>
            <li class="<?= $active_nav === NAV_ITEMS ? 'active' : '' ?>">
                <a href="<?= "{$url}items" ?>"><i class="fa fa-cubes"></i> <span>Items</span></a>
            </li>
            <?php endif; ?>

            <?php if(user_has_access_to(MODULE_BORROW_REQUESTS)):?>
            <li class="<?= $active_nav === NAV_REQUESTS ? 'active' : '' ?>">
                <a href="<?= "{$url}borrow_requests" ?>"><i class="fa fa-edit"></i> <span>Borrow Requests</span></a>
            </li>
            <?php endif; ?>

             <?php if(user_has_access_to(MODULE_ITEM_MAINTENANCE)):?>
             <li class="<?= $active_nav === NAV_ITEM_MAINTENANCE ? 'active' : '' ?>">
                <a href="<?= "{$url}borrow_requests" ?>"><i class="fa fa-tachometer"></i> <span>Item Maintenance</span></a>
            </li>
             <?php endif; ?>

             <?php if(user_has_access_to(MODULE_ITEM_ADJUSTMENTS)):?>
             <li class="<?= $active_nav === NAV_QTY_ADJUSTMENTS ? 'active' : '' ?>">
                <a href="<?= "{$url}borrow_requests" ?>"><i class="fa fa-balance-scale"></i> <span>Item Adjustments</span></a>
            </li>
             <?php endif; ?>

             <?php if(user_has_access_to(MODULE_USERS)):?>
            <li class="<?= $active_nav === NAV_USERS ? 'active' : '' ?>">
                <a href="<?= "{$url}users" ?>"><i class="fa fa-users"></i> <span>Users</span></a>
            </li>
             <?php endif; ?>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>