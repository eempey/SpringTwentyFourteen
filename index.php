<?php
/**
 *
 * @package WordPress
 * @subpackage Spring
 * @since Spring 1.0
 */

/*define('WP_USE_THEMES', false);*/ get_header(); ?>

 <div class="container">
    <?php if(is_active_sidebar(1)){
    	echo "<div class='col-md-6'>";
    }else{
    	echo "<div class='col-md-12'>";
    } ?> 
    	

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    
    <article class="post-content"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
 <small><?php the_time(get_option('date_format')); ?> </small>
   <?php the_content(); ?></article>
    

	
	<?php endwhile; else: ?>
  <article class="post-content"><p><?php _e('Sorry, no posts matched your criteria.'); ?></p></article>
    <?php endif; ?>
 </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>