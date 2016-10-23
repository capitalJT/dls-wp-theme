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
	$description = get_field('description');
  $downloadLink = get_field('download_link');
  $downloadCTA = "Download!";

	if ( is_singular() ) {?>
	
		<article id="<?php echo the_field('id');?>" class="article-list-item <?php echo the_field('class_list');?>" data-sidebar-text="<?php echo the_field('sidebar_text');?>">
			<h1 class="article-title"><?php echo the_title();?></h1>
			<?php  
				if ($description){ ?>
					<div class="article-description"><?php echo $description;?></div>
				<?php
				}
			?>
			
			<section class="article-content"><?php echo the_field('body_content');?></section>
			
			<?php if ($downloadLink){ ?>
			<footer>
				<span class="downloadlink">
					<a href="<?php echo $downloadLink;?>" target="_blank">
						<button type="submit"><?php echo $downloadCTA; ?></button>
					</a>
				</span>	
			</footer>
			<?php } ?>
			
			<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
		</article>
		<?php
	}
}
//* Run the Genesis loop
genesis();


