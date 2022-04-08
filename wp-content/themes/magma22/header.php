<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gamayun
 */

?>
<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();?>
</head>

<body <?php body_class('w3-theme-d5');?>>

<?php wp_body_open();?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'magma22');?></a>

<header id="masthead" class="site-header">
    <!-- Menu icon to open sidebar -->
<!--     <button id="open-sidebar" class="w3-button w3-white w3-xxlarge w3-text-grey w3-hover-text-black w3-top" style="top:1em; width:auto; right:0; z-index:180">
		<span class="icon-menu"></span>
    </button>
 -->
	<button onclick="topFunction()" id="myBtn" class="w3-button w3-bottom w3-white w3-xxlarge w3-text-grey w3-hover-text-black"
	style="display:none;width:auto;right:30px;" title="Go to top">Top</button>

<!-- add header image -->
<div id="header-image-div" class="w3-display-container w3-theme-d5"
	<?php if (!get_header_image()): ?>
		style="height:80px;" > 
	<?php endif;?>
	<?php if (get_header_image()): ?>
 	> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img class="header-image" src="<?php header_image();?>"  alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
    </a>
	<?php endif;?>

	<!-- <nav id="site-navigation" class="main-navigation w3-display-topleft"> -->
	<nav id="site-navigation" class="main-navigation w3-display-topright w3-theme-d4">
	<!-- <nav id="site-navigation" class="main-navigation w3-display-topmiddle"> -->
	<!-- <nav id="site-navigation" class="main-navigation w3-display-bottomleft"> -->
			<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'magma22');?></button> -->
			<?php
	// wp_nav_menu(
	//     array(
	//         'theme_location' => 'menu-1',
	//         'menu_id'        => 'primary-menu',
	//     )
	// );
	wp_nav_menu(array(
	'theme_location' => 'secondary',
	));

	wp_nav_menu(array(
	'theme_location' => 'menu-1',
	'menu_class' => 'menu navigation-main',
	));
	?></nav><!-- #site-navigation -->

	<div class="site-branding w3-display-topleft w3-theme-d4">

	<?php
	the_custom_logo();
	// if ( is_front_page() && is_home() ) :
	?>
			<!-- <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a></h1> -->
			<h1 class="site-title"><?php bloginfo('name');?></h1>
			<?php
	/*             else :
	?>
	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	<?php
	endif;
	*/
	$magma22_description = get_bloginfo('description', 'display');
	if ($magma22_description || is_customize_preview()):
	?>
			<div class="site-description"><?php echo $magma22_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped   ?></div>
		<?php endif;?>
	</div><!-- .site-branding -->

</div><!-- .header-image -->

<?php gamayun_get_header_slider();?>

</header><!-- #masthead -->
<?php
