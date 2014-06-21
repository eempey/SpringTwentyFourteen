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

//Kill Woocommerce styles
define('WOOCOMMERCE_USE_CSS', false);


//then add my own
function theme_enqueue_styles() {
    wp_enqueue_style('woocommerce-layout', get_stylesheet_directory_uri().'/woocommerce/css/woocommerce-layout.css');
    wp_enqueue_style('woocommerce-smallscreen', get_stylesheet_directory_uri().'/woocommerce/css/woocommerce-smallscreen.css','','','only screen and (max-width: 768px)');
    wp_enqueue_style('woocommerce-custom', get_stylesheet_directory_uri().'/woocommerce/css/woocommerce.css');
    //I'll handle the styling for Jetpack's Grunion Contact Form:
    wp_deregister_style('grunion.css');
}

add_action('init', 'theme_enqueue_styles');

//register javascripts please
function spring_scripts_with_jquery()  {  
	if ( !is_admin() ) {
    	// Register the script like this for a theme:  
		wp_register_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array( 'jquery' ) );  
  		wp_register_script( 'bootstrap-dropdown-hover', get_template_directory_uri().'/js/bootstrap-hover-dropdown.js', array( 'jquery', 'bootstrap') );
        //wp_register_script( 'erin', get_template_directory_uri().'/js/erin.js', array( 'jquery'),'',true );
		
        // For either a plugin or a theme, you can then enqueue the script:   
        wp_enqueue_script( 'bootstrap' );  
		wp_enqueue_script( 'bootstrap-dropdown-hover' );
        /*if ( is_page('Contact') ){
            wp_enqueue_script( 'erin' ); 
        }*/
    } 
}  
add_action( 'wp_enqueue_scripts', 'spring_scripts_with_jquery' );  


//change the custom background please. Make it deliver different image sizes according to the screen size

add_theme_support( 'custom-background');  



register_sidebar( array('name' => 'Right-Sidebar' ));
register_sidebar( array('name' => 'Footer Widgets' ));


?>