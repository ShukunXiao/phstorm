<?php
/**
 * Gamayun 01 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gamayun_01
 */

if (!defined('gamayun_is_simple_VERSION')) {
    // Replace the version number of the theme on each release.
    define('gamayun_is_simple_VERSION', '1.0.0');
}

// CHANGE LOCAL LANGUAGE - https://developer.wordpress.org/reference/functions/load_theme_textdomain/
// must be called before load_theme_textdomain()
add_filter('locale', 'gamayun_theme_localized');
/**
 * Switch to locale given as query parameter l, if present
 */
function gamayun_theme_localized($locale)
{
    if (isset($_GET['l'])) {
        return sanitize_key($_GET['l']);
    }
    return $locale;
}

if (!function_exists('gamayun_01_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function gamayun_01_setup()
{
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Gamayun 01, use a find and replace
         * to change 'gamayun' to the name of your theme in all the template files.
         */
        load_theme_textdomain('gamayun', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        //  register_nav_menus, then create menus programatically (after_switch_theme) - https://wordpress.stackexchange.com/questions/87933/register-nav-menus-then-create-menus-programatically/87946#87946
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'gamayun'),
                'secondary' => __('Secondary Menu', 'gamayun'),
            )
        );

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background',
            apply_filters(
                'gamayun_01_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
        // Support for Custom Editor Style
        add_editor_style('css/editor-style.css');
    }
endif;
add_action('after_setup_theme', 'gamayun_01_setup');

// deactivate new block editor
function gamayun_theme_support()
{
remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'gamayun_theme_support');

add_action('after_switch_theme', 'gamayun_setup_options');
function gamayun_setup_options()
{
    if (is_admin() && isset($_GET['activated'])) {
        set_theme_mod('header_image', 'remove-header'); // hide header_image

        if (!wp_get_nav_menu_object('Secondary Menu')) {
            wp_create_nav_menu('Secondary Menu'); //create the menu
        }
        $menu_obj = get_term_by('name', 'Secondary Menu', 'nav_menu');
        $menu_id = $menu_obj->term_id;
        $locations = get_theme_mod('nav_menu_locations'); //get the menu locations
        $locations['secondary'] = $menu_id; //set our new menu to be the secondary
        set_theme_mod('nav_menu_locations', $locations); //update
    }
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gamayun_01_content_width()
{
    $GLOBALS['content_width'] = apply_filters('gamayun_01_content_width', 640); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action('after_setup_theme', 'gamayun_01_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gamayun_01_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'gamayun'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'gamayun'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'gamayun_01_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function gamayun_01_scripts()
{
    wp_enqueue_style('gamayun-01-style', get_stylesheet_uri(), array(), gamayun_is_simple_VERSION); // add style.css
    wp_style_add_data('gamayun-01-style', 'rtl', 'replace');

    wp_enqueue_script('gamayun-01-navigation', get_template_directory_uri() . '/js/navigation.js', array(), gamayun_is_simple_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'gamayun_01_scripts');

function gamayun_add_google_fonts()
{
    $google_headings_fonts = get_theme_mod('gamayun_headings_fonts', 'Barlow+Condensed:ital@1');
    $google_body_fonts = get_theme_mod('gamayun_body_fonts', 'Source+Sans+Pro:wght@400');
    wp_enqueue_style('gamayun-heading_fonts', 'https://fonts.googleapis.com/css2?family=' . $google_headings_fonts . '&display=swap'); // 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap' );
    wp_enqueue_style('gamayun-body_fonts', 'https://fonts.googleapis.com/css2?family=' . $google_body_fonts . '&display=swap');
}
add_action('enqueue_block_assets', 'gamayun_add_google_fonts');

/**
 * Load frontend scripts
 */
add_action('wp_enqueue_scripts', 'gamayun_load_scripts_styles', 9);
function gamayun_load_scripts_styles()
{
    wp_enqueue_style('gamayun-icomoon', get_template_directory_uri() . '/assets/icomoon/style.css');
    wp_enqueue_script('gamayun-js-lib', get_template_directory_uri() . '/js/lib.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('gamayun-flexmasonry-css', get_template_directory_uri() . '/assets/css/flexmasonry.css');
    wp_enqueue_script('gamayun-flexmasonry', get_template_directory_uri() . '/assets/js/flexmasonry.js');

    wp_enqueue_style('gamayun-w3css', get_template_directory_uri() . '/assets/css/w3.css');
    $cssFile = get_template_directory_uri() . '/assets/w3-theme/' . get_theme_mod('style_css', 'w3-theme-black.css');
    wp_enqueue_style('gamayun-w3style-css', $cssFile);

    if (is_front_page()) {
        // slider 1
        if (get_theme_mod('slider', 'slider 1') == 'slider 1') {
            wp_enqueue_script('gamayun-js-lib1', get_template_directory_uri() . '/js/lib1.js', array(), '1.0.0', true);
        }
        // skippr slider 2
        if (get_theme_mod('slider', 'slider 1') == 'slider 2') {
            wp_enqueue_style('gamayun-skippr-style-css', get_template_directory_uri() . '/assets/css/style1.css');
            wp_enqueue_style('gamayun-skippr-css', get_template_directory_uri() . '/assets/css/skippr.css');
            wp_enqueue_script('gamayun-skippr-js', get_template_directory_uri() . '/assets/js/skippr.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gamayun-js-lib2', get_template_directory_uri() . '/js/lib2.js', array('jquery'), '1.0.0', true);
        }
        // slick slider 3
        if (get_theme_mod('slider', 'slider 1') == 'slider 3') {
            wp_enqueue_style('gamayun-slick-css', get_template_directory_uri() . '/assets/css/slick.css');
            wp_enqueue_style('gamayun-slick-theme-css', get_template_directory_uri() . '/assets/css/slick-theme.css');
            wp_enqueue_script('gamayun-js-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true);
            // wp_enqueue_script('gamayun-js-lib3', get_template_directory_uri() . '/js/lib3.js', array('jquery'), '1.0.0', true);
        }
    }
    wp_enqueue_style('gamayun-under', get_template_directory_uri() . '/css/style-underscores.css');
    wp_enqueue_style('gamayun-my-menu', get_template_directory_uri() . '/css/menu-1.css');
    wp_enqueue_style('gamayun-my-01', get_template_directory_uri() . '/css/my-style-01.css');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function gamayun_excerpt_length($length)
{
    return get_theme_mod('excerpt_length', '20');
}
add_filter('excerpt_length', 'gamayun_excerpt_length', 999);

function gamayun_excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

function gamayun_get_site_branding()
{
    ?> <div class="site-branding">
		<div class="fcol">
			<?php
the_custom_logo();
    ?></div>
		<div class="fcol">
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a></h1>
				<?php
$gamayun_01_description = get_bloginfo('description', 'display');
    if ($gamayun_01_description || is_customize_preview()):
    ?>
				<span class="site-description"><?php echo $gamayun_01_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped   ?></span>
			<?php endif;?>
		</div>
		</div><!-- .site-branding -->
<?php
}

if ( ! function_exists( 'gamayun_template_file' ) ) {
function gamayun_template_file()
{
    get_header();
    ?>	<main id="primary" class="site-main w3-theme-l4">	<?php

    if (have_posts()) { // if have_posts && is_home() && is_archive() && is_search() - show MiniMasonry...

        add_action('wp_footer', function () { // show MiniMasonry...
            ?><script>
        document.addEventListener('DOMContentLoaded', function() {
        var n = <?php echo esc_html(get_theme_mod('Number_of_columns', '4')) ?>;

        FlexMasonry.init('.grid-flex', {
            responsive: true,
            breakpointCols: {
                'min-width: 992px': n,
                'min-width: 600px': 2,
                'min-width: 100px': 1
            },
        });

        }, false);
        </script>
        <?php });

        ?> <header class="page-header"> <?php
if (is_home() && !is_front_page()) {
            ?> <h1 class="page-title screen-reader-text"><?php single_post_title();?></h1> <?php
}
        if (is_archive()) {
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
        }
        if (is_search()) {
            ?> <h1 class="page-title"> <?php
printf(esc_html__('Search Results for: %s', 'gamayun'), '<span>' . get_search_query() . '</span>'); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
            ?> </h1> <?php
}
        ?> </header><!-- .page-header -->

        <div class="grid-flex"> <?php
/* Start the Loop */
        while (have_posts()):
            the_post();
            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             */
            // get_template_part( 'template-parts/content', get_post_type() );
            get_template_part('template-parts/content', 'grid');

        endwhile;
        ?> </div>
			<div class="pagin"> <?php
gamayun_number_pagination();
        ?> </div>	<?php

    } else {
        get_template_part('template-parts/content', 'none');
    }

    ?> </main><!-- #main --> <?php
get_sidebar();
    get_footer();
}
}

// Number Pagination Function
function gamayun_number_pagination()
{
    global $wp_query;
    $big = 9999999; // need an unlikely integer
    echo wp_kses_post(paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages)));
}

function gamayun_custom_query($query)
{
    if ($query->is_home() && $query->is_main_query()) {
        $sort =  (isset($_GET['sort']) ? sanitize_text_field( wp_unslash($_GET['sort'])) : ''); //$sort= ($_GET['sort'] ?? '');
        if ($sort == "1") {
            $query->set('order', 'ASC');
        }
        if ($sort == "2") {
            $query->set('orderby', 'rand');
        }
        if ($sort == "3") {
            $query->set('orderby', 'comment_count');
        }
    }
}
add_action('pre_get_posts', 'gamayun_custom_query');

class gamayun_Walker_Simple_Example extends Walker_Category
{
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $categories_cnt = count(get_categories(array('parent' => $item->cat_ID)));
        $name = $item->name;
        if ($categories_cnt > 0) {
            $name .= ' ▸';
        }

        $category_link = get_category_link($item->cat_ID);
        $output .= '<li class="item"> <a href="' . esc_url($category_link) . '" title="' . esc_attr($item->name) . '">' . $name . '</a>';
    }
}

add_filter('wp_nav_menu_items', 'gamayun_add_sort_order', 10, 2);
function gamayun_add_sort_order($items, $args)
{
    if (!is_admin() && $args->theme_location == 'secondary') {
        $items .= '<li><a href="/?random=1">' . __('Random Post', 'gamayun') . '</a></li>'; // Surprise me

        $items .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">' . __('Sort Order', 'gamayun') . '▾</a><ul class="dropdown-menu"><li>';
        $items .= '<li><a href=' . esc_url(get_post_type_archive_link( 'post' )) . '>' . __('Recent', 'gamayun') . '</a></li>';
        $items .= '<li><a href=' . esc_url(get_post_type_archive_link( 'post' )) . '?sort=1' . '>' . __('Oldest', 'gamayun') . '</a></li>';
        $items .= '<li><a href=' . esc_url(get_post_type_archive_link( 'post' )) . '?sort=2' . '>' . __('Random', 'gamayun') . '</a></li>';
        $items .= '<li><a href=' . esc_url(get_post_type_archive_link( 'post' )) . '?sort=3' . '>' . __('Comment count', 'gamayun') . '</a></li>';
        $items .= '</li></ul></li>';
    }
    return $items;
}


add_filter( 'wp_nav_menu_items', 'gamayun_add_home_menu', 3, 2 );
function gamayun_add_home_menu($items, $args) {
    if (!is_admin() && $args->theme_location == 'secondary') {
        $homelink = '<li class="home"><a href="' . home_url( '/' ) . '">' . '<span class="icon-home"></span>' . __(' Home', 'gamayun') . '</a></li>';
    $items = $homelink . $items;
}
return $items;
}

function gamayun_slug_all_posts_link() {
    if ( 'page' == get_option( 'show_on_front' ) ) {
        if ( get_option( 'page_for_posts' ) ) {
            return esc_url( get_permalink( get_option( 'page_for_posts' ) ) );
        } else {
            return esc_url( home_url( '/?post_type=post' ) );
        }
    } else {
        return esc_url( home_url( '/' ) );
    }
}
add_filter( 'wp_nav_menu_items', 'gamayun_add_blog_menu', 4, 2 );
function gamayun_add_blog_menu($items, $args) {
    if (!is_admin() && $args->theme_location == 'secondary') {
        $bloglink = '<li class="home"><a href="' . gamayun_slug_all_posts_link() . '">' . __('Blog', 'gamayun') . '</a></li>';
    $items = $items . $bloglink;
}
return $items;
}

add_filter('wp_nav_menu_items', 'gamayun_add_last_nav_item_categories', 5, 2);
function gamayun_add_last_nav_item_categories($items, $args)
{
    if (!is_admin() && $args->theme_location == 'secondary') {
        $excat2 = get_term_by('slug', 'uncategorized', 'category');
        $exid2 = $excat2->term_id;
        $args = array(
            'echo' => 0,
            'orderby' => 'slug',
            'show_count' => 0,
            'hierarchical' => 1,
            'depth' => 5,
            // 'exclude' => $exid1.','.$exid2,
            // 'exclude' => $exid2,
            'hide_empty' => 1,
            'title_li' => '',
            'hide_title_if_empty' => true,
            'walker' => new gamayun_Walker_Simple_Example(),
        );
        $items .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">' . __('Categories', 'gamayun') . ' ▾</a><ul class="dropdown-menu"><li>'
        . wp_list_categories($args) . '</li></ul></li>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'gamayun_adding_register_login_logout_menu', 20, 2);
function gamayun_adding_register_login_logout_menu($items, $args)
{
    if ($args->theme_location != 'secondary') { // Targeting WordPress main or primary menu
        return $items;
    }
    if (is_user_logged_in()) {
        // This below line of code will display logout url when user loged in
        $items .= '<li><a href="' . wp_logout_url(home_url()) . '">' . __('Logout', 'gamayun') . '</a></li>'; // logout and redirect to homepage.
    } else {
        // This below line of code will display login link when user logout
        $items .= '<li><a href="' . wp_login_url(home_url()) . '">' . __('Login', 'gamayun') . '</a></l>'; // wp_login_url(get_permalink()) - Login and Redirect to Current Page.
        // This line of code will display Registration link for new visitor or user
        $items .= '<li><a href="' . wp_registration_url() . '">' . __('Register', 'gamayun') . '</a></li>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'gamayun_add_search_form_to_menu', 25, 2);
function gamayun_add_search_form_to_menu($items, $args)
{
    // If this isn't the main navbar menu, do nothing
    if (!($args->theme_location == 'secondary')) {
        return $items;
    }

    // On main menu: put styling around search and append it to the menu items
    return $items . '<li class="my-nav-menu-search">' . get_search_form(false) . '</li>';
}

add_filter('wp_nav_menu_items', 'gamayun_add_monthly_archives', 7, 2);
function gamayun_add_monthly_archives($items, $args)
{
    if (!is_admin() && $args->theme_location == 'secondary') {
        $items .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">' . __('Archives', 'gamayun') . ' ▾</a><ul class="dropdown-menu">';
        global $wpdb;
        $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
    FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
        foreach ($years as $year):
            $items .= '<li><a href="JavaScript:void()">' . $year . '</a>';

            $items .= '<ul class="archive-sub-menu">';
            $months = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'
		            AND YEAR(post_date) = %d ORDER BY post_date ASC", $year));
            foreach ($months as $month):
                $items .= '<li><a href="' . get_month_link($year, $month) . '">'
                . date('F', mktime(0, 0, 0, $month, 1, 0)) . '</a></li>';
            endforeach;
            $items .= '</ul></li>';
        endforeach;

        $items .= '</li></ul>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'gamayun_add_tags', 6, 2);
function gamayun_add_tags($items, $args)
{
    $html = null;
    if (!is_admin() && $args->theme_location == 'secondary') {

        $tags = get_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                $html .= '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '" title="' . esc_attr($tag->name) . '">' . esc_html($tag->name) . '</a></li>';
            }}
        $items .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">' . __('Tags', 'gamayun') . ' ▾</a><ul class="dropdown-menu">'
            . $html . '</ul></li>';
    }
    return $items;
}

add_action('init', 'gamayun_random_post');
function gamayun_random_post()
{
    global $wp;
    $wp->add_query_var('random');
    add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect', 'gamayun_random_template');
function gamayun_random_template()
{
    if (get_query_var('random') == 1) {
        $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
        foreach ($posts as $post) {
            $link = get_permalink($post);
        }
        wp_redirect($link, 307);
        exit;
    }
}

function gamayun_slick_posts($args)
{
    add_action('wp_footer', function () { // show MiniMasonry...
        ?><script>

(function ($) {
    var n = <?php echo esc_html(get_theme_mod('slider3_number_of_images', '3')) ?>;
    $(document).ready(function () {
      // carousel
      $('.slick-carousel').slick({
        slidesToShow: n,
        centerMode: true,
        centerPadding: '60px',
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
      });
    });
  })(jQuery);

    </script>
    <?php });

    ?><div class= "slick-carousel"><?php
    $query1 = new WP_Query($args);
    if ($query1->have_posts()) {while ($query1->have_posts()) {
        $query1->the_post();
        gamayun_templatepart_slick();
    }}
    wp_reset_postdata();
    ?></div><?php
}
function gamayun_templatepart_slick()
{
    ?>
    <div class="slide"><article id="post-<?php the_ID();?>" >
        <?php if (has_post_thumbnail()) {?>
            <a href="<?php the_permalink();?>" title="<?php echo esc_attr(the_title_attribute('echo=0')); ?>" rel="bookmark" class="grid-item-img-link"><?php the_post_thumbnail('post-thumbnail');?></a>
        <?php }?>
        <header class="entry-header padd-1 w3-theme-l3">
            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
    ?></header><!-- .entry-header -->
        <div class="entry-meta"><?php the_date();?></div>
        <div class="entry-content">
            <?php echo esc_html(gamayun_excerpt(30)); ?>
        </div>
    </article></div>
    <?php
}

function gamayun_skippr_posts($args)
{
    ?><div class="hero">
         <div id="random"><?php
$query1 = new WP_Query($args);
    if ($query1->have_posts()) {while ($query1->have_posts()) {
        $query1->the_post();

        gamayun_templatepart_skippr();
    }}
    wp_reset_postdata();

    ?></div></div><?php
}

function gamayun_templatepart_skippr()
{
    ?>
    <div class="skippr__slide" style="background-image:url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>')">
    <article id="post-<?php the_ID();?>" >
        <header class="entry-header padd-1">
            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
    ?></header><!-- .entry-header -->
        <div class="entry-meta"><?php the_date();?></div>
        <div class="entry-content">
            <?php echo esc_html(gamayun_excerpt(30)); ?>
        </div>
    </article></div>
    <?php
}

function gamayun_get_header_slider()
{
    if (is_front_page() && have_posts()) {
        if (get_theme_mod('slider_display_post', 'random') == 'random') {
            $args = array(
                'cat' => '',
                'posts_per_page' => '5',
                'ignore_sticky_posts' => true,
                'order' => 'asc',
                'orderby' => 'rand',
            );
        } else {
            $post_ids_fetched = explode(',', get_theme_mod('slider_list_of_posts'));
            $args = array(
                'post__in' => $post_ids_fetched,
                'orderby' => 'post__in',
                'ignore_sticky_posts' => true,
                'post_status' => 'publish',
            );
        }
// slider 1
        if (get_theme_mod('slider', 'slider 1') == 'slider 1') {
            gamayun_w3css_slider_posts($args);
        }
// my skippr slider 2 - 5 random posts
        if (get_theme_mod('slider', 'slider 1') == 'slider 2') {
            gamayun_skippr_posts($args);
        }
// slick slider 3 - 5 random posts
        if (get_theme_mod('slider', 'slider 1') == 'slider 3') {
            gamayun_slick_posts($args);
        }
    }
}

function gamayun_w3css_slider_posts($args)
{
    ?><div class="w3-display-container"><?php
$query1 = new WP_Query($args);
    if ($query1->have_posts()) {while ($query1->have_posts()) {
        $query1->the_post();

        gamayun_templatepart_w3css_slider();
    }}
    wp_reset_postdata();

    ?><div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle"
    style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>

    <!-- <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span> -->
    <?php
// echo $query1->post_count ;
    for ($i = 1; $i <= $query1->post_count; $i++) {
        ?><span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(<?php echo esc_html($i); ?>)"></span> <?php
}
    ?>
    </div>
</div><?php
}
function gamayun_templatepart_w3css_slider()
{
    ?>
    <div class="w3-display-container mySlides slider1 w3-animate-opacity">
    <img src='<?php echo esc_url(get_the_post_thumbnail_url()); ?>' style="width:100%">
    <!-- <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
      French Alps
    </div> -->
    <article id="post-<?php the_ID();?>" <?php post_class('w3-display-middle');?>>
        <header class="entry-header padd-1">
            <?php the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');
    ?></header><!-- .entry-header -->
        <div class="entry-meta"><?php the_date();?></div>
        <div class="entry-content">
            <?php echo esc_html(gamayun_excerpt(30)); ?>
        </div>
    </article>
  </div>
  <?php
}

function gamayun_last_updated_date()
{
    $u_time = get_the_time('U');
    $u_modified_time = get_the_modified_time('U');
    if ($u_modified_time >= $u_time + 86400) {
        echo "<p class='last-updated'>Last modified on ";
        the_modified_time('F jS, Y');
        echo " at ";
        the_modified_time();
        echo "</p> ";}
}
