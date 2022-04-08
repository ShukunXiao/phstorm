<?php
/**
 * Theme functions and definitions
 *
 * @package Fitmeal Dietitian
 */ 

if ( ! function_exists( 'fitmeal_dietitian_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function fitmeal_dietitian_enqueue_styles() {
		wp_enqueue_style( 'nutrition-diet-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'fitmeal-dietitian-style', get_stylesheet_directory_uri() . '/style.css', array( 'nutrition-diet-style-parent' ), '1.0.0' );

		// Theme Customize CSS.
		require get_parent_theme_file_path( 'inc/extra_customization.php' );
		wp_add_inline_style( 'fitmeal-dietitian-style',$nutrition_diet_custom_style );
	}
endif;
add_action( 'wp_enqueue_scripts', 'fitmeal_dietitian_enqueue_styles', 99 );

function fitmeal_dietitian_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'fitmeal-dietitian-featured-image', 2000, 1200, true );
	add_image_size( 'fitmeal-dietitian-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fitmeal-dietitian' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, and column width.
	*/
	add_editor_style( array( 'assets/css/editor-style.css', nutrition_diet_fonts_url() ) );
}
add_action( 'after_setup_theme', 'fitmeal_dietitian_setup' );

function fitmeal_dietitian_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fitmeal-dietitian' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'fitmeal-dietitian' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'fitmeal-dietitian' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'fitmeal-dietitian' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'fitmeal-dietitian' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'fitmeal-dietitian' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitmeal-dietitian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fitmeal_dietitian_widgets_init' );

function fitmeal_dietitian_remove_my_action() {
    remove_action( 'admin_menu','nutrition_diet_gettingstarted' );
    remove_action( 'after_setup_theme','nutrition_diet_notice' );
}
add_action( 'init', 'fitmeal_dietitian_remove_my_action');

function fitmeal_dietitian_customize_register() {
  	global $wp_customize;

  	$wp_customize->remove_section( 'nutrition_diet_pro' );
}
add_action( 'customize_register', 'fitmeal_dietitian_customize_register', 11 );

function fitmeal_dietitian_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function fitmeal_dietitian_customize( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_stylesheet_directory_uri() ). '/assets/css/customizer.css');

	$wp_customize->add_section('fitmeal_dietitian_pro', array(
		'title'    => __('UPGRADE DIETITIAN PREMIUM', 'fitmeal-dietitian'),
		'priority' => 1,
	));

	$wp_customize->add_setting('fitmeal_dietitian_pro', array(
		'default'           => null,
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(new Fitmeal_Dietitian_Pro_Control($wp_customize, 'fitmeal_dietitian_pro', array(
		'label'    => __('FITMEAL DIETITIAN PREMIUM', 'fitmeal-dietitian'),
		'section'  => 'fitmeal_dietitian_pro',
		'settings' => 'fitmeal_dietitian_pro',
		'priority' => 1,
	)));

	// Product
    $wp_customize->add_section('fitmeal_dietitian_shop_section',array(
		'title'	=> __('Product Settings','fitmeal-dietitian'),
		'priority'	=> 4,
	));

	$wp_customize->add_setting('nutrition_diet_shop_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('nutrition_diet_shop_text',array(
		'type' => 'text',
		'label' => __('Sub Heading Text','fitmeal-dietitian'),
		'section' => 'fitmeal_dietitian_shop_section',
	));

	$wp_customize->add_setting('nutrition_diet_shop_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('nutrition_diet_shop_title',array(
		'type' => 'text',
		'label' => __('Heading Text','fitmeal-dietitian'),
		'section' => 'fitmeal_dietitian_shop_section',
	));

	// Product settings
	$args = array(
	    'type'                     => 'product',
	    'child_of'                 => 0,
	    'parent'                   => '',
	    'orderby'                  => 'term_group',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'hierarchical'             => 1,
	    'number'                   => '',
	    'taxonomy'                 => 'product_cat',
	    'pad_counts'               => false
	);
	$categories = get_categories($args);
	$cat_posts = array();
	$m = 0;
	$cat_posts[]='Select';
	foreach($categories as $category){
	if($m==0){
		$default = $category->slug;
			$m++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('fitmeal_dietitian_shop_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'nutrition_diet_sanitize_select',
	));
	$wp_customize->add_control('fitmeal_dietitian_shop_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select category to display products ','fitmeal-dietitian'),
		'section' => 'fitmeal_dietitian_shop_section',
	));
}
add_action( 'customize_register', 'fitmeal_dietitian_customize' );

function fitmeal_dietitian_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'fitmeal_dietitian_enqueue_comments_reply' );

define('FITMEAL_DIETITIAN_PRO_LINK',__('https://www.ovationthemes.com/wordpress/dietitian-wordpress-theme/','fitmeal-dietitian'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Fitmeal_Dietitian_Pro_Control')):
    class Fitmeal_Dietitian_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( FITMEAL_DIETITIAN_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE FITMEAL PREMIUM','fitmeal-dietitian');?> </a>
            </div>
            <div class="col-md">
                <img class="fitmeal_dietitian_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('DIETITIAN PREMIUM - Features', 'fitmeal-dietitian'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'fitmeal-dietitian');?> </li>
                    <li class="upsell-fitmeal_dietitian"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'fitmeal-dietitian');?> </li>
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( FITMEAL_DIETITIAN_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE DIETITIAN PREMIUM','fitmeal-dietitian');?> </a>
            </div>
        </label>
    <?php } }
endif;
