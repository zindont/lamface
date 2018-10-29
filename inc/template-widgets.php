<?php 
class lamface_Custom_Categories extends WP_Widget {
  /**
  * To create the example widget all four methods will be 
  * nested inside this single instance of the WP_Widget class.
  **/
	public function __construct() {
		$widget_options = array( 
		  'classname' => 'lamface-custom-categories',
		  'description' => 'Custom categories for lamface\'s site menu ',
		  'customize_selective_refresh' => true,
		);
		parent::__construct( 'lamface_custom_categories', 'Lamface Custom Categories', $widget_options );
	}

	public function widget( $args, $instance ) {		
		$title 		= apply_filters( 'widget_title', $instance[ 'title' ] );
		$content	= apply_filters( 'widget_editor', $instance[ 'editor' ] );
		$unique		= str_replace( array( '[', ']', '_title' ), array( '_', '', '' ), $this->get_field_name( 'title' ) );
		//$blog_title = get_bloginfo( 'name' );
		//$tagline 	= get_bloginfo( 'description' );
		echo str_replace( 'class="', 'class="lamface-custom-categories-widget ' . $unique . ' ', $args['before_widget'] ) . $args['before_title'] . $title . $args['after_title']; ?>
		<div class="extends"><i class="fa fa-plus-circle"></i></div>

		<div class="widget-content">
			<?php echo( $content ); ?>
		</div><!-- #widget-content -->

		<script>
			var w_c_element = $('.<?php echo $unique; ?> .widget-content');
			$('.<?php echo $unique; ?> .extends i').click(function (e) {
				console.log('asds');
				if (w_c_element.css('display') == 'none') {
				    w_c_element.show();
				}
				else {
					w_c_element.hide();
				}
			});
		</script>

		<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		//wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
		$title 		= ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		$content 	= ! empty( $instance['editor'] ) ? $instance['editor'] : ''; $rndNumber = rand( 11111, 99999 ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat title" />
		</p>
		<p id="wrap-<?= $rndNumber ?>">
			<textarea class="<?php echo $this->get_field_id( 'editor' ); ?>" contenteditable="true" id="editor-<?= $rndNumber ?>" name="<?php echo $this->get_field_name( 'editor' ); ?>"><?php echo esc_attr( $content ); ?></textarea>
		</p>
		<script src="<?= get_template_directory_uri() ?>/plugins/trumbowyg/dist/trumbowyg.js"></script>
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/plugins/trumbowyg/dist/ui/trumbowyg.css">

		<script>
			$('#editor-<?= $rndNumber ?>').trumbowyg({
				btns: [
					['strong', 'em', 'del'],
					['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
					['unorderedList', 'orderedList'],
					['link'],
					['viewHTML'],
				],
				autogrow: true
			});
			
		</script>

		<?php 

		/*** ADD: Editor for widget ***/
		/*
	    $content   	= ! empty( $instance['widget_editor'] ) ? $instance['widget_editor'] : 'Enter your content in here !';
	    $editor_id 	= $this->get_field_id( 'widget_editor' );
	    $textarea_name
	    			= $this->get_field_name( 'widget_editor' );

	    $settings = array(
	        'media_buttons' => true,
	        'textarea_rows' => 5,
	        //'teeny'         => false,
	        'tinymce'       => array(
		        //'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo',
		        //'toolbar2'      => '',
		        //'toolbar3'      => '',
		        'toolbar1'      => 'bold,italic,numlist,bullist,link,unlink',
		    ),
		    //'quicktags' => array( 'buttons' => 'strong,em,del,ul,ol,li,close' ),
		    'textarea_name' => $textarea_name,
		    'editor_class'	=> 'widefat text wp-editor-area'
	    );

	    wp_editor( esc_attr( $content ), $editor_id, $settings );
		/*** END: Editor for widget  ***/

		echo('<br/>');
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] 	= strip_tags( $new_instance[ 'title' ] );
		$instance[ 'editor' ] 
								= $new_instance[ 'editor' ];
		return $instance;
	}
}

function lamface_register_customize_widgets() { 
	register_widget( 'lamface_Custom_Categories' );
}
add_action( 'widgets_init', 'lamface_register_customize_widgets' );
?>