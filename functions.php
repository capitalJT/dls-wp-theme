<?php
/**
 * DLS Theme.
 *
 * This file adds functions to the DLS Theme Theme.
 *
 * @package DLS Theme
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.jabaltorres.com/
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
define( 'CHILD_THEME_URL', 'http://www.jabaltorres.com/' );
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
	  <div class="icon-ajmn-search"></div>
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

//* Remove the site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Customize the site footer - Remove this if you don't need it
add_action( 'genesis_footer', 'bg_custom_footer' );
function bg_custom_footer() { ?>

	<div class="site-footer"><div class="wrap"><p>Handcrafted with <span class="dashicons dashicons-smiley"></span> by Jabal Torres. Powered by the <a href="#">DLS Platform</a>. <a href="http://jabaltorres.com/">Get in Touch</a>.</p></div></div>

<?php
}


// Custom Dashboard Widget
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
	function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p>Welcome to Al Jazeera DLS Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>.</p>';
}

/*
* # Field Groups - Contents
* - Homepage Sections
* - Digital Page Sections
* - - Digital Resources
* - - Digital Templates
* - - Digital Components
* - - Digital Elements
* - Print Page Sections
* - On-Air Page Sections
* - - On-Air Demos
* - - On-Air Structures
* - - On-Air Elements
*/

if(function_exists("register_field_group"))
{
  // - Homepage Sections
  register_field_group(array (
    'id' => 'acf_homepage-sections',
    'title' => 'Homepage Sections',
    'fields' => array (
      array (
        'key' => 'field_57f666062d473',
        'label' => 'Section One Title',
        'name' => 'section_one_title',
        'type' => 'text',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'Digital',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f66e43ba5b7',
        'label' => 'Section One Anchor',
        'name' => 'section_one_anchor',
        'type' => 'text',
        'instructions' => 'Enter page this section links to',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f674d942ccd',
        'label' => 'Section One Blurb',
        'name' => 'section_one_blurb',
        'type' => 'text',
        'instructions' => 'Section blurb',
        'default_value' => '',
        'placeholder' => 'UI and UX area',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f675b942cd0',
        'label' => 'Section One BGimg',
        'name' => 'section_one_bgimg',
        'type' => 'file',
        'instructions' => 'Section background image',
        'required' => 1,
        'save_format' => 'url',
        'library' => 'all',
      ),
      array (
        'key' => 'field_57f863603824b',
        'label' => 'Section One CTA',
        'name' => 'section_one_cta',
        'type' => 'text',
        'instructions' => 'Enter brief CTA text',
        'default_value' => 'go to resources',
        'placeholder' => '(e.g. Learn More ->)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f66703e97df',
        'label' => 'Section Two Title',
        'name' => 'section_two_title',
        'type' => 'text',
        'instructions' => 'Title for section two',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'Print',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f6751942cce',
        'label' => 'Section Two Blurb',
        'name' => 'section_two_blurb',
        'type' => 'text',
        'instructions' => 'Section blurb',
        'default_value' => '',
        'placeholder' => 'Print and Design area',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f6761542cd1',
        'label' => 'Section Two BGimg',
        'name' => 'section_two_bgimg',
        'type' => 'file',
        'instructions' => 'Section background image',
        'required' => 1,
        'save_format' => 'url',
        'library' => 'all',
      ),
      array (
        'key' => 'field_57f863eb3824c',
        'label' => 'Section Two CTA',
        'name' => 'section_two_cta',
        'type' => 'text',
        'instructions' => 'Enter brief CTA text',
        'default_value' => 'go to resources',
        'placeholder' => '(e.g. Learn More ->)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f66ea3ba5b9',
        'label' => 'Section Two Anchor',
        'name' => 'section_two_anchor',
        'type' => 'text',
        'instructions' => 'Enter page this section links to',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f667d75b198',
        'label' => 'Section Three Title',
        'name' => 'section_three_title',
        'type' => 'text',
        'instructions' => 'Title for section three',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'On-Air',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f66ecaba5ba',
        'label' => 'Section Three Anchor',
        'name' => 'section_three_anchor',
        'type' => 'text',
        'instructions' => 'Enter page this section links to',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f6756442ccf',
        'label' => 'Section Three Blurb',
        'name' => 'section_three_blurb',
        'type' => 'text',
        'instructions' => 'Section blurb',
        'default_value' => '',
        'placeholder' => 'Footage and Graphics area',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f6763042cd2',
        'label' => 'Section Three BGimg',
        'name' => 'section_three_bgimg',
        'type' => 'file',
        'instructions' => 'Section background image',
        'required' => 1,
        'save_format' => 'url',
        'library' => 'all',
      ),
      array (
        'key' => 'field_57f864043824d',
        'label' => 'Section Three CTA',
        'name' => 'section_three_cta',
        'type' => 'text',
        'instructions' => 'Enter brief CTA text',
        'default_value' => 'go to resources',
        'placeholder' => '(e.g. Learn More ->)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'home_page_sections',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - Digital Page Sections
  register_field_group(array (
    'id' => 'acf_digital-page-sections',
    'title' => 'Digital Page Sections',
    'fields' => array (
      array (
        'key' => 'field_57f9721393682',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f9724393683',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f9726e93684',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f974f593685',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f976a993852',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f9773ff061a',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'digital_pg_sections',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
  
  // - Digital Resources
  register_field_group(array (
    'id' => 'acf_digital-resources',
    'title' => 'Digital Resources',
    'fields' => array (
      array (
        'key' => 'field_58005c18d62d6',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_58005cc8d62d7',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_58005d32d62d8',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_58005d94d62d9',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_58005e06d62da',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_58005ed9d62db',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => ' Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'digital_resources',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - Digital Templates
  register_field_group(array (
    'id' => 'acf_digital-templates',
    'title' => 'Digital Templates',
    'fields' => array (
      array (
        'key' => 'field_580053c3fd9bf',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_5800549afd9c0',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_58005543fd9c1',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5800557dfd9c2',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_580055bdfd9c3',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_580055e7fd9c4',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'digital_templates',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - Digital Components
  register_field_group(array (
    'id' => 'acf_digital-components',
    'title' => 'Digital Components',
    'fields' => array (
      array (
        'key' => 'field_57ff5ce448ac3',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57ff5d2748ac4',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57ff5d5548ac5',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff5db348ac6',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff5f8e48ac7',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff603348ac8',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'digital_components',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - Digital Elements
  register_field_group(array (
    'id' => 'acf_digital-elements',
    'title' => 'Digital Elements',
    'fields' => array (
      array (
        'key' => 'field_57ff32bf4d37f',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57ff33274d380',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57ff33964d381',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff340b4d382',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff345c4d383',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57ff349b4d384',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'digital_elements',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - Print Page Sections
  register_field_group(array (
    'id' => 'acf_print-page-sections',
    'title' => 'Print Page Sections',
    'fields' => array (
      array (
        'key' => 'field_57f98a6433610',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f98ade33611',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f98b2933612',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f98b6a33613',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f98b9233614',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f98bbb33615',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'print_page_sections',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - On-Air Page Sections
  register_field_group(array (
    'id' => 'acf_on-air-page-sections',
    'title' => 'On-Air Page Sections',
    'fields' => array (
      array (
        'key' => 'field_57f282a4351b8',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f282bd351b9',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f282d9351ba',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f93a69774c7',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57fdfc580dc77',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f93b0c774c8',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https://www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'onair_page_sections',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - On-Air Demos
  register_field_group(array (
    'id' => 'acf_on-air-demos',
    'title' => 'On-Air Demos',
    'fields' => array (
      array (
        'key' => 'field_57f64c201166e',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f64c601166f',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f64cb711670',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f64ceb11671',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f64d3111672',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f64d6e11673',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'onair_demos',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - On-Air Structures
  register_field_group(array (
    'id' => 'acf_on-air-structures',
    'title' => 'On-Air Structures',
    'fields' => array (
      array (
        'key' => 'field_57f2d518a6b7a',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f2d540a6b7b',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f2d569a6b7c',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f62694d53f8',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57fab7f4abd39',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f2ee329ae24',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'onair_structures',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));

  // - On-Air Elements
  register_field_group(array (
    'id' => 'acf_on-air-elements',
    'title' => 'On-Air Elements',
    'fields' => array (
      array (
        'key' => 'field_57f2937af6729',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'instructions' => 'Optional description field. Formatting will convert HTML into tags.',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_57f2938bf672a',
        'label' => 'Body Content',
        'name' => 'body_content',
        'type' => 'wysiwyg',
        'instructions' => 'This field will accept plain text, formatted text, and HTML markup. Wrap inline elements in classless div to prevent auto p and br tags.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_57f293c7f672b',
        'label' => 'Section ID',
        'name' => 'id',
        'type' => 'text',
        'instructions' => 'A unique ID is needed for the sidebar anchor list. Whitespace is not allowed. The ID must be lowercased and as few words as possible. If the ID is more than one word it must be a hyphenated compound.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f29405f672c',
        'label' => 'Sidebar Text',
        'name' => 'sidebar_text',
        'type' => 'text',
        'instructions' => 'This is the anchor / link text that gets appended to the sidebar. Be as concise as possible.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f9356a27471',
        'label' => 'Class List',
        'name' => 'class_list',
        'type' => 'text',
        'instructions' => 'Add classes to extend predefined style rules. Consider object oriented CSS. Class names are separated by whitespace.',
        'default_value' => '',
        'placeholder' => '(e.g. has-dropshadow)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57f935e727472',
        'label' => 'Download Link',
        'name' => 'download_link',
        'type' => 'text',
        'instructions' => 'Add URI to a downloadable file. Zip files are currently preferred.',
        'default_value' => '',
        'placeholder' => '(e.g. https:// -www.dropbox.com/downloadable-file.zip?dl=0)',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'onair_elements',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'custom_fields',
        3 => 'discussion',
        4 => 'comments',
        5 => 'format',
        6 => 'featured_image',
        7 => 'categories',
        8 => 'tags',
        9 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
}