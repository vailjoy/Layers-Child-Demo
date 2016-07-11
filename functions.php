<?php
/**
 * Layers Child Theme Custom Functions
 * Replace layers_child in examples with your own child theme slug!
 * http://docs.layerswp.com/child-theme-setup/
**/
require_once get_stylesheet_directory() . '/includes/presets.php' ;
require_once get_stylesheet_directory() . '/includes/custom-meta.php' ;

/**
 * Localize
 * Since 1.0
 */
 if( ! function_exists( 'layers_child_localize' ) ) {
	 
	add_action('after_setup_theme', 'layers_child_localize');

	function layers_child_localize(){
		load_child_theme_textdomain( 'layers-child-demo' , get_stylesheet_directory().'/languages');
	}
 }

/* Set Font and Theme Defaults
** http://docs.layerswp.com/reference/layers_customizer_defaults/
* Since 1.0
*/
add_filter( 'layers_customizer_control_defaults', 'layers_child_customizer_defaults' );

function layers_child_customizer_defaults( $defaults ){

 $defaults = array(
       'body-fonts' => 'Lato',
       'form-fonts' => 'Lato',
       'header-menu-layout' => 'header-logo-left',
       'header-background-color' => '',
       'header-width' => 'layout-boxed',
       'header-sticky' => '1',
	   'header-overlay' => '1',
       'heading-fonts' => 'Mandali',
       'footer-sidebar-count' => '0',
	   'footer-background-color' => '#333333',
	   'footer-link-color' => '#FFF',
	   'footer-body-color' => '#FFF'
 );

 return $defaults;
}

 /* Enqueue Child Theme Scripts & Styles 
 ** http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * Since 1.0
 */
 
add_action( 'wp_enqueue_scripts', 'layers_child_styles' );	

if( ! function_exists( 'layers_child_styles' ) ) {	

	function layers_child_styles() {	
					
		wp_enqueue_style(
			'layers-parent-style',
			get_template_directory_uri() . '/style.css',
			array()
		); // Parent Stylsheet for Version info

		
	}
	
}
if( ! function_exists( 'layers_child_scripts' ) ) {
		
	function layers_child_scripts() {
		
		wp_enqueue_script(
			'layers-child-demo' . '-custom',
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
 * Adjust the post editor content width when the full width page template is being used
 * Filter existing function to replace with our code
 */
add_filter( 'layers_set_content_width', 'layers_child_set_content_width', 2, 2 );
if( ! function_exists( 'layers_child_set_content_width' ) ) {	
	 function layers_child_set_content_width() {
		global $content_width;
	
		if ( is_page_template( 'full-width.php' ) ) {
			$content_width = 1120; // pixels
		} elseif( is_singular() ) {
			$content_width = 720; //pixels
		}
	 }
 
}

/**
* Add Sub Menu Page to the Layers Menu Item
* http://docs.layerswp.com/how-to-add-help-pages-onboarding-to-layers-themes-or-extensions/
*/
if( ! function_exists('register_layers_child_submenu_page') ) {
	function register_layers_child_submenu_page(){
		add_submenu_page(
			'layers-dashboard',
			__( 'Layers Child Help' , 'layers-child-demo'  ),
			__( 'Layers Child Help' , 'layers-child-demo'  ),
			'edit_theme_options',			
			'layers-child-get-started',
			'get_child_onboarding'
			
		);
	}
}
function get_child_onboarding(){
	require_once get_stylesheet_directory() . '/includes/theme-help.php';
}
add_action('admin_menu', 'register_layers_child_submenu_page', 60);

/**
* Welcome Redirect
* http://docs.layerswp.com/how-to-add-help-pages-onboarding-to-layers-themes-or-extensions/
*/
function layers_child_setup(){
	if( isset($_GET["activated"]) && $pagenow = "themes.php" ) { //&& '' == get_option( 'layers_welcome' )
		update_option( 'layers_welcome' , 1);
		wp_safe_redirect( admin_url('admin.php?page=layers-child-get-started'));
	}
}
add_action( 'after_setup_theme' , 'layers_child_setup', 20 );

/* Demo Custom function: Add Excerpt Support for Pages 
** http://codex.wordpress.org/Function_Reference/add_post_type_support
* Since 1.0 
*/
add_action( 'init', 'layers_child_add_excerpts_to_pages' );

if( ! function_exists( 'layers_child_add_excerpts_to_pages' ) ) {	
	function layers_child_add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}	
 }


/**
 * Hooking Layers: Add the title banner to all builder pages other than home
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

/**
 * Customize list post meta to show author and date above the excerpt
 ** http://docs.layerswp.com/reference/layers_before_…t_post_content/
 * Since 1.0
*/
 
add_action('layers_before_list_post_content', 'my_list_author');

if(! function_exists('my_list_author') ) {
    function my_list_author() { 
     layers_post_meta( get_the_ID(), array( 'author', 'date' ) , 'h5', 'meta-info' );
    }
}
