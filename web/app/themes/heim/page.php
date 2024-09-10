<?php
/**
 * The template for displaying all single posts and pages
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
		
		<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header">
			<div class="entry-header-inner page-max-width">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php heim_post_thumbnail(); ?>
			</div>
		</header><!-- .entry-header -->
		<?php elseif ( has_post_thumbnail() ) : ?>
		<header class="entry-header no-title">
			<div class="entry-header-inner page-max-width">
				<?php heim_post_thumbnail(); ?>
			</div>
		</header><!-- .entry-header -->
		<?php endif; ?>
		
		<?php get_template_part( 'template-parts/page/content' ); ?>
		
	</article><!-- .post -->
	<?php

	// If comments are open or there is at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;

get_footer();
