<?php 

/**
* Template Name: Elements
*/

add_action('genesis_loop', 'components_loop');

function components_loop(){

	$args = array(
		'post_type'  => 'elements',
		'posts_per_page' => '12',
	);

	$mycomponents = new WP_Query($args);

	if($mycomponents -> have_posts()) {
		while($mycomponents -> have_posts()): $mycomponents ->the_post();

		echo '<div id="';
		echo the_field('id').'" class="component-list-item">'; /* opening list item tag */
		echo '<h3 class="component-title">';
		echo the_title() .'</h3>';
		echo '<span class="description">';
		echo the_field('description') .'</span>';
		echo '<span class="snippet">';
		echo the_field('snippet') .'</span>';
		echo '</div>'; /* closing list item tag*/

		endwhile;
	}
}

// remove Primary Sidebar from the Primary Sidebar area
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

add_action( 'genesis_after_content', 'childtextdomain_about_widget_area' );
function childtextdomain_about_widget_area() {

    genesis_widget_area( 'elements-sidebar', array(
		'before' => '<aside class="elements-sidebar widget-area"><div class="wrap">',
		'after'  => '</div></aside><script src="'. get_stylesheet_directory_uri() .'/js/app.js"></script>', 
	) );  
}
genesis();