<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gamayun_01
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
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'gamayun');?></a>

<header id="masthead" class="site-header">

    <!-- Menu icon to open sidebar -->
    <button id="open-sidebar" class="w3-button w3-white w3-xxlarge w3-text-grey w3-hover-text-black w3-top" style="top:1em; width:auto; right:0; z-index:180">
		<span class="icon-menu"></span>
    </button>

	<button onclick="topFunction()" id="myBtn" class="w3-button w3-bottom w3-white w3-xxlarge w3-text-grey w3-hover-text-black"
	style="display:none;width:auto;right:30px;" title="Go to top">Top</button>

<nav id="site-navigation" class="main-navigation w3-theme-d5">
<?php gamayun_get_site_branding();

wp_nav_menu(array(
    'theme_location' => 'secondary',
));

wp_nav_menu(array(
    'theme_location' => 'menu-1',
    'menu_class' => 'menu navigation-main',
));
?></nav><!-- #site-navigation -->

<!-- add header image -->
<div id="header-image-div">
	<?php if (get_header_image()): ?>
 	<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img class="header-image" src="<?php header_image();?>"  alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
    </a>
	<?php endif;?>
	<?php gamayun_get_header_slider();?>
</div><!-- .header-image -->

</header><!-- #masthead -->
<?php
