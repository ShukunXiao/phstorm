<?php
/**
 * Header One Style Template
 *
 * @package Caff
 */
$caff_phone      = caff_gtm( 'caff_header_phone' );
$caff_email      = caff_gtm( 'caff_header_email' );
$caff_address    = caff_gtm( 'caff_header_address' );
$caff_open_hours = caff_gtm( 'caff_header_open_hours' );

$caff_button_text   = caff_gtm( 'caff_header_button_text' );
$caff_button_link   = caff_gtm( 'caff_header_button_link' );
$caff_button_target = caff_gtm( 'caff_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-one <?php echo ! $caff_button_text ? ' button-disabled' : ''; ?>">
	<div id="top-header" class="main-top-header-one  <?php echo esc_attr( caff_gtm( 'caff_header_top_color_scheme' ) ); ?>">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'caff' ); ?></span>
				</button><!-- #header-top-toggle -->
				
				<div id="site-top-header-mobile-container">
					<?php if ( $caff_phone || $caff_email || $caff_address || $caff_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social">
							<div class="social-nav no-border circle-icon">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'caff' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'social',
											'menu_class'     => 'social-links-menu',
											'depth'          => 1,
											'link_before'    => '<span class="screen-reader-text">',
										) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>
					
					<?php get_template_part( 'template-parts/header/header-mobile-search' ); ?>
				</div><!-- #site-top-header-mobile-container-->
			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $caff_phone || $caff_email || $caff_address || $caff_open_hours ) : ?>
				<div id="quick-contact" class="pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div>
				<?php endif; ?>

				<div class="top-head-right pull-right">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border circle-icon">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'caff' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div><!-- .social-nav -->
					</div><!-- #top-social -->
					<?php endif; ?>

					<div class="head-search-cart-wrap pull-left">
						<?php if ( function_exists( 'caff_woocommerce_header_cart' ) ) : ?>
						<div class="cart-contents pull-left">
							<?php caff_woocommerce_header_cart(); ?>
						</div>
						<?php endif; ?>
						<div class="header-search pull-right">
							<?php get_template_part( 'template-parts/header/header-search' ); ?>
						</div><!-- .header-search -->
					</div><!-- .head-search-cart-wrap -->
				</div><!-- .top-head-right -->
			</div><!-- .container -->
		</div><!-- .site-top-header -->
	</div><!-- #top-header -->

	<header id="masthead" class="site-header main-header-one clear-fix<?php echo caff_gtm( 'caff_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->

				<div class="right-head pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div><!-- .main-nav -->

	                <div class="right-head-info pull-right">
						<?php if ( $caff_button_text ) : ?>
						<a target="<?php echo esc_attr( $caff_button_target );?>" href="<?php echo esc_url( $caff_button_link );?>" class="ff-button header-button  pull-left"><?php echo esc_html( $caff_button_text );?></a>
						<?php endif; ?>

						<?php if ( $caff_phone ) : ?>
						<div class="mobile-off no-margin pull-left">
							<div class="contact-wrapper">
								<div class="contact-icon pull-left"><i class="fas fa-phone-alt"></i></div><!-- .contact-icon -->
								
								<div class="header-info">
									<span><?php esc_html_e( 'Call Us', 'caff' ); ?></span>
									<h5><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $caff_phone ) ); ?>"><?php echo esc_html( $caff_phone ); ?></a></h5>
		                    	</div><!-- .header-info -->
			                </div><!-- .contact-wrapper -->
						</div><!-- .mobile-off.ff-grid-2.no-margin -->
						<?php endif; ?>
					</div><!-- .right-head-info -->
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div><!-- .header-wrapper -->
