<?php 
if ( ! defined( 'ABSPATH' ) )
     exit;

global $current_user, $wp_roles;

$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
?>

<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php echo get_avatar( 
            $current_user, 
            false, 
            '', 
            __( 'Ảnh đại diện', 'codestar_lamface' ),
            array(
                'class' => 'user-image'
            ) 
        ) ?>
        <span class="hidden-xs"><?php echo $current_user->get('user_nicename') ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">

            <?php echo get_avatar( 
                $current_user, 
                false, 
                '', 
                __( 'Ảnh đại diện', 'codestar_lamface' ),
                array(
                    'class' => 'img-circle'
                ) 
            ) ?>
            <p>
                <?php echo $current_user->get('user_nicename') ?>
                <small>
                    <?php printf( __('Thành viên từ %s ', 'codestar_lamface'), 
                        date( 
                            "d/m/Y", 
                            strtotime( $current_user->get('user_registered') ) 
                        )
                    ) ?></small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat"><?php echo __('Tài khoản', 'codestar_lamface') ?></a>
            </div>
            <div class="pull-right">
                <a href="<?php echo wp_logout_url() ?>" class="btn btn-default btn-flat"><?php echo __('Đăng xuất', 'codestar_lamface') ?></a>
            </div>
        </li>
    </ul>
</li>