<!DOCTYPE html>
<html lang="en">
<head>
<?php wp_head(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title('|',true,''); ?>
</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
</head>
<body <?php body_class(); ?>>
<div id="wrap">
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation"> 
  <!-- Brand and toggle get grouped for better mobile display -->
  
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <h1 class="spring"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php bloginfo( 'name' ); ?>
        </a></h1>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php 
		wp_nav_menu( array( 
		'theme_location' => 'header-menu', 
		'container' => '', 
		'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>',
		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker()
		 )); ?>
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <?php 
        wp_nav_menu( array( 
          'theme_location' => 'social-media-icons', 
          'container' => '', 
          'items_wrap' => '<ul class="nav social-media-icons">%3$s</ul>',
        )); 
      ?>
      
    </div>
  </div>
</div>
</nav>
