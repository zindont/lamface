<?php
	global $wp_query;

	extract( $wp_query->query_vars );
	
	if ( empty( $instance['title'] ) ) {
		$instance['title'] = __( 'Nhật ký hệ thống', 'codestar_lamface' );
	}

	// echo $args['before_widget'];
	// if ( ! empty( $instance['title'] ) ) {
	// 	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	// }
	// echo esc_html__( 'Hello, World!', 'text_domain' );
	// echo $args['after_widget'];
?>
<div class="col-xs-12">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
				</button>
			</div>
		</div>
		<!-- /.box-header -->
	</div>
</div>