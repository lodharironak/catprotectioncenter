<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package catprotectioncenter-1
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<!-- Footer navigation -->
			<div class="container">
            <div class="footer-wrap">
                <p class="footer-txt"><?php the_field('copyright' , 'option'); ?></p>
                    <ul class="footer-menu-links">
                        <?php 
			                wp_nav_menu( 
			                	array('menu'=>'menuname') ); 
	            		?>
                    </ul>
            </div>
        </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
