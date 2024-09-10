<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/post/content-single' );

	if ( is_attachment() ) {
		// Parent post navigation
		the_post_navigation(
			array(
				/* translators: %s: post title */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'heim' ), '%title' ),
			)
		);
	}
	
	// Previous/next post navigation
	$next_post = get_next_post();
	$prev_post = get_previous_post();

	if ( $next_post || $prev_post ) :
		?>
	<nav class="post-navigation" aria-label="Posts">
		<h2 class="screen-reader-text">Post navigation</h2>
		
		<div class="nav-links">
			<?php if ( $prev_post ) : ?>
			<div class="nav-previous">
				<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
					<span class="post-thumbnail-wrapper"><?php echo get_the_post_thumbnail( $prev_post->ID, 'medium' ); ?></span>
					<span class="post-title-wrapper">
						<span class="meta-nav"><?php esc_html_e( 'Previous', 'heim' ); ?></span>
						<span class="post-title"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span>
					</span>
				</a>
			</div>
			<?php endif; ?>

			<?php if ( $next_post ) : ?>
			<div class="nav-next">
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<span class="post-title-wrapper">
						<span class="meta-nav"><?php esc_html_e( 'Next', 'heim' ); ?></span>
						<span class="post-title"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span>
					</span>
					<span class="post-thumbnail-wrapper"><?php echo get_the_post_thumbnail( $next_post->ID, 'medium' ); ?></span>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</nav>
		<?php
	endif;
	
	// If comments are open or there is at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;

get_footer();
