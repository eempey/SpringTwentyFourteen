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

//register javascripts please
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


//change the custom background please. Make it deliver different image sizes according to the screen size
function responsive_custom_background_cb() {  
    $background = get_background_image();  
    $color = get_background_color();  
  
    if ( ! $background && ! $color )  
        return;  
  
    $style = $color ? "background-color: #$color;" : '';  
  
    if ( $background ) {  
        $image = " background-image: url('$background');";  
  
        $repeat = get_theme_mod( 'background_repeat', 'repeat' );  
  
        if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )  
            $repeat = 'repeat';  
  
        $repeat = " background-repeat: $repeat;";  
  
        $position = get_theme_mod( 'background_position_x', 'left' );  
  
        if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )  
            $position = 'left';  
  
        $position = " background-position: top $position;";  
  
        $attachment = get_theme_mod( 'background_attachment', 'scroll' );  
  
        if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )  
            $attachment = 'scroll';  
  
        $attachment = " background-attachment: $attachment;";  
  
        $style .= $repeat . $position . $attachment;  
    }  
?>  
<style type="text/css">  
    body.custom-background { <?php echo trim( $style ); ?> }  
</style> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
        if(window.screen.width > 900){
            $('body.custom-background').css('background-image', <?php echo "'url(".$background.")'" ?> );
        }
        
    });
    
<?php $background_query = new WP_Query(array(
    'post_type' => 'attachment',
    'post_status'=>'inherit', //because attachments don't have the post status "publish", you need this line
    'meta_query' => array(
                     array(
                      'key' => '_wp_attachment_context',
                      'value' => 'custom-background'
                      )
                    )
     //Other query properties
));


if($background_query->have_posts()) :
    echo '<ul>'; 
     while ($background_query->have_posts()) : $background_query->the_post(); global $post; 
        echo '<li>' . get_the_title() . '</li>';
     endwhile; 
     echo '</ul>';
 endif; 

/*if ( $background_query->have_posts() ) {
        echo '<ul>';
    while ( $background_query->have_posts() ) {
        $background_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }
        echo '</ul>';
} else {
    echo "no posts :(";
}*/
/* Restore original Post Data */
/*wp_reset_postdata();*/



echo "/*".wp_get_attachment_image_src(38, "full")[0]."*/";
//echo "/*".print_r($my_query[0])."*/";
 ?>



</script>
<?php  
}  

$defaults = array(
	'wp-head-callback' => 'responsive_custom_background_cb'
);
add_theme_support( 'custom-background', $defaults );  



register_sidebar( array('name' => 'Right Sidebar' ));
register_sidebar( array('name' => 'Footer Widgets' ));

?>