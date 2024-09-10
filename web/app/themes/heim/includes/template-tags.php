<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

/**
 * Header: Logo (as image or text)
 */
function heim_header_logo() {
	if ( has_custom_logo() ) {
		$logo_dark_mode_id = Heim_Customize::get_setting( 'logo_dark_mode' );
		
		$image_html = get_custom_logo();
		$image_html .= ( $logo_dark_mode_id ) ? wp_get_attachment_image( $logo_dark_mode_id, 'full', false, array( 'class' => 'custom-logo for-dark-mode', 'loading' => false ) ) : '';
		
		$allowed_tags = heim_woocommerce_get_allowed_tags( 'product_thumbnail' );
		printf(
			'<div class="site-logo"><a href="%s" class="site-logo-link">%s</a></div>',
			esc_url( home_url( '/' ) ),
			wp_kses( $image_html, $allowed_tags )
		);
	} else {
		$site_title = get_bloginfo( 'name' );

		if ( $site_title ) {
			printf(
				'<div class="site-logo"><a href="%s" class="site-title">%s</a></div>',
				esc_url( home_url( '/' ) ),
				esc_html( $site_title )
			);
		}
	}
}
add_action( 'heim_header_branding', 'heim_header_logo', 5 );


/**
 * Header: Mobile logo
 */
function heim_header_mobile_logo() {
	$mobile_logo_id = Heim_Customize::get_setting( 'logo_mobile' );

	if ( $mobile_logo_id ) {
		$mobile_logo_dark_mode_id = Heim_Customize::get_setting( 'logo_mobile_dark_mode' );
		
		$image_html = wp_get_attachment_image( $mobile_logo_id, 'full', false, array( 'class' => 'custom-mobile-logo', 'loading' => false ) );
		$image_html .= ( $mobile_logo_dark_mode_id ) ? wp_get_attachment_image( $mobile_logo_dark_mode_id, 'full', false, array( 'class' => 'custom-mobile-logo for-dark-mode', 'loading' => false ) ) : '';
		
		if ( strlen( $image_html ) > 0 ) {
			$allowed_tags = heim_woocommerce_get_allowed_tags( 'product_thumbnail' );
			printf(
				'<div class="site-mobile-logo"><a href="%s" class="site-mobile-logo-link">%s</a></div>',
				esc_url( home_url( '/' ) ),
				wp_kses( $image_html, $allowed_tags )
			);
		}
	}
}
add_action( 'heim_header_branding', 'heim_header_mobile_logo', 10 );


/**
 * Color mode: Get state/mode
 */
function heim_color_mode_get_state() {
	// Get cookie value if not in WP Customizer ("color mode" customizer setting won't change if cookie value is used)
	$color_mode_cookie = ( ! is_customize_preview() && isset( $_COOKIE['heim_theme_color_mode'] ) ) ? sanitize_text_field( $_COOKIE['heim_theme_color_mode'] ) : null;
	
	if ( $color_mode_cookie ) {
		$color_mode = ( 'light' === $color_mode_cookie ) ? $color_mode_cookie : 'dark';
	} else {
		$color_mode = Heim_Customize::get_setting( 'color_mode' );
	}
	
	return $color_mode;
}


/**
 * Color mode: Output switcher
 */
function heim_color_mode_switcher() {
	printf('
        <a class="color-mode-switch">
            <i class="heim-icon-"></i>
            <span class="color-mode-label color-mode-label-light">%1$s</span>
            <span class="color-mode-label color-mode-label-dark">%2$s</span>
        </a>
        ',
		esc_html__( 'Day', 'heim' ),
		esc_html__( 'Night', 'heim' )
	);
}


/**
 * Mobile menu button
 */
function heim_mobile_menu_button() {
	?>
	<div id="site-menu-button">
		<a class="heim-icon-menu-alt">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'heim' ); ?></span>
		</a>
	</div><!-- .site-menu-button -->
	<?php
}


/**
 * Product categories: Recursively sort an array of terms hierarchically. Child categories will be placed under a "children" member of their parent term
 *
 * Based on: https://wordpress.stackexchange.com/a/99516
 */
function heim_product_categories_sort_hierarchically( array &$cats, array &$into, $parent_id = 0 ) {
	foreach ( $cats as $i => $cat ) {
		if ( $cat->parent == $parent_id ) {
			$into[$cat->term_id] = $cat;
			unset($cats[$i]);
		}
	}
	
	foreach ( $into as $top_cat ) {
		$top_cat->children = array();
		heim_product_categories_sort_hierarchically( $cats, $top_cat->children, $top_cat->term_id );
	}
	
	return $into;
}


/**
 * Mobile menu: Product categories - Output HTML for single category
 */
function heim_mobile_menu_product_categories_output_single( $category ) {
	?>
	<li class="cat-<?php echo esc_attr( $category->term_id ); ?>">
		<a href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>">
			<?php woocommerce_subcategory_thumbnail( $category ); ?><span class="aside-mobile-categories-title"><?php echo esc_html( $category->name ); ?><mark class="count"><?php echo esc_html( $category->count ); ?></mark></span>
		</a>
	</li>
	<?php
}


/**
 * Mobile menu: Product categories
 */
function heim_mobile_menu_product_categories() {
	if ( ! Heim_Customize::get_setting( 'mobile_menu_product_categories' ) ) {
		return;
	}
	
	$args = apply_filters( 'heim_mobile_menu_product_categories_args', array(
		'taxonomy'   => 'product_cat',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => 1,
		'pad_counts' => true,
		'parent'     => '',
	) );
	$product_categories = get_terms( $args );
	$product_categories_hierarchy = array();
	heim_product_categories_sort_hierarchically( $product_categories, $product_categories_hierarchy );
	
	if ( $product_categories_hierarchy ) :		
		?>
	<ul class="aside-mobile-categories">
		<?php
		foreach ( $product_categories_hierarchy as $category ) {
			heim_mobile_menu_product_categories_output_single( $category );

			if ( $category->children && ! empty( $category->children ) ) {
				foreach ( $category->children as $category_child ) {
					heim_mobile_menu_product_categories_output_single( $category_child );
				}
			}
		}
		?>
	</ul>
	   <?php
	endif;
}
if ( heim_woocommerce_active() ) {
	add_action( 'heim_before_mobile_menu', 'heim_mobile_menu_product_categories', 10 );
}


/**
 * Mobile menu: Footer
 */
function heim_mobile_menu_footer_menu() {
	$menu_items = array();
	
	if ( heim_woocommerce_active() ) {
		$menu_items['myaccount'] = array(
			'url'        => get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ),
			'icon_class' => 'heim-icon-user',
			'name'       => esc_html__( 'My account', 'woocommerce' ),
		);
	}

	$menu_items = apply_filters( 'heim_mobile_menu_footer_menu_items', $menu_items );
	
	if ( $menu_items ) :
		?>
	
	<div class="aside-mobile-footer-menu">
		<ul class="aside-mobile-footer-menu-list">
			<?php foreach ( $menu_items as $item ) : ?>
			<li>
				<a href="<?php echo esc_url( $item['url'] ); ?>"><i class="<?php echo esc_attr( $item['icon_class'] ); ?>"></i><span><?php echo esc_html( $item['name'] ); ?></span></a>
			</li>
			<?php endforeach; ?>
			<?php if ( Heim_Customize::get_setting( 'mobile_menu_color_mode' ) ) : ?>
			<li>
				<?php heim_color_mode_switcher(); ?>
			</li>
			<?php endif; ?>
		</ul>
	</div>
		
		<?php
	endif;
}
add_action( 'heim_after_mobile_menu', 'heim_mobile_menu_footer_menu', 10 );


/**
 * Search: Output form
 */
function heim_search_form() {
	$search_suggestions_string = Heim_Customize::get_setting( 'header_search_suggestions' );
	$has_search_suggestions = ( strlen( $search_suggestions_string ) > 1 ) ? true : false;
	$search_suggestions_class = ( $has_search_suggestions ) ? ' has-suggestions' : '';
	
	echo '<div class="site-search' . esc_attr( $search_suggestions_class ) . '"><div class="site-search-inner wide-max-width">';
	
	// Output search form
	if ( heim_woocommerce_active() ) {
		the_widget( 'WC_Widget_Product_Search',
			'title=',
			array(
				'before_widget' => '<div class="site-search-widget %s">',
				'after_widget'  => '</div>',
			)
		);
	} else {
		echo '<div class="site-search-widget widget_search">';
			get_search_form( true ); // Arg: Echo
		echo '</div>';
	}
	
	// Output suggestions
	if ( $has_search_suggestions ) {
		$search_suggestions_array = explode( ', ', $search_suggestions_string );
		$search_query_post_type = ( heim_woocommerce_active() ) ? '&post_type=product' : '';
		
		echo '<div class="site-search-suggestions"><strong>' . esc_html__( 'Try', 'heim' ) . '<span>:</span></strong>';
		
		foreach ( $search_suggestions_array as $suggestion ) {
			printf(
				'<a href="%s" class="label-button"><i class="heim-icon-search"></i>&quot;%s&quot;</a>',
				esc_url( home_url( '?s=' . $suggestion . $search_query_post_type ) ),
				esc_html( $suggestion )
			);
		}

		echo '</div>';
	}
	
	echo '</div></div>';
}


/**
 * Post archives: Category menu
 */
function heim_the_posts_category_menu() {
	global $wp_query;

	$current_cat_id = ( is_category() ) ? $wp_query->queried_object->cat_ID : 0;
	
	$args = array(
		'type'		   => 'post',
		'orderby'	   => 'slug',
		'order'		   => 'ASC',
		'hide_empty'   => 1,
		'hierarchical' => 1,
		'taxonomy'	   => 'category',
	); 
	$args = apply_filters( 'heim_blog_category_menu_args', $args );
	
	$categories = get_categories( $args );
	
	if ( ! $categories ) {
		return;
	}
	
	$posts_count = wp_count_posts();
	
	$all_link_current_class = ( is_home() ) ? ' current-cat' : '';
	$all_link_posts_count = $posts_count->publish;
	?>
	<ul class="blog-category-menu">
		<li class="cat-item cat-item-all<?php echo esc_attr( $all_link_current_class ); ?>"><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="label-button"><?php esc_html_e( 'All', 'heim' ); ?><em class="count"><?php echo intval( $all_link_posts_count ); ?></em></a></li>
		<?php
		foreach ( $categories as $category ) :
		
		$current_class = ( $current_cat_id == $category->cat_ID ) ? 'current-cat' : '';
		$category_link = get_category_link( $category->cat_ID );
			?>
		<li class="cat-item cat-item-<?php echo intval( $category->cat_ID ); ?> <?php echo esc_attr( $current_class ); ?>"><a href="<?php echo esc_url( $category_link ); ?>" class="label-button"><?php echo esc_html( $category->name ); ?></a></li>
		<?php endforeach; ?>
	</ul>
		<?php
}

	
if ( ! function_exists( 'heim_post_thumbnail' ) ) {
	/**
	 * Post: Thumbnail
	 */
	function heim_post_thumbnail() {
		$thumbnail_size = ( is_singular() ) ? 'full' : 'large';
		
		if ( has_post_thumbnail() && ! post_password_required() ) :
			?>
			<figure class="post-thumbnail">
			
			<?php if ( ! is_singular() ) : ?>
				<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>">
			<?php endif; ?>
				
				<?php the_post_thumbnail( $thumbnail_size ); ?>

			<?php if ( ! is_singular() ) : ?>
				</a>
			<?php endif; ?>

			</figure><!-- .post-thumbnail -->
			<?php
		endif;
	}
}


if ( ! function_exists( 'heim_post_meta_featured' ) ) {
	/**
	 * Post meta: Print featured/sticky post label
	 */
	function heim_post_meta_featured() {
		if ( is_sticky() ) {
			echo '<div class="post-featured"><span class="screen-reader-text">' . esc_html_x( 'Featured', 'Label for sticky posts', 'heim' ) . '</span><i class="heim-icon-star" title="' . esc_html_x( 'Featured', 'Label for sticky posts', 'heim' ) . '"></i></div>';
		}
	}
}


if ( ! function_exists( 'heim_post_meta_categories' ) ) {
	/**
	 * Post meta: Print categories
	 */
	function heim_post_meta_categories() {
		if ( has_category() ) {
			echo '<div class="post-categories">';
			echo '<span class="screen-reader-text">' . esc_html_x( 'Categories', 'Post meta', 'heim' ) . '</span>';

			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				printf(
					'<span class="cat-links"><a href="%s" class="label-button">%s</a></span>',
					esc_url( get_category_link( $categories[0]->term_id ) ),
					esc_html( $categories[0]->name )
				);
			}

			echo '</div>';
		}
	}
}


if ( ! function_exists( 'heim_post_meta_tags' ) ) {
	/**
	 * Post meta: Print tags
	 */
	function heim_post_meta_tags() {
		if ( has_tag() ) {
			echo '<div class="post-tags">';
			echo '<span class="screen-reader-text">' . esc_html_x( 'Tags', 'Post meta', 'heim' ) . '</span>';
			
			$tags = get_the_tags();
			if ( ! empty( $tags ) ) {
				printf(
					'<span class="tags-links"><a href="%s" class="label-button">%s %s</a></span>',
					esc_url( get_tag_link( $tags[0]->term_id ) ),
					'<i class="heim-icon-hashtag"></i>',
					esc_html( $tags[0]->name )
				);
			}

			echo '</div>';
		}
	}
}


if ( ! function_exists( 'heim_post_meta_date' ) ) {
	/**
	 * Post meta: Print post date
	 */
	function heim_post_meta_date() {
		?>
<div class="post-date">
	<span class="screen-reader-text"><?php echo esc_html_x( 'Post date', 'Post meta', 'heim' ); ?></span>
	<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
</div>
		<?php
	}
}


if ( ! function_exists( 'heim_post_meta_author' ) ) {
	/**
	 * Post meta: Print post author
	 */
	function heim_post_meta_author() {
		if ( post_type_supports( get_post_type(), 'author' ) ) {
			echo '<span class="byline">';
			printf(
				/* translators: %s: author link */
				esc_html__( 'Published by %s', 'heim' ),
				'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a>'
			);
			echo '</span>';
		}
	}
}


if ( ! function_exists( 'heim_the_post_meta' ) ) {
	/**
	 * Post meta: Print HTML with meta information
	 */
	function heim_the_post_meta( $location = 'archive' ) {
		// Early exit if excluded post type
		$excluded_post_types = apply_filters( 'heim_post_meta_excluded_post_types', array( 'product' ) );
		if ( in_array( get_post_type(), $excluded_post_types, true ) ) {
			return;
		}
		
		if ( 'single-top' === $location ) {
			$post_meta_config = apply_filters( 'heim_single_top_post_meta', array(
				'categories',
				'date',
			) );
		} else if ( 'single-bottom' === $location ) {
			$post_meta_config = apply_filters( 'heim_single_bottom_post_meta', array(
				'tags',
				'author',
			) );
		} else {
			$post_meta_config = apply_filters( 'heim_archive_post_meta', array(
				'featured',
				'categories',
				'date',
			) );
		}
		
		// Print meta based on config array
		foreach ( $post_meta_config as $post_meta_slug ) {
			call_user_func( 'heim_post_meta_' . $post_meta_slug );
		}
	}
}


if ( ! function_exists( 'heim_the_posts_navigation' ) ) {
	/**
	 * Posts navigation
	 */
	function heim_the_posts_navigation() {
		$post_pagination_args = apply_filters( 'heim_post_pagination_args', array(
			'mid_size' => 2,
			'prev_next' => false,
		) );
		
		the_posts_pagination( $post_pagination_args );
	}
}

/**
 * Avatar: Get size (calculated from base font size)
 */
function heim_avatar_size() {
	$base_font_size = Heim_Customize::get_setting( 'font_size_base' );
	$base_avatar_size = 54;
	
	$rem_multiplier = $base_font_size / 16; // 16 pixels = 1 rem
	
	$avatar_size = $base_avatar_size * $rem_multiplier;
	
	return intval( apply_filters( 'heim_avatar_size', $avatar_size ) );
}
