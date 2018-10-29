<?php 

/**
 * Codestar_Lamface_Widgets.class.php
 * @author info@zindo.info
 */
class Codestar_Lamface_Widgets
{
	function __construct()	{
		// Require first
		require_once get_template_directory() . '/inc/codestar/widgets/Codestar_Lamface_System_Histories_Widgets.class.php';

		// Init the Widget
		$this->init();
	}

	public function init()	{
		register_widget( 'Codestar_Lamface_System_Histories_Widgets' );
	}
}