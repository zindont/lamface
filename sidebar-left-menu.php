<?php 
if ( ! defined( 'ABSPATH' ) )
     exit;
global $current_user;
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <?php if (is_user_logged_in()): ?>
        <div class="user-panel">
            <div class="pull-left image">
                <?php echo get_avatar( 
                    $current_user, 
                    false, 
                    '', 
                    __( 'Ảnh đại diện', 'codestar_lamface' ),
                    array(
                        'class' => 'img-circle'
                    ) 
                ) ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $current_user->get('user_nicename') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>        
    <?php endif ?>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="s" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php 
    /*wp_nav_menu(array(
        'theme_location' => 'left-menu',
        'container' => '',
        'items_wrap' => '<ul id="%1$s" class="%2$s sidebar-menu tree" data-widget="tree"><li class="header">MAIN NAVIGATION</li>%3$s</ul>',
        'link_before' => '<i class="fa fa-calendar"></i>',
        'link_after' => '<span class="pull-right-container"><small class="label pull-right bg-red">0</small></span>',
        'walker' => new Codestar_Adminlte_Walker()
    ));*/
    ?>

    <!-- static menu -->
    <ul id="menu-main-menu" class="menu sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="/tat-ca-danh-muc/">
                <i class="fa fa-calendar"></i>
                Danh sách content
                <span class="pull-right-container"><small class="label pull-right bg-red"><?php echo Codestar_Lamface_Base::codestar_get_total_posts();?></small></span>
            </a>
        </li>
        <li>
            <a href="/danh-sach-fanpage/">
                <i class="fa fa-calendar"></i>
                Danh sách fanpage
                <span class="pull-right-container"><small class="label pull-right bg-green"><?php echo Codestar_Lamface_Base::codestar_get_total_fanpages();?></small></span>
            </a>
        </li>
        
        <?php if (is_user_logged_in()): ?>
            <li>
                <a href="/mau-quang-cao-da-luu/">
                    <i class="fa fa-calendar"></i>
                    Content đã lưu
                    <span class="pull-right-container"><small class="label pull-right bg-red"><?php echo Codestar_Lamface_Base::codestar_get_total_saved_posts(get_current_user_id()); ?></small></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Content đã tạo
                    <span class="pull-right-container"><small class="label pull-right bg-red">0</small></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Content đang bán
                    <span class="pull-right-container"><small class="label pull-right bg-red">0</small></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Fanpage đã lưu
                    <span class="pull-right-container"><small class="label pull-right bg-green"><?php echo Codestar_Lamface_Base::codestar_get_total_saved_pages(get_current_user_id()); ?></small></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Fanpage của bạn
                    <span class="pull-right-container"><small class="label pull-right bg-green">0</small></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Thành viên
                    <span class="pull-right-container"><small class="label pull-right bg-yellow"><?php $count_users = count_users(); echo $count_users['total_users']?></small></span>
                </a>
            </li>
        <?php endif ?>
        <li>
            <a href="#">
                <i class="fa fa-calendar"></i>
                Xu hướng tuần này
                <span class="pull-right-container"><small class="label pull-right bg-blue">0</small></span>
            </a>
        </li>
    </ul>
</section>
<!-- /.sidebar -->