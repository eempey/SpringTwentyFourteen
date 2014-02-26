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
function responsive_custom_background_cb() {  
    $background = get_background_image();  

    $color = get_background_color();  
  
    if ( ! $background && ! $color )  
        return;  
  
    $style = $color ? "background-color: #$color;" : '';  
  
    if ( $background ) {  
        //$image = " background-image: url('$background');";
        $background_query = new WP_Query(array(
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
            while ($background_query->have_posts()) : $background_query->the_post(); global $post; 
                $backgroundId = get_the_ID();
            endwhile; 
        endif; 

        wp_reset_postdata();//not resetting this caused the image to show up on woocommerce page description

        $backgroundFull = wp_get_attachment_image_src($backgroundId, "full")[0];
        $backgroundLarge = wp_get_attachment_image_src($backgroundId, [1170,780])[0]; 
        $backgroundMobile = wp_get_attachment_image_src($backgroundId, [768,512])[0];   
  
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
    



//echo "/*".wp_get_attachment_image_src($backgroundId, "full")[0]."*/";
//echo "/*".print_r($my_query[0])."*/";
// ?>

 jQuery(document).ready(function($) {
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();

    if($(window).width() > 1170){
        $('body.custom-background').css('background-image', <?php echo "'url(".$backgroundFull.")'" ?> );
    }else if($(window).width() > 768 && $(window).width() <= 1170){
        $('body.custom-background').css('background-image', <?php echo "'url(".$backgroundLarge.")'" ?> );
    }else{
        $('body.custom-background').css('background-image', <?php echo "'url(".$backgroundMobile.")'" ?> );
        
    }    
    });



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