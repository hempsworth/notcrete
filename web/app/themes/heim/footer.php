<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->
	
	<?php
		// Footer, or Elementor footer location
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
		?>
	<footer id="colophon">
		<div class="site-footer">
			
		<?php get_template_part( 'template-parts/footer/widgets' ); ?>
			
			<div class="site-footer-bar-wrapper">
				<div class="site-footer-bar page-max-width">
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'Footer menu', 'heim' ); ?>" class="footer-menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'items_wrap'     => '<ul class="footer-menu-wrapper">%3$s</ul>', 
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav><!-- .footer-menu -->
					<?php endif; ?>

					<?php 
					$footer_text = Heim_Customize::get_setting( 'footer_text' );
					
					if ( strlen( $footer_text ) > 0 ) :
						?>
					<div class="site-info">
						<?php echo wp_kses_post( do_shortcode( $footer_text ) ); ?>
					</div><!-- .site-info -->
					<?php endif; ?>
				</div>
			</div>
			
		</div>
	</footer><!-- #colophon -->
	<?php endif; ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
