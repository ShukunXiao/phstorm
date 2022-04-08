<?php
/**
 * Gamayun 01 Theme Customizer
 *
 * @package Gamayun_01
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gamayun_01_customize_register($wp_customize)
{

    // font choices.
    $font_heading_choices = [
        // serif
        'Alegreya:ital,wght@1,700' => 'Alegreya - italic, 700',
        'BioRhyme:wght@700' => 'BioRhyme - 700',
        'Cardo:wght@700' => 'Cardo - 700',
        'Corben:wght@700' => 'Corben - 700',
        'Cormorant+Garamond:ital,wght@1,700' => 'Cormorant Garamond - italic, 700',
        'Cormorant+Infant:ital,wght@1,500' => 'Cormorant+Infant - italic, 500',
        'EB+Garamond:ital,wght@1,700' => 'EB Garamond - italic, 700',
        'Ibarra+Real+Nova:ital,wght@1,500' => 'Ibarra Real Nova - italic, 500',
        'Libre+Baskerville:ital@1' => 'Libre Baskerville - italic',
        'Lora:ital,wght@1,600' => 'Lora - italic, 600',
        'Merriweather:ital,wght@1,700' => 'Merriweather - italic, 700',
        'Noto+Serif' => 'Noto Serif',
        'Playfair+Display:ital,wght@1,700' => 'Playfair Display - italic, 700',
        'Radley:ital@1' => 'Radley - italic',
        'Roboto+Slab:wght@600' => 'Roboto Slab - 600',
        'Source+Serif+Pro:ital,wght@1,600' => 'Source Serif Pro - italic, 600',
        // sansserif
        'Asap+Condensed:ital,wght@1,500' => 'Asap Condensed - italic, 500',
        'Barlow+Condensed:ital@1' => 'Barlow Condensed - italic',
        'Barlow+Semi+Condensed:ital@1' => 'Barlow Semi Condensed - italic',
        'Fira+Sans:ital,wght@1,500' => 'Fira Sans - italic, 500',
        'Fira+Sans+Condensed:ital,wght@1,500' => 'Fira Sans Condensed - italic, 500',
        'Fira+Sans+Extra+Condensed:ital@1' => 'Fira Sans Extra Condensed - italic',
        'Oswald' => 'Oswald',
        'Roboto+Condensed:ital@1' => 'Roboto Condensed - italic',
        'Saira+Extra+Condensed:wght@500' => 'Saira Extra Condensed - 500',
        'Source+Sans+Pro:ital@1' => 'Source Sans Pro - italic',
        'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
    ];
    $font_body_choices = [
        // sansserif
        'Alegreya+Sans' => 'Alegreya Sans',
        'Arimo' => 'Arimo',
        'Barlow' => 'Barlow',
        'Cabin' => 'Cabin',
        'Catamaran' => 'Catamaran',
        'Didact+Gothic' => 'Didact Gothic',
        'Fira+Sans' => 'Fira Sans',
        'Hind' => 'Hind',
        'Inter' => 'Inter',
        'Josefin+Sans' => 'Josefin Sans',
        'Merriweather+Sans' => 'Merriweather Sans',
        'Montserrat' => 'Montserrat',
        'Nunito' => 'Nunito',
        'Open+Sans' => 'Open Sans',
        'Oswald' => 'Oswald',
        'Poppins' => 'Poppins',
        'Proza+Libre' => 'Proza Libre',
        'Quattrocento+Sans' => 'Quattrocento Sans',
        'Questrial' => 'Questrial',
        'Roboto' => 'Roboto',
        'Roboto+Slab' => 'Roboto Slab', // Variable
        'Saira' => 'Saira',
        'Source+Sans+Pro:wght@300' => 'Source Sans Pro - lighter',
        'Source+Sans+Pro:wght@400' => 'Source Sans Pro', // 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap' );
        'Titillium+Web' => 'Titillium Web',
        'Ubuntu' => 'Ubuntu',
        // serif
        'Domine' => 'Domine',
        'Frank+Ruhl+Libre' => 'Frank Ruhl Libre',
        'Ibarra+Real+Nova' => 'Ibarra Real Nova',
        'Kreon' => 'Kreon',
        'Markazi+Text' => 'Markazi Text',
        'Merriweather' => 'Merriweather',
        'Pridi' => 'Pridi',
        'Source+Serif+Pro' => 'Source Serif Pro',
    ];

    $style_choices = [
        // 'value1' => 'black',
        'w3-theme-amber.css' => 'amber',
        'w3-theme-black.css' => 'black',
        'w3-theme-blue.css' => 'blue',
        'w3-theme-blue-grey.css' => 'blue-grey',
        'w3-theme-brown.css' => 'brown',
        'w3-theme-cyan.css' => 'cyan',
        'w3-theme-dark-grey.css' => 'dark-grey',
        'w3-theme-deep-orange.css' => 'deep-orange',
        'w3-theme-deep-purple.css' => 'deep-purple',
        'w3-theme-green.css' => 'green',
        'w3-theme-grey.css' => 'grey',
        'w3-theme-indigo.css' => 'indigo',
        'w3-theme-khaki.css' => 'khaki',
        'w3-theme-light-blue.css' => 'light-blue',
        'w3-theme-light-green.css' => 'light-green',
        'w3-theme-lime.css' => 'lime',
        'w3-theme-orange.css' => 'orange',
        'w3-theme-pink.css' => 'pink',
        'w3-theme-purple.css' => 'purple',
        'w3-theme-red.css' => 'red',
        'w3-theme-teal.css' => 'teal',
        'w3-theme-yellow.css' => 'yellow',
        'w3-theme-my1.css' => 'my style 01',
        'w3-theme-my2.css' => 'my style 02',
    ];

    global $gamayun_slider_defaults;

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    $wp_customize->remove_section('colors');

    $wp_customize->add_section('mytheme_new_section_name', array(
        // 'title'      => 'Visible Section Name',
        'title' => 'Look',
        'priority' => 30,
    ));
    //select sanitization function
    function gamayun_sanitize_select($input, $setting)
    {
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        // $input = sanitize_key($input);
        //get the list of possible select options
        $choices = $setting->manager->get_control($setting->id)->choices;
        //return input if valid or return default option
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
    $wp_customize->add_setting('style_css', array(
        // 'default'     => 'value1',
        'default' => 'w3-theme-black.css',
        'transport' => 'refresh',
        'sanitize_callback' => 'gamayun_sanitize_select',
    ));
    $wp_customize->add_control('style_css', array(
        'label' => 'Select the color scheme.',
        'section' => 'mytheme_new_section_name',
        'type' => 'select',
        'choices' => $style_choices,
    ));

    $wp_customize->add_setting('page_width', array(
        // 'default'     => 'value1',
        'default' => '80',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ));
    $wp_customize->add_control('page_width', array(
        'label' => __('Page width %', 'gamayun'),
        'section' => 'mytheme_new_section_name',
        'type' => 'number',
        // 'priority' => 10,
        'input_attrs' => array(
            'min' => 50,
            'max' => 100,
            'step' => 10,
        ),
    ));

    $wp_customize->add_setting('Number_of_columns', array(
        // 'default'     => 'value1',
        'default' => '4',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ));
    $wp_customize->add_control('Number_of_columns', array(
        'label' => __('Number of columns to display on blog', 'gamayun'),
        'section' => 'mytheme_new_section_name',
        'type' => 'number',
        // 'priority' => 10,
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting('thumb_height', array(
        // 'default'     => 'value1',
        'default' => '80%',
        'transport' => 'refresh',
        'sanitize_callback' => 'gamayun_sanitize_select',
    ));
    $wp_customize->add_control('thumb_height', array(
        'label' => __('Height of thumbnail = % width', 'gamayun'),
        'section' => 'mytheme_new_section_name',
        'type' => 'select',
        'choices' => ['auto' => 'auto',
            '50%' => '50%',
            '60%' => '60%',
            '70%' => '70%',
            '80%' => '80%',
            '90%' => '90%',
            '100%' => '100%',
        ],
    ));

    $wp_customize->add_setting('excerpt_length', array(
        // 'default'     => 'value1',
        'default' => '20',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ));
    $wp_customize->add_control('excerpt_length', array(
        'label' => __('Number of word to display on excerpt', 'gamayun'),
        'section' => 'mytheme_new_section_name',
        'type' => 'number',
        // 'priority' => 10,
        'input_attrs' => array(
            'min' => 10,
            'max' => 100,
            'step' => 5,
        ),
    ));

    $wp_customize->add_section(
        'gamayun_typography',
        [
            'title' => __('Typography', 'gamayun'),
            'priority' => 39,
            'description' => __('Select your typography settings', 'gamayun'),
            'capability' => 'edit_theme_options',
        ]
    );
    $wp_customize->add_setting(
        'gamayun_headings_fonts',
        [
            // 'default'           => 'Cormorant+Garamond:ital,wght@1,700',
            'default' => 'Barlow+Condensed:ital@1',
            'type' => 'theme_mod',
            'sanitize_callback' => 'gamayun_sanitize_select',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]
    );
    $wp_customize->add_control(
        new \WP_Customize_Control(
            $wp_customize,
            'gamayun_headings_fonts',
            [
                'label' => __('Heading font', 'gamayun'),
                'description' => __('Select Google font for headings.', 'gamayun'),
                'section' => 'gamayun_typography',
                'settings' => 'gamayun_headings_fonts',
                'type' => 'select',
                'choices' => $font_heading_choices,
                'priority' => '2',
            ]
        )
    );
    $wp_customize->add_setting(
        'gamayun_body_fonts',
        [
            'default' => 'Source+Sans+Pro:wght@400',
            'type' => 'theme_mod',
            'sanitize_callback' => 'gamayun_sanitize_select',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]
    );
    $wp_customize->add_control(
        new \WP_Customize_Control(
            $wp_customize,
            'gamayun_body_fonts',
            [
                'label' => __('Body font', 'gamayun'),
                'description' => __('Select Google font for the body.', 'gamayun'),
                'section' => 'gamayun_typography',
                'settings' => 'gamayun_body_fonts',
                'type' => 'select',
                'choices' => $font_body_choices,
                'priority' => '3',
            ]
        )
    );

    $wp_customize->add_section('mytheme_slider_section_name', array(
        'title' => 'Header slider',
        'priority' => 40,
    ));
    $wp_customize->add_setting('slider', array(
        'default' => 'slider 1',
        'transport' => 'refresh',
        'sanitize_callback' => 'gamayun_sanitize_select',
    ));
    $wp_customize->add_control('slider', array(
        'label' => 'Enable slider.',
        'section' => 'mytheme_slider_section_name',
        'type' => 'select',
        'choices' => ['hide' => 'hide',
            'slider 1' => 'Slider 1',
            'slider 2' => 'Slider 2',
            'slider 3' => 'Slider 3',
        ],
    ));
    
/*     $wp_customize->add_setting('slider_height', array(
        'default' => '500',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ));
    $wp_customize->add_control('slider_height', array(
        'label' => __('Slider height, px', 'gamayun'),
        'section' => 'mytheme_slider_section_name',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 300,
            'max' => 1100,
            'step' => 50,
        ),
    ));
 */    
    $wp_customize->add_setting( 'slider_height', array(
        'default' => '500',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ) );
    $wp_customize->add_control( 'slider_height', array(
        'label' => __('Slider height', 'gamayun'),
		'section' => 'mytheme_slider_section_name',
        'type' => 'range',
        'input_attrs' => array(
            'min' => 300,
            'max' => 1100,
            'step' => 50,
            ),
    ));

    $wp_customize->add_setting( 'slider3_height_of_images', array(
        'default' => '300',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', //converts value to a non-negative integer
    ) );
    $wp_customize->add_control( 'slider3_height_of_images', array(
        'label' => __( 'Slider 3: image height', 'gamayun' ),
		'section' => 'mytheme_slider_section_name',
        'type' => 'range',
        'input_attrs' => array(
            'min' => 100,
            'max' => 500,
            'step' => 20,
            ),
    ));
    $wp_customize->add_setting(
        'slider3_number_of_images',
        [
            'default' => '3',
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ]
    );
    $wp_customize->add_control(
        'slider3_number_of_images',
        [
            'label' => __('Slider 3: number of images', 'gamayun'),
            'section' => 'mytheme_slider_section_name',
            'type' => 'number',
            'input_attrs' => [
                'min' => 2,
                'max' => 6,
                'step' => 1,
            ],
        ]
    );

    $wp_customize->add_setting('slider_display_post', array(
        'default' => 'random',
        'transport' => 'refresh',
        'sanitize_callback' => 'gamayun_sanitize_select',
    ));
    $wp_customize->add_control('slider_display_post', array(
        'label' => 'Display post.',
        'section' => 'mytheme_slider_section_name',
        'type' => 'select',
        'choices' => ['random' => 'random',
            'list' => 'List posts',
        ],
    ));
    $wp_customize->add_setting('slider_list_of_posts', array(
        'default' => 'id1, id2, id3...',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('slider_list_of_posts', array(
        'type' => 'text',
        'section' => 'mytheme_slider_section_name',
        'label' => __('List of posts: id1, id2, id3...', 'gamayun'),
        // 'description' => __( 'id1, id2, id3...' ),
    ));

    // -----------------------------------------------------
    // Add logo height to site identity panel
    // -----------------------------------------------------
    function gamayun_sanitize_float($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }
    $wp_customize->add_setting(
        'conversions_logo_height',
        [
            'default' => '4.5',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'gamayun_sanitize_float',
        ]
    );
    $wp_customize->add_control(
        'conversions_logo_height_control',
        [
            'label' => __('Logo height', 'gamayun'),
            // 'description' => __('Max logo height in rem', 'gamayun'),
            'section' => 'title_tagline',
            'settings' => 'conversions_logo_height',
            'priority' => 8,
            'type' => 'range',
            'input_attrs' => [
                'min' => 2,
                'max' => 5,
                'step' => 0.1,
            ],
        ]
    );

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector' => '.site-title a',
                'render_callback' => 'gamayun_01_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector' => '.site-description',
                'render_callback' => 'gamayun_01_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'gamayun_01_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gamayun_01_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gamayun_01_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gamayun_01_customize_preview_js()
{
    wp_enqueue_script('cd_customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery', 'customize-preview'), '', true);
}
add_action('customize_preview_init', 'gamayun_01_customize_preview_js');

function gamayun_get_font_weight($google_fonts)
{
    if (strpos($google_fonts, 'wght@1,') != false) {
        $n = strrpos($google_fonts, ',');
        return substr($google_fonts, $n + 1);
    } elseif (strpos($google_fonts, 'wght@') != false) {
        $n = strpos($google_fonts, '@');
        return substr($google_fonts, $n + 1);
    } else {
        return 'normal';
    }
}
function gamayun_get_font_style($google_fonts)
{
    if (strpos($google_fonts, 'ital') != false) {
        return 'italic';
    } else {
        return 'normal';
    }
}
add_action('wp_head', 'gamayun_customizer_css');
function gamayun_customizer_css()
{
// Header font styles
    $google_fonts = get_theme_mod('gamayun_headings_fonts', 'Barlow+Condensed:ital@1'); // Get the user choices.
    $headerFont = explode(':', $google_fonts)[0]; // Get the font family name to use
    $headerFont = str_replace("+", " ", $headerFont);
    $styles = "h1, h2, h3, h4, h5, h6 {";
    $styles .= "font-family:'" . $headerFont . "';";
    $styles .= "font-weight:" . gamayun_get_font_weight($google_fonts) . ";";
    $styles .= "font-style:" . gamayun_get_font_style($google_fonts) . ";";
    $styles .= "}";
    echo '<style type="text/css">' . wp_kses_post($styles) . '</style>';

// Body font styles
    $google_fonts = get_theme_mod('gamayun_body_fonts', 'Source+Sans+Pro:wght@400');
    $bodyFont = explode(':', $google_fonts)[0]; // Get the font family name to use
    $bodyFont = str_replace("+", " ", $bodyFont);
    $styles = "body {";
    $styles .= "font-family:'" . $bodyFont . "';";
    $styles .= "font-weight:" . gamayun_get_font_weight($google_fonts) . ";";
    $styles .= "font-style:" . gamayun_get_font_style($google_fonts) . ";";
    $styles .= "}";
    echo '<style type="text/css">' . wp_kses_post($styles) . '</style>';

    $logo_height = get_theme_mod('conversions_logo_height', '4.5');

    $thumbHeight = get_theme_mod('thumb_height', '80%');
    if ($thumbHeight != 'auto'){
        $thumb_styles = ".blog .post-thumbnail, .archive .post-thumbnail, .search .post-thumbnail {";
        $thumb_styles .= "position: relative;";    
        $thumb_styles .= "width: 100%;";    
        $thumb_styles .= "display: block;";    
        $thumb_styles .= "padding-top: " . $thumbHeight; 
        $thumb_styles .= "}";
        $thumb_styles .= ".blog .post-thumbnail img, .archive .post-thumbnail img, .search .post-thumbnail img {";
        $thumb_styles .= "position: absolute;";
        $thumb_styles .= "top: 0;";
        $thumb_styles .= "height: 100%;";
        $thumb_styles .= "}";
        echo '<style type="text/css">' . wp_kses_post($thumb_styles) . '</style>';
    }

    $slider_Height = get_theme_mod('slider_height', '500');
    $sliderH_styles = ".slick-carousel {";  //slider 3
    $sliderH_styles .= "height:" .  $slider_Height . 'px;';
    $sliderH_styles .= "}";
    $sliderH_styles .= ".hero .skippr{";    // slider 2
    $sliderH_styles .= "height:" .  $slider_Height . 'px;';
    $sliderH_styles .= "}";
    $sliderH_styles .= ".mySlides img {";    // slider 1
    $sliderH_styles .= "height:" .  $slider_Height . 'px;';
    $sliderH_styles .= "}";
    echo '<style type="text/css">' . wp_kses_post($sliderH_styles) . '</style>';

    $slider3_Height = get_theme_mod('slider3_height_of_images', '300');
    $slider3_styles = ".slick-carousel .slide img {";  //slider 3
    $slider3_styles .= "height:" .  $slider3_Height . 'px;';
    $slider3_styles .= "}";
    echo '<style type="text/css">' . wp_kses_post($slider3_styles) . '</style>';

    ?>
         <style type="text/css">
             :root { --page-width: <?php echo esc_attr(get_theme_mod('page_width', '80')) . '%'; ?>; }
             :root { --logo-height: <?php echo esc_html($logo_height . 'rem'); ?>; }
         </style>
    <?php

}
