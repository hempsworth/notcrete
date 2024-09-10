<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<section class="no-results not-found">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<?php
		printf(
			'<p>' . wp_kses(
				/* translators: %s: Link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'heim' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);
		?>

	<?php elseif ( is_search() ) : ?>
		
		<?php get_search_form(); ?>

	<?php else : ?>
		
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'heim' ); ?></p>

	<?php endif; ?>
</section><!-- .no-results -->
