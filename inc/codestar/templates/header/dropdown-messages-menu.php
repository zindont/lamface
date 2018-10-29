<?php 
if ( ! defined( 'ABSPATH' ) )
     exit;

global $current_user;
?>
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success">4</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">Bán có 4 tin nhắn</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li>
                    <!-- start message -->
                    <a href="#">
                        <div class="pull-left">
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
                        <h4>Lamface Team <small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
                        <p>Nội dung đang cập nhật</p>
                    </a>
                </li>
                <!-- end message -->
            </ul>
        </li>
        <li class="footer"><a href="#">Xem tất cả</a></li>
    </ul>
</li>