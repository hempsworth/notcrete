<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

get_header();

// Title and description
$title_text = '';
$title_class = '';
$description = '';
if ( is_archive() ) {
	if ( ! is_author() ) {
		// Remove title prefix
		add_filter( 'get_the_archive_title_prefix', '__return_false' );
	}
	
	$title_text = get_the_archive_title();
	$title_class = ( is_category() && Heim_Customize::get_setting( 'blog_title_hide_on_category_pages' ) ) ? 'title-hidden' : 'title-visible';
	
	$description = get_the_archive_description();
} else if ( is_search() ) {
	$title_text = sprintf(
		/* translators: %s: search query */
		esc_html__( 'Search: "%s"', 'heim' ),
		'<span class="search-term">' . esc_html( get_search_query() ) . '</span>'
	);
	$title_class = 'title-visible';
	
	if ( $wp_query->found_posts ) {
		$description = sprintf(
			esc_html(
				/* translators: %d: number of found posts */
				_n(
					'We found %d result for your search.',
					'We found %d results for your search.',
					(int) $wp_query->found_posts,
					'heim'
				)
			),
			(int) $wp_query->found_posts
		);
	} else {
		$description = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'heim' );
	}
} else if ( is_home() ) {
	$title_text = esc_html__( 'Blog', 'heim' );
	$description = apply_filters( 'heim_blog_home_description_text', '' );
}
?>

<header class="page-header page-max-width <?php echo esc_attr( $title_class ); ?>">
	<?php if ( $title_text ) : ?>
	<h1 class="page-title"><?php echo wp_kses_post( $title_text ); ?></h1>
	<?php endif; ?>
	
	<?php if ( $description ) : ?>
	<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
	<?php endif; ?>
	
	<?php
	if ( Heim_Customize::get_setting( 'blog_category_menu' ) ) {
		heim_the_posts_category_menu();
	}
	?>
</header><!-- .page-header -->

<div class="blog-posts-wrapper">
	<?php if ( have_posts() ) : ?>
	<div class="blog-posts">
		<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/post/content', get_post_type() );
		}
		
		// Previous/next page navigation
		heim_the_posts_navigation();
		?>
	</div>
	<?php
	else :

		// If no content, include the "No posts found" template
		get_template_part( 'template-parts/post/content-none' );

	endif;
	?>
</div>

<?php

get_footer();
