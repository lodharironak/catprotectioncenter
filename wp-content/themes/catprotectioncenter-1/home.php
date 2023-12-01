<?php
/**
		Template name:home
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
		while ( have_posts() ) :
			the_post();
			// If comments are open or we have at least one comment, load up the comment template.
			?>
			<!-- Banner Start -->

			<section class="banner-section">
		            <div class="banner-wrap">
		                <div class="banner-image">
		                    <?php 
							$image = get_field('image');
							if( !empty( $image ) ): ?>
							    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							<?php endif; ?>
		                </div>
		                <div class="container">
		                    <div class="banner-content">
		                        <h2><?php echo get_field('banner-txt'); ?></h2>
		                    </div>
		                </div>
		            </div>
		    </section>
		    <!-- Banner End -->

		    <!-- Mission Section Starts Here -->
	        <section class="mission-section">
	            <div class="container">
	                <div class="mission-wrap">
	                    <h2><?php echo get_field('content-heading'); ?></h2>
	                </div>
	            </div>
	        </section>
            <!-- Mission Section Ends Here -->

            <!-- Slider Start -->
        	<section class="testimonials-section">
            <div class="container">
                <div class="testimonials-wrapper">
                    <div class="testimonials-slider">
                    	
                        <?php if( have_rows('slider') ): ?>
		    		
					       <?php while( have_rows('slider') ) : the_row(); ?>
					       <div>
					       		<div class="testimonials-wrap">
							       <h3><?php echo get_sub_field('slider-title'); ?></h3>
							        <div class="testimonials-content">
							       		<p><?php echo get_sub_field('slider-content'); ?></p>
							       	</div>
							       	<?php $btn = get_sub_field('slider-btn'); 
							       		$link_url = $btn['url'];
    									$link_title = $btn['title'];
							       	?>
							       	<a href="<?php echo $link_url?>" target="_blank" class="btn"> <?php echo $link_title ?></a>
							    </div>
					      </div> 
					    <?php endwhile; ?>
						<?php endif; ?>	
                     </div>
                    </div>
                </div>
        	</section>
        	<!-- Slider End -->

            <!-- GET IN TOUCH -->

	  		<section class="get-in-touch-section">
	            <div class="container">
	                <div class="get-in-touch-wrap">
	                	<h6><?php echo get_field('footer-head', 'option'); ?></h6>
	                   <ul class="get-in-touch-wrap" style="list-style: none;">
							<li class="get"><?php echo get_field('call-us', 'option'); ?></li>
							<a href="#"><li class="get"><?php echo get_field('footer-no', 'option'); ?></li></a>
							<a href="#"><li class="get"><?php echo get_field('footer-email', 'option'); ?></li></a>
						</ul>	
							<?php 
							$link = get_field('footer-insta' , 'option');
							$url = $link['url'];
							if( $link ): ?>
							    <a href="<?php echo esc_url( $url ); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
							     <a href="<?php echo esc_url( $url ); ?>" target="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
							<?php endif; ?>
	                </div>
	            </div>
	   		</section>

		<?php
		endwhile; // End of the loop.
	?>	
		
    

</main><!-- #main -->
<?php
// get_sidebar();
get_footer();
