<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package catprotectioncenter-1
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<!-- Header Starts Here -->
    <header class="header">
        <div class="container">
            <div class="header-wrap">
            	<!-- Header logo -->
            		<?php 
						$image = get_field('header-logo', 'option');
						if( !empty( $image ) ): ?>
						    <a href="<?php echo esc_url( home_url( '/' ) );?>" rel="home_url"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
						    </a>
						<?php endif; 


					?>

					<!-- Navigation menu -->
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
					?>
				<div class="menu-wrap">
                    <a href="javascript:void(0);" class="menu-icon">
                        <i class="fa fa-bars" aria-hidden="true" ></i>
                        <i class="fa fa-times" aria-hidden="true" ></i>
                    </a>
                </div>
                <div class="lag">
                	<?php 
                		do_action('wpml_add_language_selector');
                	?>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Ends Here -->
