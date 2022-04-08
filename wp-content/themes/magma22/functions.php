<?php
function magma22_enqueue_styles() {
    // enqueue parent styles
    wp_enqueue_style( 'magma22-style-parent', get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'magma22-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'magma22-style-parent' ), '1.0.0' );
}
//add_action( 'wp_enqueue_scripts', 'magma22_enqueue_styles', 99 );
add_action( 'wp_enqueue_scripts', 'magma22_enqueue_styles', 9);

function magma22_setup()
{
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_child_theme_textdomain( 'gamayun', get_stylesheet_directory() . '/languages/gamayun' );
        load_theme_textdomain('magma22', get_stylesheet_directory() . '/languages');

        //add_theme_support('automatic-feed-links');
        //add_theme_support('title-tag');
}
add_action('after_setup_theme', 'magma22_setup');

function magma22_theme_mods() {
    if(empty(get_theme_mod( 'page_width' )))
        set_theme_mod('page_width', '100');
    if(empty(get_theme_mod( 'style_css' )))
        set_theme_mod('style_css', 'w3-theme-dark-grey.css');
    // set_theme_mod( 'header_image' , get_theme_support( 'custom-header', 'default-image' ) );    
    if(empty(get_theme_mod( 'slider' )))
        set_theme_mod('slider', 'slider 3');
    if(empty(get_theme_mod( 'slider3_height_of_images' )))
        set_theme_mod('slider3_height_of_images', '500');
    if(empty(get_theme_mod( 'slider3_number_of_images' )))
        set_theme_mod('slider3_number_of_images', '4');
    if(empty(get_theme_mod( 'slider_height' )))
        set_theme_mod('slider_height', '650');
    if(empty(get_theme_mod( 'conversions_logo_height' )))
        set_theme_mod('conversions_logo_height', '3.0');

    // if(empty(get_theme_mod( 'slider_display_post' )))
    //     set_theme_mod('slider_display_post', 'list');   // 'random'
    // if(empty(get_theme_mod( 'slider_list_of_posts' )))
    //     set_theme_mod('slider_list_of_posts', '511, 498, 491, 487, 496');
}
add_action( 'init', 'magma22_theme_mods' );

function magma22_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'magma22_custom_header_args', array(
				'default-image'      => get_stylesheet_directory_uri() . '/images/pexels-pixabay-45170.jpg',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
			)));
            register_default_headers( array(
                'header-bg' => array(
                    'url'           => get_theme_file_uri( '/images/pexels-pixabay-45170.jpg' ),
                    'thumbnail_url' => get_theme_file_uri( '/images/pexels-pixabay-45170.jpg' ),
                    'description'   => _x( 'Default', 'Default header image', 'magma22' )
                    ),	
                ) );
            }
add_action( 'after_setup_theme', 'magma22_custom_header_setup' );


add_filter( 'wp_nav_menu_items', 'magma22_add_open_sidebar', 30, 2 );
function magma22_add_open_sidebar($items, $args) {
    if (!is_admin() && $args->theme_location == 'secondary') {
        $openlink = '<button id="open-sidebar" class="w3-theme-d4"><span class="icon-menu"></span></button>';
        $items = $items . $openlink;
}
return $items;
}

function magma22_date()
{
    ?>
<span class="icon-pencil"></span>
<!-- Retrieves the permalink for the month archives with year. / get_year_link(); get_month_link; get_day_link -->
<?php
$archive_year = get_the_time('Y');
    $archive_month = get_the_time('m');
    $archive_day = get_the_time('d');
    ?>
<a href="<?php echo esc_url(get_month_link($archive_year, $archive_month)); ?>"><?php echo get_the_date(); ?></a>

<?php // Count number of posts of current month - https://wordpress.stackexchange.com/questions/88645/count-number-of-posts-of-current-month
    $month = get_the_time('m');
    $year_l = get_the_time('Y');
    $countposts = get_posts(array(
        'numberposts' => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_numberposts
        'post_type' => 'post',
        'year' => $year_l,
        'monthnum' => $month,
    ));
    echo '(' . count($countposts) . ')';
    ?>

<?php
}

function magma22_entrymeta()
{
    ?><span class="w3-text-black">Post information:</span><?php
    global $authordata;
    $link_l = get_author_posts_url($authordata->ID, $authordata->user_nicename);
    $link_l = sprintf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
        esc_url(add_query_arg('post_type', 'post', $link_l)),
        esc_attr(sprintf('Posts by %s', get_the_author())),
        get_the_author()
    ) . '(' . count_user_posts(get_the_author_meta('ID'), 'post') . ')';
    ?>
<br /><span class="icon-pencil"></span> author: <?php echo  wp_kses_post($link_l); ?><br />

<?php
    magma22_date();

    // ***** post all categories
    $terms = wp_get_post_terms(get_the_ID(), 'category');
    $links = '';
    foreach ($terms as $t) {
        $tl = is_wp_error($term_link = get_term_link($t->slug, 'category')) ? '' : $term_link;
        $links .= '<a href="' . $tl . '">' . $t->name . '</a>' . '(' . $t->count . ')' . ' ';
    }
    printf("<br /><span class='icon-folder-open'></span> " . '<span style="font-variant:small-caps;">' . "Categories: " . '</span>' . '<span class="entry-cat">' . '%1$s' . '</span><br />', wp_kses_post($links));

    // ***** post all tags
    $terms = wp_get_post_terms(get_the_ID(), 'post_tag');
    $links = '';
    foreach ($terms as $t) {
        $links .= '<a href="' . get_term_link($t->slug, 'post_tag') . '">' . $t->name . '(' . $t->count . ')' . '</a>' . ' ';
    }
    printf("<span class='icon-price-tag'></span> " . '<span style="font-variant:small-caps;">' . "Tags: " . '</span>' . '<span class="entry-tag">' . '%1$s' . '</span>', wp_kses_post($links));

    // comment
     ?><br /><span class="icon-bubble2"></span> <?php comments_popup_link('No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');?>
        <br /><?php
}
