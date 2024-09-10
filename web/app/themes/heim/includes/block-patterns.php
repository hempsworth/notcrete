<?php
/**
 * Block Patterns
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( function_exists( 'register_block_pattern_category' ) ) {
	/**
	 * Register Block Pattern category
	 */
	function heim_register_block_pattern_category() {
		register_block_pattern_category(
			'heim-theme',
			array( 'label' => _x( 'Heim Theme', 'Block Patterns Category', 'heim' ) )
		);
	}
	add_action( 'admin_init', 'heim_register_block_pattern_category' );
}

if ( function_exists( 'register_block_pattern' ) ) {
	/**
	 * Register Block Patterns
	 */
	function heim_register_block_patterns() {
		$block_patterns = array(
			// Pattern: Cover banner
			'cover-single' => array(
				'title'         => 'Cover banner',
				'description'   => '',
				'content'       => '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/homepage-cover.jpg","id":2795,"dimRatio":10,"minHeightUnit":"vh","contentPosition":"center center","align":"wide"} -->
<div class="wp-block-cover alignwide"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-10 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-2795" alt="" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/homepage-cover.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"typography":{"fontSize":"18px"}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="font-size:18px">Buy less, but better</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color">We make great design available to everyone</h1>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"10px","className":"is-style-default"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","style":{"color":{"text":"#282828"}},"fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link has-white-background-color has-text-color has-background wp-element-button" href="#" style="color:#282828">Explore the Shop</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
			),
			
			// Pattern: Quote and profile info
			'quote-and-profile-info' => array(
				'title'         => 'Quote and profile info',
				'description'   => '',
				
				'content'       => '<!-- wp:group {"align":"wide","backgroundColor":"heim-body-contrast-2","className":"is-style-heim-cover-padding","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-heim-cover-padding has-heim-body-contrast-2-background-color has-background"><!-- wp:paragraph {"style":{"spacing":{"padding":{"top":"4px"}}}} -->
<p style="padding-top:4px">Our Mantra</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">We don’t need more things, we need&nbsp;better choices. In our ongoing search for quality products we value sustainability, durable materials and beautiful design.</h2>
<!-- /wp:heading -->

<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"22vw","left":"22vw"},"padding":{"top":"4px","bottom":"10px"}}},"className":"is-style-heim-columns-gap-small"} -->
<div class="wp-block-columns is-not-stacked-on-mobile is-style-heim-columns-gap-small" style="padding-top:4px;padding-bottom:10px"><!-- wp:column {"verticalAlignment":"center","width":"64px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:64px"><!-- wp:image {"id":2949,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-full is-style-rounded"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/profile.jpg" alt="" class="wp-image-2949"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:paragraph {"className":"is-style-heim-no-margin"} -->
<p class="is-style-heim-no-margin"><strong>Matt Wilkinson, founder of Heim</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-heim-no-margin","fontSize":"small"} -->
<p class="is-style-heim-no-margin has-small-font-size">Read more <a href="#" data-type="page" data-id="486">About Us</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
			),
			
			// Pattern: Cover feature banners
			'cover-feature-banners' => array(
				'title'         => 'Cover feature banners',
				'description'   => '',
				'content'       => '<!-- wp:columns {"align":"wide","className":"is-style-heim-standard-margins"} -->
<div class="wp-block-columns alignwide is-style-heim-standard-margins"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/cover-feature-candle.jpg","id":2996,"dimRatio":10,"contentPosition":"center center","className":"is-style-heim-preset-feature"} -->
<div class="wp-block-cover is-style-heim-preset-feature"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-10 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-2996" alt="" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/cover-feature-candle.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">Scented Candles</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"140px"} -->
<div style="height:140px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textColor":"white","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-x-large-font-size">Natural brassica wax candles infused with premium scents.</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"1vw","bottom":"4px"}}}} -->
<div class="wp-block-buttons" style="margin-top:1vw;margin-bottom:4px"><!-- wp:button {"backgroundColor":"white","textColor":"black","fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" href="#">Discover</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/cover-feature-art.jpg","id":2995,"dimRatio":10,"contentPosition":"bottom left","isDark":false,"className":"is-style-heim-preset-feature"} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left is-style-heim-preset-feature"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-10 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-2995" alt="" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/cover-feature-art.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">Framed Artwork</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"140px"} -->
<div style="height:140px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textColor":"white","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-x-large-font-size">Add personality to your home with our unique framed art.</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"1vw","bottom":"4px"}}}} -->
<div class="wp-block-buttons" style="margin-top:1vw;margin-bottom:4px"><!-- wp:button {"backgroundColor":"white","textColor":"black","fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" href="#">Discover</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
			),
			
			// Pattern: Featured blog posts section
			'blog-posts-section' => array(
				'title'         => 'Featured blog posts section',
				'description'   => '',
				'content'       => '<!-- wp:group {"align":"full","backgroundColor":"heim-body-contrast-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-heim-body-contrast-2-background-color has-background"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading -->
<h2 class="wp-block-heading">From the Blog</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our blog is full of inspiration and creative ideas for your living space, take a look at our latest articles.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"8px"} -->
<div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"typography":{"fontSize":"14px"}}} -->
<div class="wp-block-button has-custom-font-size" style="font-size:14px"><a class="wp-block-button__link wp-element-button" href="#">Read more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:latest-posts {"postsToShow":2,"displayPostContent":true,"displayPostDate":true,"postLayout":"grid","columns":2,"displayFeaturedImage":true,"featuredImageSizeSlug":"large","addLinkToFeaturedImage":true} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
			),
			
			// Pattern: Image and text feature
			'image-text-feature' => array(
				'title'         => 'Image and text feature',
				'description'   => '',
				'content'       => '<!-- wp:media-text {"align":"","mediaId":2951,"mediaLink":"","mediaType":"image","mediaWidth":58,"verticalAlignment":"center","imageFill":false,"className":"is-style-default"} -->
<div class="wp-block-media-text is-stacked-on-mobile is-vertically-aligned-center is-style-default" style="grid-template-columns:58% auto"><figure class="wp-block-media-text__media"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/about.png" alt="" class="wp-image-2951 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"style":{"typography":{"fontSize":"26px"}}} -->
<h2 class="wp-block-heading" style="font-size:26px">A store for people that want to buy less, but better.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Enamel pin brunch subway tile twee bicycle rights disrupt migas venmo cray banjo offal pressed. Copper vegan kale chips tousled chambray. The mixtape tofu pabst tilde whatever coloring book.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Sustainable gentrify kitsch ethical stumptown, plaid fashion cold pressed wayfarers chia artisan. Intelligentsia chambray tousled, kitsch Godard actually pop-up. Listicle ugh flannel tousled roof party. Tofu ethical lumbersexual distillery freegan cardigan authentic keffiyeh.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Sincerely,</p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":2953,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/signature.png" alt="" class="wp-image-2953"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:media-text -->',
			),
			
			// Pattern: Contact info
			'contact-info' => array(
				'title'         => 'Contact info',
				'description'   => '',
				'content'       => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"50%","layout":{"type":"constrained","wideSize":"500px","justifyContent":"left"}} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"normal"} -->
<h3 class="wp-block-heading has-normal-font-size" style="font-style:normal;font-weight:700">Get in Touch</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Have any questions about our products, or would you just like to say hello?</h3>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"normal"} -->
<h3 class="wp-block-heading has-normal-font-size" style="font-style:normal;font-weight:700">Address</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">Havnegade 12<br>1234 Copenhagen<br>Denmark<br><a rel="noreferrer noopener" href="https://goo.gl/maps/ebT74ZPG5XUMRVx39" target="_blank">Find on Google Maps</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"normal"} -->
<h3 class="wp-block-heading has-normal-font-size" style="font-style:normal;font-weight:700">Contact Info</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">(+45)555-55-555<br><a rel="noreferrer noopener" href="mailto:hello@example.com" data-type="mailto" data-id="mailto:hello@example.com" target="_blank">hello@example.com</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
			),
			
			// Pattern: Follow us banner
			'follow-us-banner' => array(
				'title'         => 'Follow us banner',
				'description'   => '',
				'content'       => '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/contact.jpg","id":2528,"dimRatio":10,"minHeight":460,"isDark":false} -->
<div class="wp-block-cover is-light" style="min-height:460px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-10 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-2528" alt="" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/contact.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained","wideSize":"500px","justifyContent":"center"}} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"white","fontSize":"normal"} -->
<h2 class="wp-block-heading has-text-align-left has-white-color has-text-color has-normal-font-size" style="font-style:normal;font-weight:700">Follow Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white","fontSize":"medium"} -->
<p class="has-white-color has-text-color has-medium-font-size">Join us on social media for inspiration, interesting insights, and fun conversations!</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"10px"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:social-links {"iconColor":"white","iconColorValue":"#ffffff","size":"has-normal-icon-size","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://instagram.com/","service":"instagram"} /-->

<!-- wp:social-link {"url":"https://twitter.com/","service":"twitter"} /-->

<!-- wp:social-link {"url":"https://facebook.com/","service":"facebook"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->',
			),
			
			// Pattern: FAQ section
			'faq-section' => array(
				'title'         => 'FAQ section',
				'description'   => '',
				'content'       => '<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Shopping</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"10px"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">What shipping methods are available?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border"><!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">Ex Portland Pitchfork irure mustache. Neutra fap before they sold out literally. Aliquip ugh bicycle rights actually mlkshk, seitan squid craft readymade beer tempor.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Do you ship internationally?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border"><!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">Hoodie tote bag mixtape tofu. Typewriter jean shorts wolf quinoa, organic freegan cray. Raw denim polaroid paleo farm-to-table letterpress.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">How long will it take to get my package?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Swag slow-carb quinoa VHS typewriter pork belly brunch, paleo single-origin coffee Wes Anderson. Flexitarian Pitchfork forage, literally paleo pour-over. Twee chia photo booth readymade food truck, hoodie roof party swag keytar PBR DIY.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
			),
		);
		
		foreach ( $block_patterns as $pattern_slug => $block_pattern ) {
			register_block_pattern(
				'heim-theme/' . $pattern_slug,
				array(
					'title'       => $block_pattern['title'],
					'description' => $block_pattern['description'],
					'categories'  => array( 'heim-theme' ),
					'content'     => $block_pattern['content'],
				)
			);
		}
	}
	add_action( 'admin_init', 'heim_register_block_patterns' );
}
