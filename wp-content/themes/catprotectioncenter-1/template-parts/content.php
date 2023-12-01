<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catprotectioncenter-1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				catprotectioncenter_1_posted_on();
				catprotectioncenter_1_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php catprotectioncenter_1_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'catprotectioncenter-1' ),
					array(
						'span' => array(
						'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		// Display the Taxonomy post list
		// the_terms( $post->ID, 'subjects', 'Subjects: ', ', ', ' ' );
		

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'catprotectioncenter-1' ),
				'after'  => '</div>',
			)
		);
		?>

		<!-- Taxonomy display -->
		<?php
			$taxonomy = 'subjects';
			$post_terms = wp_get_post_terms( $post->ID, $taxonomy );

			foreach ( $post_terms as $term ) 
			{ 
			    echo '<li><a href="' . get_category_link( $term->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" ' . '>' . $term->name.'</a> </li> ';
			}
		?>

	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php catprotectioncenter_1_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
