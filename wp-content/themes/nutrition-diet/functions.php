<?php
/**
 * Nutrition Diet functions and definitions
 *
 * @subpackage Nutrition Diet
 * @since 1.0
 */

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'nutrition_diet_loop_columns', 999);
if (!function_exists('nutrition_diet_loop_columns')) {
	function nutrition_diet_loop_columns() {
		return 3;
	}
}

function nutrition_diet_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function nutrition_diet_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function nutrition_diet_sanitize_select( $input, $setting ){  
    $input = sanitize_key($input);    
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );      
}

function nutrition_diet_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function nutrition_diet_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function nutrition_diet_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}

function nutrition_diet_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<div class="link-more text-center"><a href="%1$s" class="more-link py-2 px-4">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'nutrition-diet' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'nutrition_diet_excerpt_more' );

function nutrition_diet_notice(){
    global $pagenow;
    $theme_name = wp_get_theme();
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) && $theme_name->get( 'TextDomain' ) === 'nutrition-diet' ) {
   		wp_safe_redirect( admin_url("themes.php?page=nutrition-diet-guide-page") );
   	}
}
add_action('after_setup_theme', 'nutrition_diet_notice');

function nutrition_diet_add_new_page() {
    $edit_page = admin_url().'post-new.php?post_type=page';
    echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

    exit;
}
add_action( 'wp_ajax_nutrition_diet_add_new_page','nutrition_diet_add_new_page' );

function nutrition_diet_setup() {
	
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'nutrition-diet-featured-image', 2000, 1200, true );
	add_image_size( 'nutrition-diet-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nutrition-diet' ),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', nutrition_diet_fonts_url() ) );

}
add_action( 'after_setup_theme', 'nutrition_diet_setup' );

function nutrition_diet_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'nutrition-diet' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'nutrition-diet' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'nutrition-diet' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'nutrition-diet' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'nutrition-diet' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'nutrition-diet' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Category Dropdown', 'nutrition-diet' ),
		'id'            => 'product-cat',
		'description'   => __( 'Add widgets here to appear in your header.', 'nutrition-diet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'nutrition_diet_widgets_init' );

function nutrition_diet_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Inter:wght@100;200;300;400;500;600;700;800;900';	

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

function nutrition_diet_enqueue_admin_script( $hook ) {
	
	// Admin JS
	wp_enqueue_script( 'nutrition-diet-admin.js', get_theme_file_uri( '/assets/js/nutrition-diet-admin.js' ), array( 'jquery' ), true );

	wp_localize_script('nutrition-diet-admin.js', 'nutrition_diet_scripts_localize',
        array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php'))
        )
    );
}
add_action( 'admin_enqueue_scripts', 'nutrition_diet_enqueue_admin_script' );

//Enqueue scripts and styles.
function nutrition_diet_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'nutrition-diet-fonts', nutrition_diet_fonts_url(), array(), null );

	//Bootstarp 
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );	
	// Theme stylesheet.
	wp_enqueue_style( 'nutrition-diet-style', get_stylesheet_uri() );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'nutrition-diet-style',$nutrition_diet_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'nutrition-diet-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	//Custom JS
	wp_enqueue_script( 'nutrition-diet-custom.js', get_theme_file_uri( '/assets/js/theme-script.js' ), array( 'jquery' ), true );

	//Nav Focus JS
	wp_enqueue_script( 'nutrition-diet-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	//Superfish JS
	wp_enqueue_script( 'superfish-js', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ),true );

	//Bootstarp JS
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nutrition_diet_scripts' );

function nutrition_diet_fonts_scripts() {
	$headings_font = esc_html(get_theme_mod('nutrition_diet_headings_text'));
	$body_font = esc_html(get_theme_mod('nutrition_diet_body_text'));

	if( $headings_font ) {
		wp_enqueue_style( 'nutrition-diet-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'nutrition-diet-be-vietnam', '//fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}
	if( $body_font ) {
		wp_enqueue_style( 'nutrition-diet-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
	} else {
		wp_enqueue_style( 'nutrition-diet-be-vietnam', '//fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}
}
add_action( 'wp_enqueue_scripts', 'nutrition_diet_fonts_scripts' );

// Enqueue editor styles for Gutenberg
function nutrition_diet_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'nutrition-diet-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'nutrition-diet-fonts', nutrition_diet_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'nutrition_diet_block_editor_styles' );

function nutrition_diet_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'nutrition_diet_front_page_template' );

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

require get_parent_theme_file_path( '/inc/typofont.php' );