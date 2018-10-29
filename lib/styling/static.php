<?php

class StaticCss {
	
	public $scss;
	
	function __construct() {
		/* scss */
		$this->scss = new scssc();
		
		/* set paths scss */
		$this->scss->setImportPaths( get_template_directory() . '/assets/scss/' );
		
		/* generate css over time */
		
		$this->generate_file();
	}
	
	/**
	 * generate css file.
	 */
	public function generate_file() {
		global $wp_filesystem;
		
		if ( ! empty( $wp_filesystem ) ) {
			
			$chmod_dir = ( 0755 & ~umask() );
			if ( defined( 'FS_CHMOD_DIR' ) ) {
				$chmod_dir = FS_CHMOD_DIR;
			}
			
			/* minimize CSS styles */
			$this->scss->setFormatter( 'scss_formatter_compressed' );
			
			/* compile scss to css */
			$css = $this->scss_render();
			
			$file = "lamface.css";
			
			$file = get_template_directory() . '/assets/css/' . $file;
			
			/* delete files static.css */
			$wp_filesystem->delete( $file );
			
			/* write static.css file */
			$wp_filesystem->put_contents( $file, $css, $chmod_dir ); // Save it
		}
	}
	
	/**
	 * scss compile
	 */
	public function scss_render() {
		/* compile scss to css */
		return $this->scss->compile( '@import "lamface.scss"' );
	}
	
}

new StaticCss();
