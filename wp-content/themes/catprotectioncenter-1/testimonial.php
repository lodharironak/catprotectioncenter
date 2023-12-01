<?php
/**
 Template Name: Testimonial
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
			$args = array(
				'post_type'=> 'testimonial',
				'orderby'    => 'ID',
				'order'    => 'DESC',
				'posts_per_page' => 3 
			);

			$result = new WP_Query( $args );
			if ( $result-> have_posts() ) : ?>

			<?php while ( $result->have_posts() ) : $result->the_post(); 
				get_template_part( 'template-parts/content', get_post_type() );?>
				
			<?php endwhile; ?>
		<?php endif; wp_reset_postdata(); ?>
	</main><!-- #main -->	
<?php
get_footer();
?>


