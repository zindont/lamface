<?php 
/**
 * Adds Foo_Widget widget.
 */
class Codestar_Lamface_System_Histories_Widgets extends WP_Widget {

	const DEFAULT_NUM_OF_ROWS = 3;
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'codestar_lamface_system_histories', // Base ID
			esc_html__( 'Lamface System Histories', 'codestar_lamface' ), // Name
			array( 'description' => esc_html__( 'System Histories Widget', 'codestar_lamface' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Pass a variable to get_template_part
		set_query_var('args', $args);
		set_query_var('instance', $instance);
		
		get_template_part( 'inc/codestar/templates/widgets/widget', 'system_histories' );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$numOfRows = ! empty( $instance['numOfRows'] ) ? $instance['numOfRows'] : self::DEFAULT_NUM_OF_ROWS;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Tiêu đề:', 'codestar_lamface' ); ?>
			</label>
			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
				type="text" 
				value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'numOfRows' ) ); ?>">
				<?php esc_attr_e( 'Số lượng row cần lấy:', 'codestar_lamface' ); ?>
			</label>
			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'numOfRows' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'numOfRows' ) ); ?>" 
				type="number" 
				value="<?php echo esc_attr( $numOfRows ); ?>">
		</p>		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['numOfRows'] = ( ! empty( $new_instance['numOfRows'] ) ) ? sanitize_text_field( $new_instance['numOfRows'] ) : self::DEFAULT_NUM_OF_ROWS;

		return $instance;
	}

}