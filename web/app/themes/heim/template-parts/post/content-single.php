<?php
/**
 * Template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-header-inner page-max-width">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="post-meta">
				<?php heim_the_post_meta( 'single-top' ); ?>
			</div>

			<?php heim_post_thumbnail(); ?>
		</div>
	</header><!-- .entry-header -->

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

	<footer class="entry-footer">
		<?php heim_the_post_meta( 'single-bottom' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
