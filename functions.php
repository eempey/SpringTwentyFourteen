<?php 

//Register the Main menu
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' ); 


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



?>