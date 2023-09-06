<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
define( 'TEXT_DOMAIN', 'understrap' );
define( 'PATH_TO_INCLUDES', get_stylesheet_directory() . '/includes/' );

include_once( PATH_TO_INCLUDES . 'real-estate-cpt.php' );

/**
 * dd function
*/
function dd ($element) {
    echo '<pre>';
    var_dump($element);
    echo '</pre>';
    die();
}



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    $variables = [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'realestate-filter-nonce' ),
    ];
    wp_localize_script('child-understrap-scripts', "frontAjax", $variables);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );


/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

function real_estate_posts() {
    $args = [
        'post_type' => 'real_estate',
        'posts_per_page' => -1
    ];

    return new WP_Query($args);
}


function custom_filter_function() {
    $nonce = $_REQUEST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'realestate-filter-nonce' ) ) {
        wp_die( 'Stop! Doesn’t work ajax function' );
    }
    $number_floors = $_REQUEST['numberFloors'];
    $type_house = $_REQUEST['typeHouse'];
    $prefix = 'real_estate_parameters_';

    $args = array(
        'post_type' => 'real_estate',
        'posts_per_page' => -1,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => $prefix . 'number_of_floors',
                'value' => $number_floors,
                'compare' => 'LIKE',
            ],
            [
                'key' => $prefix . 'building_type',
                'value' => $type_house,
                'compare' => 'LIKE',
            ]
        ]

    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part( 'loop-templates/content', 'real-estate' );
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Співпадінь немає.';
    endif;

    wp_die();
}

add_action('wp_ajax_real_estate_filter', 'custom_filter_function');
add_action('wp_ajax_nopriv_real_estate_filter', 'custom_filter_function');


