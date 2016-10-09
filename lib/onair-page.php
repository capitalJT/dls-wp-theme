<?php 

/**
* Template Name: OnAir Template
*/

add_action('genesis_loop', 'onair_loop');

function onair_loop(){


	/* START - On-Air Page Sections */
	$onair_args = array(
		'post_type'  => 'onair_page_sections',
		'posts_per_page' => '12',
	);

	$onairsections = new WP_Query($onair_args);
	if(($onairsections -> have_posts()) && (is_page( 31 ))) {
		while($onairsections -> have_posts()): $onairsections ->the_post();
		$file = get_field('download_link');
		?>

		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<span class="description"><?php echo the_field('description');?></span>
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<span class="downloadlink">
				<a href="<?php echo $file;?>" target="_blank">
					<button type="submit">Download!</button>
				</a>
			</span>
			<?php echo edit_post_link( $link, $class ); ?>
		</section>

		<?php
		endwhile;
	}
	/* END - On-Air Page Sections */

	/* START - On-Air Elements */
	$elements_args = array(
		'post_type'  => 'onair_elements',
		'posts_per_page' => '12',
	);

	$onairelements = new WP_Query($elements_args);
	if(($onairelements -> have_posts()) && (is_page( 60 ))) {
		while($onairelements -> have_posts()): $onairelements ->the_post();
		$file = get_field('download_link');
		?>

		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<span class="description"><?php echo the_field('description');?></span>
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<span class="downloadlink">
				<a href="<?php echo $file;?>" target="_blank">
					<button type="submit">Download!</button>
				</a>
			</span>
			<?php echo edit_post_link( $link, $class ); ?>
		</section>

		<?php
		endwhile;
	}
	/* END - On-Air Elements */

	/* START - On-Air Structures */
	$structures_args = array(
		'post_type'  => 'onair_structures',
		'posts_per_page' => '12',
	);

	$onairstructures = new WP_Query($structures_args);
	if(($onairstructures -> have_posts()) && (is_page( 63 ))) {
		while($onairstructures -> have_posts()): $onairstructures ->the_post();

		$file = get_field('download_link');

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<span class="description"><?php echo the_field('description');?></span>
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<span class="downloadlink">
				<a href="<?php echo $file;?>" target="_blank">
					<button type="submit">Download!</button>
				</a>
			</span>
			<?php echo edit_post_link( $link, $class ); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - On-Air Structures */

	/* START - On-Air Demos */
	$demos_args = array(
		'post_type'  => 'onair_demos',
		'posts_per_page' => '12',
	);

	$onairdemos = new WP_Query($demos_args);
	if(($onairdemos -> have_posts()) && (is_page( 65 ))) {
		while($onairdemos -> have_posts()): $onairdemos ->the_post();

		$file = get_field('download_link');

		?>

		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<span class="description"><?php echo the_field('description');?></span>
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<span class="downloadlink">
				<a href="<?php echo $file;?>" target="_blank">
					<button type="submit">Download!</button>
				</a>
			</span>
			<?php echo edit_post_link( $link, $class ); ?>
		</section>

		<?php

		// echo edit_post_link( $link, $class );
		// echo edit_post_link('Edit this', '<p>', '</p>');
		endwhile;
	}
	/* END - On-Air Demos */
}

// remove Primary Sidebar from the Primary Sidebar area
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// On-Air custom menu
add_action( 'genesis_after_header', 'dls_onair_menu' );
function dls_onair_menu() {
    genesis_widget_area( 'onair-menu', array(
		'before' => '<div class="dls-menu onair-menu second-level-menu widget-area"><div class="wrap">',
		'after'  => '</div></div>', 
	) );
}

// On-Air custom sidebar
add_action( 'genesis_after_content', 'dls_onair_sidebar' );
function dls_onair_sidebar() {
    genesis_widget_area( 'onair-sidebar', array(
		'before' => '<aside class="dls-sidebar onair-sidebar sidebar sidebar-primary widget-area"><div class="wrap">',
		'after'  => '</div></aside>', 
	) );  
}

genesis();