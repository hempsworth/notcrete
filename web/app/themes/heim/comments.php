<?php
/**
 * The template for displaying comments and the comment form
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$heim_comment_count = get_comments_number();
?>

<div class="comments-wrapper">
	<div id="comments" class="comments-area <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

		<?php
		if ( have_comments() ) :
			?>
			<h2 class="comments-title">
				<?php if ( '1' === $heim_comment_count ) : ?>
					<?php esc_html_e( '1 comment', 'heim' ); ?>
				<?php else : ?>
					<?php
					printf(
						/* translators: %s: comment count */
						esc_html( _nx( '%s comment', '%s comments', $heim_comment_count, 'Comments title', 'heim' ) ),
						esc_html( number_format_i18n( $heim_comment_count ) )
					);
					?>
				<?php endif; ?>
			</h2><!-- .comments-title -->

			<ol class="comment-list">
				<?php
				$avatar_size = heim_avatar_size();

				wp_list_comments(
					array(
						'avatar_size' => $avatar_size,
						'style'       => 'ol',
						'short_ping'  => true,
					)
				);
				?>
			</ol><!-- .comment-list -->

			<?php
			the_comments_pagination(
				array(
					'mid_size'           => 1,
					'prev_text'          => false,
					'next_text'          => false,
				)
			);
			?>

			<?php if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'heim' ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		comment_form(
			array(
				'title_reply'        => esc_html__( 'Leave a comment', 'heim' ),
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
		?>

	</div><!-- #comments -->
</div><!-- .comments-wrapper -->
