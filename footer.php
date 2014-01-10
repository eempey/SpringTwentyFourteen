</div>
</div>
<footer>
  <div class="container">
    <ul id="footer-widgets"> <?php dynamic_sidebar( 'Footer Widgets' ); ?></ul>
    <div class="pull-right">
     <small class="copyright"><?php bloginfo('name'); ?> 2013-<?php echo date('Y'); ?></small> 
      <?php 
        wp_nav_menu( array( 
          'theme_location' => 'social-media-icons', 
          'container' => '', 
          'items_wrap' => '<ul class="social-media-icons">%3$s</ul>',
        )); 
      ?>
    </div>
  </div>
  <?php wp_footer(); ?>
</footer>
</body>
</html>