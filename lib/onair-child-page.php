<?php 

/**
* Template Name: OnAir Child Template
*/

add_action('genesis_loop', 'elements_loop');

function elements_loop(){

	$elemnent_args = array(
		'post_type'  => 'onair_elements',
		'posts_per_page' => '12',
	);

	$onairelements = new WP_Query($elemnent_args);
	if(($onairelements -> have_posts()) && (is_page( 60 ))) {
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

	$structure_args = array(
		'post_type'  => 'onair_structures',
		'posts_per_page' => '12',
	);

	$onairstructures = new WP_Query($structure_args);
	if(($onairstructures -> have_posts()) && (is_page( 63 ))) {
		while($onairstructures -> have_posts()): $onairstructures ->the_post();

		echo '<section id="';
		echo the_field('id').'" class="post-list-item" data-sidebar-text="';
		echo the_field('sidebar_text') .'">'; /* opening list item tag */
		echo '<h3 class="title">';
		echo the_title() .'</h3>';
		echo '<span class="description">';
		echo the_field('description') .'</span>';
		
		echo '<span class="body-content">';
		echo the_field('body_content') .'</span>';

		$file = get_field('download_link');
		// echo '<span class="downloadlink">';
		// echo $file[url] .'</span>';

		echo '<span class="downloadlink"><a href="';
		echo $file .'" target="_blank"><button type="submit">Download!</button></a></span>';

		echo edit_post_link( $link, $class );
		// echo edit_post_link('Edit this', '<p>', '</p>');
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