<?php

/**
 * Layers Child Theme Custom Functions
 * Replace layers_child in examples with your own child theme name!
**/


/**
 * Localize
 * Since 1.0
 */
 if( ! function_exists( 'layers_child_localize' ) ) {
	 
	add_action('after_setup_theme', 'layers_child_localize');

	function layers_child_localize(){
		load_child_theme_textdomain( 'layers-child' , get_stylesheet_directory().'/languages');
	}
 }

/* Add an extra Google Font (hosted) 
* * http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
* Since 1.0
*/
if( ! function_exists( 'layers_child_font_url' ) ) {	
	
	function layers_child_font_url() {
		$fonts_url = '';
	 
		/* Translators: If there are characters in your language that are not
		* supported by Lora, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$lora = _x( 'on', 'Lora font: on or off', 'layers-child' );
	    $raleway = _x( 'on', 'Raleway font: on or off', 'layers-child' );
		
		if ( 'off' !== $lora || 'off' !== $raleway ) {
			$font_families = array();
	 
			if ( 'off' !== $lora ) {
				$font_families[] = 'Lora:400,700,400italic';
			}
			if ( 'off' !== $raleway ) {
				$font_families[] = 'Raleway:400,700,400italic';
			}
	 
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
	 
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
	 
		return $fonts_url;
	}
	
}

 /* Enqueue Child Theme Scripts & Styles 
 ** http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * Since 1.0
 */
 
add_action( 'wp_enqueue_scripts', 'layers_child_styles' );	

if( ! function_exists( 'layers_child_styles' ) ) {	

	function layers_child_styles() {
		
		// Load our custom font
		wp_enqueue_style(
			'layers-child' . '-font',
			layers_child_font_url(), //Refer to line 63
			array()
		); // Lora Font
					
		wp_enqueue_style(
			'layers-parent-style',
			get_template_directory_uri() . '/style.css',
			array()
		); // Typography

		
	}
	
}
if( ! function_exists( 'layers_child_scripts' ) ) {
		
	function layers_child_scripts() {
		
		wp_enqueue_script(
			'layers-child' . '-custom',
			get_stylesheet_directory() . '/assets/js/theme.js',
			array(
				'jquery', // make sure this only loads if jQuery has loaded
			)
		); // Custom Child Theme jQuery  
		
	}
	
}
// Output this in the footer before anything else
// http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
add_action('wp_enqueue_scripts', 'layers_child_scripts'); 
 
/**
 * Set the post editor content width based on the theme's design and stylesheet.
 * Since 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* pixels */
}

/**
 * Adjust the post editor content width when the full width page template is being used
 * Filter existing function to replace with our code
 */
if( ! function_exists( 'layers_child_set_content_width' ) ) {	

	 add_filter( 'layers_set_content_width', 'layers_child_set_content_width', 2, 2 );
	
	 function layers_child_set_content_width() {
		global $content_width;
	
		if ( is_page_template( 'full-width.php' ) ) {
			$content_width = 1120;
		} elseif( is_singular() ) {
			$content_width = 720;
		}
	 }
 
}

 /* Add Excerpt Support for Pages 
 ** http://codex.wordpress.org/Function_Reference/add_post_type_support
 * Since 1.0 
 */
 if( ! function_exists( 'layers_child_add_excerpts_to_pages' ) ) {	
 
 	add_action( 'init', 'layers_child_add_excerpts_to_pages' );
 
	function layers_child_add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	
 }


 /**
 * Add the title banner to all builder pages other than home
 ** http://codex.oboxsites.com/reference/before_layers_builder_widgets/
 * Since 1.0
 */
 add_action('layers_after_builder_widgets', 'layers_child_builder_title');
 if(! function_exists( 'layers_child_builder_title' )) {	
		
	function layers_child_builder_title() {
	  if(!is_front_page()) {
		get_template_part( 'partials/header' , 'page-title' );
	  }
	}
	
 }