<?php

add_action( 'admin_menu', 'nutrition_diet_gettingstarted' );
function nutrition_diet_gettingstarted() {    	
	add_theme_page( esc_html__('Theme Documentation', 'nutrition-diet'), esc_html__('Theme Documentation', 'nutrition-diet'), 'edit_theme_options', 'nutrition-diet-guide-page', 'nutrition_diet_guide');   
}

function nutrition_diet_admin_theme_style() {
   wp_enqueue_style('nutrition-diet-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'nutrition_diet_admin_theme_style');

if ( ! defined( 'NUTRITION_DIET_SUPPORT' ) ) {
	define('NUTRITION_DIET_SUPPORT',__('https://wordpress.org/support/theme/nutrition-diet/','nutrition-diet'));
}
if ( ! defined( 'NUTRITION_DIET_REVIEW' ) ) {
	define('NUTRITION_DIET_REVIEW',__('https://wordpress.org/support/theme/nutrition-diet/reviews/','nutrition-diet'));
}
define('NUTRITION_DIET_LIVE_DEMO',__('https://www.ovationthemes.com/demos/nutrition-diet/','nutrition-diet'));
define('NUTRITION_DIET_BUY_PRO',__('https://www.ovationthemes.com/wordpress/nutrition-diet-wordpress-theme/','nutrition-diet'));
define('NUTRITION_DIET_PRO_DOC',__('https://ovationthemes.com/docs/ot-nutrition-diet-pro/','nutrition-diet'));

/**
 * Theme Info Page
 */
function nutrition_diet_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme(); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'nutrition-diet'); ?><?php echo esc_html($theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( NUTRITION_DIET_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'nutrition-diet'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( NUTRITION_DIET_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'nutrition-diet'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','nutrition-diet'); ?></h3>
					<p><?php esc_html_e('To step the nutrition diet theme follow the below steps.','nutrition-diet'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('2. Setup Contact Info','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Contact info >> Add your phone number email address and donate button details.','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=nutrition_diet_top') ); ?>" target="_blank"><?php esc_html_e('Add Contact Info','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('3. Setup Menus','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('4. Setup Footer','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=nutrition_diet_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','nutrition-diet'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','nutrition-diet'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','nutrition-diet'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates >> Publish it.','nutrition-diet'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','nutrition-diet'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=nutrition_diet_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','nutrition-diet'); ?></a>

					<h4><?php esc_html_e('3. Setup About Us','nutrition-diet'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Add title, content and featured image >> Publish it.','nutrition-diet'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> About Us Settings >> Select page','nutrition-diet'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=nutrition_diet_middle_section') ); ?>" target="_blank"><?php esc_html_e('Add About Us','nutrition-diet'); ?></a>
				</div>
          	</div>
			<div class="col-md-3">
				<h3><?php esc_html_e('Nutrition Diet Theme','nutrition-diet'); ?></h3>
				<img class="nutrition_diet_img_responsive" style="width: 100%;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
				<div class="pro-links">
					<hr>
					<a class="button-primary buynow" href="<?php echo esc_url( NUTRITION_DIET_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'nutrition-diet'); ?></a>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( NUTRITION_DIET_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'nutrition-diet'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( NUTRITION_DIET_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'nutrition-diet'); ?></a>
					<hr>
				</div>
				<ul style="padding-top:10px">
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'nutrition-diet');?> </li>
                    <li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'nutrition-diet');?> </li>
                   	<li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'nutrition-diet');?> </li>
                   	<li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'nutrition-diet');?> </li>
                   	<li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'nutrition-diet');?> </li>
                   	<li class="upsell-nutrition_diet"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'nutrition-diet');?> </li>                    
                </ul>
        	</div>
		</div>
	</div>

<?php }?>
