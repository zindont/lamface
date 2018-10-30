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
	<div class="box-body">
		<!-- Conversations are loaded here -->
		<div class="direct-chat-messages">
			<!-- Message. Default to the left -->
			<div class="direct-chat-msg">
				<div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left">Alexander Pierce</span>
					<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
				</div>
				<!-- /.direct-chat-info -->
				<img class="direct-chat-img" src="/img/broken.png" alt="message user image">
				<!-- /.direct-chat-img -->
				<div class="direct-chat-text">
					Is this template really for free? That's unbelievable!
				</div>
				<!-- /.direct-chat-text -->
			</div>
			<!-- /.direct-chat-msg -->
		</div>
		<!--/.direct-chat-messages-->
	</div>
	<!-- /.box-body -->	
</div>