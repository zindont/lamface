<?php
	if (! defined('LF_SYSTEM_HISTORIES')) {
		// Something wrong
		return;
	}

	global $wp_query, $wpdb, $table_prefix;

	extract( $wp_query->query_vars );
	
	if ( empty( $instance['title'] ) ) {
		$instance['title'] = __( 'Nhật ký hệ thống', 'codestar_lamface' );
	}
	
	$table_name = $table_prefix . LF_SYSTEM_HISTORIES;

	$histories = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY fired_time DESC LIMIT {$instance['numOfRows']}" );
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
		<div class="direct-chat-messages direct-chat-success">
			<?php foreach ($histories as $key => $record): ?>
				<?php 
					$externalClasses = array();
					if ($key % 2 != 0) {
						$externalClasses[] = 'right';
					}

					$target_image = '/img/broken.png';
					if (!empty($record->target_image)) {
						$target_image = $record->target_image;
					}
				?>
				<!-- Message. Default to the left -->
				<div class="direct-chat-msg <?php esc_attr_e( implode(' ', $externalClasses) ); ?>">
					<div class="direct-chat-info clearfix">
						<?php if ($key % 2 == 0): ?>
							<span class="direct-chat-name pull-left"><?php echo $record->target_name ?></span>
							<span class="direct-chat-timestamp pull-right"><?php echo $record->fired_time ?></span>
						<?php else: ?>
							<span class="direct-chat-name pull-right"><?php echo $record->target_name ?></span>
							<span class="direct-chat-timestamp pull-left"><?php echo $record->fired_time ?></span>
						<?php endif ?>

					</div>
					<!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="<?php echo $target_image ?>" alt="message user image">
					<!-- /.direct-chat-img -->
					<div class="direct-chat-text">
						<?php echo $record->target_message ?>
					</div>
					<!-- /.direct-chat-text -->
				</div>
				<!-- /.direct-chat-msg -->
			<?php endforeach ?>
		</div>
		<!--/.direct-chat-messages-->	
	</div>
	<!-- /.box-body -->	
</div>