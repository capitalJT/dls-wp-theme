<?php
/**
 * This file adds the Single Post Template to any Genesis child theme.
 *
 * @author Jabal Torres
 * @example  http://jabaltorres.com/
 * @copyright 2016 Jabal Torres
 */
//* Add custom body class to the head
add_filter( 'body_class', 'single_posts_body_class' );
function single_posts_body_class( $classes ) {
   $classes[] = 'custom-single';
   return $classes;
   
}
// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action('genesis_entry_content', 'dls_single_loop');
function dls_single_loop(){
	if ( is_singular() ) {?>
		<section id="<?php echo the_field('id');?>" class="post-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h3 class="title"><?php echo the_title();?></h3>
			<span class="description"><?php echo the_field('description');?></span>
			<span class="body-content"><?php echo the_field('body_content');?></span>
			<?php  
				if ($file){ ?>
					<span class="downloadlink">
						<a href="<?php echo $file;?>" target="_blank">
							<button type="submit">Download!</button>
						</a>
					</span>
					<?php
				}
			?>
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</section>
		<?php
	}
}
//* Run the Genesis loop
genesis();


