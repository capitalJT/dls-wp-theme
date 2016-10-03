<?php 

/**
* Template Name: OnAir Child Template
*/

add_action('genesis_loop', 'elements_loop');

function elements_loop(){

	$args = array(
		'post_type'  => 'onair_elements',
		'posts_per_page' => '12',
	);

	$onairelements = new WP_Query($args);

	if($onairelements -> have_posts()) {
		while($onairelements -> have_posts()): $onairelements ->the_post();

		echo '<section id="';
		echo the_field('id').'" class="post-list-item" data-sidebar-text="';
		echo the_field('sidebar_text') .'">'; /* opening list item tag */
		echo '<h3 class="title">';
		echo the_title() .'</h3>';
		echo '<span class="description">';
		echo the_field('description') .'</span>';
		echo '<span class="body-content">';
		echo the_field('body_content') .'</span>';
		echo '</section>'; /* closing list item tag*/

		endwhile;
	}
}


// remove Primary Sidebar from the Primary Sidebar area
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

add_action( 'genesis_after_header', 'dls_onair_menu' );
function dls_onair_menu() {
    genesis_widget_area( 'onair-menu', array(
		'before' => '<div class="onair-menu widget-area"><div class="wrap">',
		'after'  => '</div></div>', 
	) );
}

add_action( 'genesis_after_content', 'dls_onair_sidebar' );
function dls_onair_sidebar() {
    genesis_widget_area( 'onair-sidebar', array(
		'before' => '<aside class="onair-sidebar sidebar sidebar-primary widget-area"><div class="wrap">',
		'after'  => '</div></aside>', 
	) );  
}
genesis();