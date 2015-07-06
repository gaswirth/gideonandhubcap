<?php
/**
 * Bloggy Child
 *
 * ROUNDHOUSE DESIGNS
 *
 * @package WordPress
 * @subpackage rhd
 **/

/* ==========================================================================
   Initialization
   ========================================================================== */

define( 'RHD_CHILD_DIR', get_stylesheet_directory_uri() );


// Enqueue Parent Theme
add_action( 'wp_enqueue_scripts', 'rhd_theme_enqueue_styles' );
function rhd_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', RHD_THEME_DIR . '/style.css' );
    wp_enqueue_style( 'child-main', RHD_CHILD_DIR . '/css/main.css', array( 'rhd-main' ) );
}

add_action( 'wp_enqueue_scripts', 'rhd_theme_enqueue_scripts' );
function rhd_theme_enqueue_scripts() {
	wp_enqueue_script( 'child-main', RHD_CHILD_DIR . '/js/child-main.js', array( 'jquery', 'rhd-main' ), null, true );

    // Localize data for client-side use
	global $wp_query;
	$data = array(
		'home_url' => home_url(),
		'parent_dir' => RHD_THEME_DIR,
		'child_dir' => get_stylesheet_directory_uri(),
		'img_dir' => get_stylesheet_directory_uri() . '/img',
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'query_vars' => json_encode( $wp_query->query ),
		'inc_slidebars' => ( $theme_opts['rhd_include_slidebars'] == '1' ) ? true : false,
		'inc_packery' => ( $theme_opts['rhd_include_packery'] == '1' ) ? true : false
	);
	wp_localize_script( 'child-main', 'wp_child_data', $data);
}

/*
add_action( 'wp_enqueue_scripts', 'rhd_override_scripts' );
function rhd_override_scripts() {
	wp_dequeue_script( 'ajax-loop' );
	wp_enqueue_script( 'ajax-loop', RHD_CHILD_DIR . '/js/ajax-loop.js', array( 'jquery' ), null, true );

	// Localize template dirs
	global $wp_query;
	$data = array(
		'template_url' => get_stylesheet_directory_uri(),
		'parent_url' => get_template_directory_uri()
	);
	wp_localize_script( 'ajax-loop', 'wp_child_data', $data);
}
*/


/**
 * Function: rhd_favicons
 *
 * Outputs default favicon linkage, generated by http://realfavicongenerator.net/
 **/
function rhd_favicons() {
	echo '
		<link rel="shortcut icon" href="' . RHD_CHILD_DIR . '/favicon/favicon.ico">
		<link rel="apple-touch-icon" sizes="57x57" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="' . RHD_CHILD_DIR . '/favicon/apple-touch-icon-152x152.png">
		<link rel="icon" type="image/png" href="' . RHD_CHILD_DIR . '/favicon/favicon-196x196.png" sizes="196x196">
		<link rel="icon" type="image/png" href="' . RHD_CHILD_DIR . '/favicon/favicon-160x160.png" sizes="160x160">
		<link rel="icon" type="image/png" href="' . RHD_CHILD_DIR . '/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="' . RHD_CHILD_DIR . '/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="' . RHD_CHILD_DIR . '/favicon/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="' . RHD_CHILD_DIR . '/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="' . RHD_CHILD_DIR . '/favicon/browserconfig.xml">
	';
}
add_action( 'wp_head', 'rhd_favicons' );


/* ==========================================================================
	Functions
   ========================================================================== */