<?php
/**
 * Template Name: Blank
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php get_template_part( 'template-parts/page/content' ); ?>
		
	</article><!-- .post -->
	<?php

	// If comments are open or there is at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;

get_footer();
