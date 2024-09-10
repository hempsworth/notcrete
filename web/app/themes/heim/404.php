<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

get_header();
?>

	<header class="entry-header">
		<div class="entry-header-inner page-max-width">
			<h1 class="entry-title"><?php echo esc_html_x( 'Page not found', '404 page template', 'heim' ); ?></h1>
		</div>
	</header>

	<div class="not-found">
		<div class="entry-content">
			<p class="not-found-description"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'heim' ); ?></p>
			
			<?php get_search_form(); ?>
			
			<p class="not-found-back-home">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M20 10.8H6.7l4.1-4.5-1.1-1.1-5.8 6.3 5.8 5.8 1.1-1.1-4-3.9H20z"></path></svg>
				<?php
					/* translators: %s: homepage link */
					printf( esc_html__( 'Back to %1$shomepage%2$s', 'heim' ), '<a href="' . esc_url( home_url() ) . '">', '</a>' );
				?>
			</p>
		</div>
	</div>

<?php
get_footer();
