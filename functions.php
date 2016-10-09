<?php
/**
 * DLS Theme.
 *
 * This file adds functions to the DLS Theme Theme.
 *
 * @package DLS Theme
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'DLS Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.4' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/stylesheets/screen.css', array(), PARENT_THEME_VERSION );wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/stylesheets/screen.css', array(), PARENT_THEME_VERSION );

	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'dls-scripts', get_stylesheet_directory_uri() . '/js/app.js', array( 'jquery' ), '1.0.0', true );

	$output = array(
		'mainMenu' => __( 'Menu', 'genesis-sample' ),
		'subMenu'  => __( 'Menu', 'genesis-sample' ),
	);
	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'default-image' => get_stylesheet_directory_uri() . '/images/AJMN-logo.png',
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => true,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

/**
 * Rewrite the site header to include an image
 */
remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'jt_header_image' );
function jt_header_image() {
	$name = get_bloginfo('name');
	$url = get_bloginfo('url');
	// $description = get_bloginfo('description');
	// echo '<div class="site-description">'. $description .'</div>';
	?>
	
	<div class="logo-wrapper">
		<a href="<?php echo $url; ?>">
			<img class="site-logo" src="<?php echo get_stylesheet_directory_uri();?>/images/AJMN-logo.png" alt="AJMN Logo">
			<div class="site-name"><?php echo $name; ?></div>
		</a>
	</div>

	<button type="button" data-toggle="collapse" data-target="#searchbar-collapse" class="searchbar-toggle">
	  <div class="ajmn-search"></div>
	</button>

	<div id="searchbar-collapse" class="site-search search-collapse"><?php echo get_search_form( $echo ); ?></div>

	<?php
}

// digital-menu widget
genesis_register_widget_area( array(
	'id'          => 'digital-menu',
	'name'        => __( 'Digital Menu', 'DLS Theme' ),
	'description' => __( 'This is the Digital	menu', 'DLS Theme' ),
) );
// digital-sidebar widget
genesis_register_widget_area( array(
	'id'          => 'digital-sidebar',
	'name'        => __( 'Digital Side Bar', 'DLS Theme' ),
	'description' => __( 'This widget area appears next to the content in the Digital Page Template', 'DLS Theme' ),
) );

// print-menu widget
genesis_register_widget_area( array(
	'id'          => 'print-menu',
	'name'        => __( 'Print Menu', 'DLS Theme' ),
	'description' => __( 'This is the print menu', 'DLS Theme' ),
) );
// print-sidebar widget
genesis_register_widget_area( array(
	'id'          => 'print-sidebar',
	'name'        => __( 'Print Sidebar', 'DLS Theme' ),
	'description' => __( 'This is the print sidebar', 'DLS Theme' ),
) );

// onair-menu widget
genesis_register_widget_area( array(
	'id'          => 'onair-menu',
	'name'        => __( 'On-Air Menu', 'DLS Theme' ),
	'description' => __( 'This is the on-air menu', 'DLS Theme' ),
) );
// onair-sidebar widget
genesis_register_widget_area( array(
	'id'          => 'onair-sidebar',
	'name'        => __( 'On-Air Side Bar', 'DLS Theme' ),
	'description' => __( 'This widget area appears next to the content in the On-Air Page Template', 'DLS Theme' ),
) );

// add_filter( 'the_content', 'disable_wpautop_cpt', 0 );
// function disable_wpautop_cpt( $content ) {
//   'onair_structures' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
//   return $content;
// }


//* Remove the site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
//* Customize the site footer
add_action( 'genesis_footer', 'bg_custom_footer' );
function bg_custom_footer() { ?>

	<div class="site-footer"><div class="wrap"><p>Handcrafted with <span class="dashicons dashicons-smiley"></span> by Jaballion. Powered by the <a href="#">DLS Platform</a>. <a href="http://briangardner.com/contact/">Get in Touch</a>.</p></div></div>

<?php
}
