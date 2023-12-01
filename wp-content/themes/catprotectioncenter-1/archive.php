<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catprotectioncenter-1
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

			endwhile;
			the_posts_navigation();

			else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
