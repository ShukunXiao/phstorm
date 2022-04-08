<?php
/**
 * The header for our theme
 *
 * @subpackage Nutrition Diet
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nutrition-diet' ); ?></a>
	<?php if( get_theme_mod('nutrition_diet_theme_loader',true) != ''){ ?>
		<div class="preloader">
			<div class="load">
			  <hr/><hr/><hr/><hr/>
			</div>
		</div>
	<?php }?>
	<div id="page" class="site">
		<div id="header">
			<div class="wrap_figure">
				<div class="top_bar text-center text-lg-left text-md-left">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<div class="logo text-center">
							        <?php if ( has_custom_logo() ) : ?>
					            		<?php the_custom_logo(); ?>
						            <?php endif; ?>
					              	<?php $blog_info = get_bloginfo( 'name' ); ?>
					              	<?php if( get_theme_mod('nutrition_diet_logo_title',true) != '' ){ ?>
						                <?php if ( ! empty( $blog_info ) ) : ?>
						                  	<?php if ( is_front_page() && is_home() ) : ?>
						                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						                  	<?php else : ?>
						                  		
					                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					                  		<?php endif; ?>
						                <?php endif; ?>
						                <?php }?>
						                <?php
					                  		$description = get_bloginfo( 'description', 'display' );
						                  	if ( $description || is_customize_preview() ) :
						                ?>
						                <?php if( get_theme_mod('nutrition_diet_logo_text',true) != '' ){ ?>
					                  	<p class="site-description">
					                    	<?php echo esc_html($description); ?>
					                  	</p>
					                  	<?php }?>
					              	<?php endif; ?>
							    </div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 align-self-center text-center text-md-right pt-3 pt-md-0">
								<?php if( get_theme_mod('nutrition_diet_call_number') != '' ){ ?>
									<span class="volume-span py-2"><i class="fas fa-phone mr-3"></i><?php echo esc_html(get_theme_mod('nutrition_diet_call_number','')); ?></span>
								<?php }?>

								<?php if( get_theme_mod('nutrition_diet_email_address') != '' ){ ?>
									<span class="mx-md-3 py-2"><i class="fas fa-envelope mr-3"></i><?php echo esc_html(get_theme_mod('nutrition_diet_email_address','')); ?></span>
								<?php }?>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
								<?php if( get_theme_mod('nutrition_diet_donate_btn_link') != '' || get_theme_mod('nutrition_diet_donate_btn_text') != ''){ ?>
									<p class="donate_btn my-2 text-center text-md-right"><a href="<?php echo esc_url(get_theme_mod('nutrition_diet_donate_btn_link','')); ?>"><?php echo esc_html(get_theme_mod('nutrition_diet_donate_btn_text','')); ?></a></p>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="menu_header py-3">
					<div class="container">
						<?php if(has_nav_menu('primary')){?>
							<div class="toggle-menu gb_menu">
								<button onclick="nutrition_diet_gb_Menu_open()" class="gb_toggle p-2"><i class="fas fa-ellipsis-h"></i><p class="mb-0"><?php esc_html_e('Menu','nutrition-diet'); ?></p></button>
							</div>
						<?php }?>
		   				<?php get_template_part('template-parts/navigation/navigation'); ?>
					</div>
				</div>
			</div>
		</div>