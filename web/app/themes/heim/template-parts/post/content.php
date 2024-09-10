<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php heim_post_thumbnail(); ?>
		
		<?php if ( is_singular() ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<div class="excerpt"><?php the_excerpt(); ?></div><!-- .excerpt -->

	<footer class="entry-footer">
		<?php heim_the_post_meta(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- .post -->
