<?php
/**
 * Template part for displaying page content
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<div class="entry-content">
	<?php
	the_content();

	wp_link_pages(
		array(
			'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'heim' ) . '">',
			'after'    => '</nav>',
			'pagelink' => esc_html__( 'Page %', 'heim' ),
		)
	);
	?>
</div><!-- .entry-content -->
