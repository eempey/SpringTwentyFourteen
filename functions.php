<?php 

//Register the Menus
register_nav_menus( array(
	'header-menu' => 'Header Menu',
	'social-media-icons' => 'Social Media Menu'
) );


add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

//register javascripts
function spring_scripts_with_jquery()  
	{  
		// Register the script like this for a theme:  
		wp_register_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array( 'jquery' ) );  
  		wp_register_script( 'bootstrap-dropdown-hover', get_template_directory_uri().'/js/bootstrap-hover-dropdown.js', array( 'jquery', 'bootstrap') );
		// For either a plugin or a theme, you can then enqueue the script:  
		wp_enqueue_script( 'bootstrap' );  
		wp_enqueue_script( 'bootstrap-dropdown-hover' );
}  
add_action( 'wp_enqueue_scripts', 'spring_scripts_with_jquery' );  

add_theme_support( 'custom-background' );


register_sidebar( array('name' => 'Right Sidebar' ));
register_sidebar( array('name' => 'Footer Widgets' ));

?>