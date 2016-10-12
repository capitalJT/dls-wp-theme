<?php 

/**
* Template Name: Digital Template
*/

add_action('genesis_loop', 'digital_loop');

function digital_loop(){


	/* START - Digital Page Sections */
	$digital_args = array(
		'post_type'  => 'digital_pg_sections',
		'posts_per_page' => '12',
	);

	$digitalsections = new WP_Query($digital_args);
	if(($digitalsections -> have_posts()) && (is_page( 'digital' ))) {
		while($digitalsections -> have_posts()): $digitalsections ->the_post();
		
			$description = get_field('description');
			$downloadLink = get_field('download_link');
			$downloadCTA = "Download!";

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<?php  
				if ($description){ ?>
					<span class="description"><?php echo $description;?></span>
				<?php
				}
			?>
			
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($downloadLink){ ?>
					<span class="downloadlink">
						<a href="<?php echo $downloadLink;?>" target="_blank">
							<button type="submit"><?php echo $downloadCTA; ?></button>
						</a>
					</span>
				<?php
				}
			?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - Digital Page Sections */

	/* START - Digital Elements */
	$elements_args = array(
		'post_type'  => 'digital_elements',
		'posts_per_page' => '12',
	);

	$digitalelements = new WP_Query($elements_args);
	if(($digitalelements -> have_posts()) && (is_page( 102 ))) {
		while($digitalelements -> have_posts()): $digitalelements ->the_post();
			
			$description = get_field('description');
			$downloadLink = get_field('download_link');
			$downloadCTA = "Download!";

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<?php  
				if ($description){ ?>
					<span class="description"><?php echo $description;?></span>
				<?php
				}
			?>
			
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($downloadLink){ ?>
					<span class="downloadlink">
						<a href="<?php echo $downloadLink;?>" target="_blank">
							<button type="submit"><?php echo $downloadCTA; ?></button>
						</a>
					</span>
				<?php
				}
			?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - Digital Elements */

	/* START - Digital Components */
	$components_args = array(
		'post_type'  => 'digital_components',
		'posts_per_page' => '12',
	);

	$digitalcomponents = new WP_Query($components_args);
	if(($digitalcomponents -> have_posts()) && (is_page( 104 ))) {
		while($digitalcomponents -> have_posts()): $digitalcomponents ->the_post();

			$description = get_field('description');
			$downloadLink = get_field('download_link');
			$downloadCTA = "Download!";

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<?php  
				if ($description){ ?>
					<span class="description"><?php echo $description;?></span>
				<?php
				}
			?>
			
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($downloadLink){ ?>
					<span class="downloadlink">
						<a href="<?php echo $downloadLink;?>" target="_blank">
							<button type="submit"><?php echo $downloadCTA; ?></button>
						</a>
					</span>
				<?php
				}
			?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - Digital Components */

	/* START - Digital Templates */
	$templates_args = array(
		'post_type'  => 'digital_templates',
		'posts_per_page' => '12',
	);

	$digitaltemplates = new WP_Query($templates_args);
	if(($digitaltemplates -> have_posts()) && (is_page( 107 ))) {
		while($digitaltemplates -> have_posts()): $digitaltemplates ->the_post();

			$description = get_field('description');
			$downloadLink = get_field('download_link');
			$downloadCTA = "Download!";

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<?php  
				if ($description){ ?>
					<span class="description"><?php echo $description;?></span>
				<?php
				}
			?>
			
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($downloadLink){ ?>
					<span class="downloadlink">
						<a href="<?php echo $downloadLink;?>" target="_blank">
							<button type="submit"><?php echo $downloadCTA; ?></button>
						</a>
					</span>
				<?php
				}
			?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - Digital Templates */

		/* START - Digital Resources */
	$resources_args = array(
		'post_type'  => 'digital_resources',
		'posts_per_page' => '12',
	);

	$digitalresources = new WP_Query($resources_args);
	if(($digitalresources -> have_posts()) && (is_page( 109 ))) {
		while($digitalresources -> have_posts()): $digitalresources ->the_post();

			$description = get_field('description');
			$downloadLink = get_field('download_link');
			$downloadCTA = "Download!";

		?>
		
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<?php  
				if ($description){ ?>
					<span class="description"><?php echo $description;?></span>
				<?php
				}
			?>
			
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($downloadLink){ ?>
					<span class="downloadlink">
						<a href="<?php echo $downloadLink;?>" target="_blank">
							<button type="submit"><?php echo $downloadCTA; ?></button>
						</a>
					</span>
				<?php
				}
			?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>

		<?php

		endwhile;
	}
	/* END - Digital Resources */
}

// remove Primary Sidebar from the Primary Sidebar area
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Digital custom menu
add_action( 'genesis_after_header', 'dls_digital_menu' );
function dls_digital_menu() {
    genesis_widget_area( 'digital-menu', array(
		'before' => '<div class="dls-menu digital-menu second-level-menu widget-area"><div class="wrap">',
		'after'  => '</div></div>', 
	) );
}

// Digital custom sidebar
add_action( 'genesis_after_content', 'dls_digital_sidebar' );
function dls_digital_sidebar() {
    genesis_widget_area( 'digital-sidebar', array(
		'before' => '<aside class="dls-sidebar digital-sidebar sidebar sidebar-primary widget-area"><div class="wrap">',
		'after'  => '</div></aside>', 
	) );
}

genesis();