<?php
/**
 * Heim theme setup data
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup data: Attachments
 */
function heim_setup_data_get_attachments() {
	$attachments_dir = '/assets/images/starter-content/';

	$attachments = array(
		// Pages
		'image-about' => array(
			'post_title' => 'image-about',
			'file'       => $attachments_dir . 'pages/about.png',
			'type'       => 'png',
		),
		'image-contact' => array(
			'post_title' => 'image-contact',
			'file'       => $attachments_dir . 'pages/contact.jpg',
			'type'       => 'jpeg',
		),
		'image-cover-feature-art' => array(
			'post_title' => 'image-cover-feature-art',
			'file'       => $attachments_dir . 'pages/cover-feature-art.jpg',
			'type'       => 'jpeg',
		),
		'image-cover-feature-candle' => array(
			'post_title' => 'image-cover-feature-candle',
			'file'       => $attachments_dir . 'pages/cover-feature-candle.jpg',
			'type'       => 'jpeg',
		),
		'image-homepage-cover' => array(
			'post_title' => 'image-homepage-cover',
			'file'       => $attachments_dir . 'pages/homepage-cover.jpg',
			'type'       => 'jpeg',
		),
		'image-profile' => array(
			'post_title' => 'image-profile',
			'file'       => $attachments_dir . 'pages/profile.jpg',
			'type'       => 'jpeg',
		),
		'image-signature' => array(
			'post_title' => 'image-signature',
			'file'       => $attachments_dir . 'pages/signature.png',
			'type'       => 'png',
		),

		// Blog
		'blog-image-aroma-diffuser' => array(
			'post_title' => 'blog-image-aroma-diffuser',
			'file'       => $attachments_dir . 'blog/blog-aroma-diffuser.jpg',
			'type'       => 'jpeg',
		),
		'blog-image-coffee-set' => array(
			'post_title' => 'blog-image-coffee-set',
			'file'       => $attachments_dir . 'blog/blog-coffee-set.jpg',
			'type'       => 'jpeg',
		),
		'blog-image-compact-speaker' => array(
			'post_title' => 'blog-image-compact-speaker',
			'file'       => $attachments_dir . 'blog/blog-compact-speaker.jpg',
			'type'       => 'jpeg',
		),
		'blog-image-design-diaries' => array(
			'post_title' => 'blog-image-design-diaries',
			'file'       => $attachments_dir . 'blog/blog-design-diaries.jpg',
			'type'       => 'jpeg',
		),
		'blog-image-minimalist-workspace' => array(
			'post_title' => 'blog-image-minimalist-workspace',
			'file'       => $attachments_dir . 'blog/blog-minimalist-workspace.jpg',
			'type'       => 'jpeg',
		),
		'blog-image-monstera-plant' => array(
			'post_title' => 'blog-image-monstera-plant',
			'file'       => $attachments_dir . 'blog/blog-monstera-plant.jpg',
			'type'       => 'jpeg',
		),

		// Posts
		'post-image-coffee' => array(
			'post_title' => 'post-image-coffee',
			'file'       => $attachments_dir . 'posts/post-coffee.jpg',
			'type'       => 'jpeg',
		),
		'post-image-coffee-2' => array(
			'post_title' => 'post-image-coffee-2',
			'file'       => $attachments_dir . 'posts/post-coffee-2.jpg',
			'type'       => 'jpeg',
		),
		'post-image-coffee-3' => array(
			'post_title' => 'post-image-coffee-3',
			'file'       => $attachments_dir . 'posts/post-coffee-3.jpg',
			'type'       => 'jpeg',
		),
		'post-image-monstera' => array(
			'post_title' => 'post-image-monstera',
			'file'       => $attachments_dir . 'posts/post-monstera.jpg',
			'type'       => 'jpeg',
		),
		'post-image-monstera-2' => array(
			'post_title' => 'post-image-monstera-2',
			'file'       => $attachments_dir . 'posts/post-monstera-2.jpg',
			'type'       => 'jpeg',
		),
		'post-image-monstera-3' => array(
			'post_title' => 'post-image-monstera-3',
			'file'       => $attachments_dir . 'posts/post-monstera-3.jpg',
			'type'       => 'jpeg',
		),
		'post-image-workspace' => array(
			'post_title' => 'post-image-workspace',
			'file'       => $attachments_dir . 'posts/post-workspace.jpg',
			'type'       => 'jpeg',
		),
		'post-image-workspace-2' => array(
			'post_title' => 'post-image-workspace-2',
			'file'       => $attachments_dir . 'posts/post-workspace-2.jpg',
			'type'       => 'jpeg',
		),
		'post-image-workspace-3' => array(
			'post_title' => 'post-image-workspace-3',
			'file'       => $attachments_dir . 'posts/post-workspace-3.jpg',
			'type'       => 'jpeg',
		),

		// Categories
		'category-image-accessories' => array(
			'post_title' => 'category-image-accessories',
			'file'       => $attachments_dir . 'categories/category-accessories.jpg',
			'type'       => 'jpeg',
		),
		'category-image-decoration' => array(
			'post_title' => 'category-image-decoration',
			'file'       => $attachments_dir . 'categories/category-decoration.jpg',
			'type'       => 'jpeg',
		),
		'category-image-essentials' => array(
			'post_title' => 'category-image-essentials',
			'file'       => $attachments_dir . 'categories/category-essentials.jpg',
			'type'       => 'jpeg',
		),
		'category-image-living' => array(
			'post_title' => 'category-image-living',
			'file'       => $attachments_dir . 'categories/category-living.jpg',
			'type'       => 'jpeg',
		),

		// Products
		'product-image-a5-notebook' => array(
			'post_title' => 'product-image-a5-notebook',
			'file'       => $attachments_dir . 'products/product-a5-notebook.jpg',
			'type'       => 'jpeg',
		),
		'product-image-a5-notebook-2' => array(
			'post_title' => 'product-image-a5-notebook-2',
			'file'       => $attachments_dir . 'products/product-a5-notebook-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-canola-oil' => array(
			'post_title' => 'product-image-canola-oil',
			'file'       => $attachments_dir . 'products/product-canola-oil.jpg',
			'type'       => 'jpeg',
		),
		'product-image-canola-oil-2' => array(
			'post_title' => 'product-image-canola-oil-2',
			'file'       => $attachments_dir . 'products/product-canola-oil-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-ceramic-flower-pot' => array(
			'post_title' => 'product-image-ceramic-flower-pot',
			'file'       => $attachments_dir . 'products/product-ceramic-flower-pot.jpg',
			'type'       => 'jpeg',
		),
		'product-image-ceramic-flower-pot-2' => array(
			'post_title' => 'product-image-ceramic-flower-pot-2',
			'file'       => $attachments_dir . 'products/product-ceramic-flower-pot-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-marbled-vase' => array(
			'post_title' => 'product-image-marbled-vase',
			'file'       => $attachments_dir . 'products/product-marbled-vase.jpg',
			'type'       => 'jpeg',
		),
		'product-image-marbled-vase-2' => array(
			'post_title' => 'product-image-marbled-vase-2',
			'file'       => $attachments_dir . 'products/product-marbled-vase-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-eco-lotion' => array(
			'post_title' => 'product-image-eco-lotion',
			'file'       => $attachments_dir . 'products/product-eco-lotion.jpg',
			'type'       => 'jpeg',
		),
		'product-image-eco-lotion-2' => array(
			'post_title' => 'product-image-eco-lotion-2',
			'file'       => $attachments_dir . 'products/product-eco-lotion-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-formed-chair' => array(
			'post_title' => 'product-image-formed-chair',
			'file'       => $attachments_dir . 'products/product-formed-chair.jpg',
			'type'       => 'jpeg',
		),
		'product-image-formed-chair-2' => array(
			'post_title' => 'product-image-formed-chair-2',
			'file'       => $attachments_dir . 'products/product-formed-chair-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-leafs-artwork' => array(
			'post_title' => 'product-image-framed-leafs-artwork',
			'file'       => $attachments_dir . 'products/product-framed-leafs-artwork.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-leafs-artwork-2' => array(
			'post_title' => 'product-image-framed-leafs-artwork-2',
			'file'       => $attachments_dir . 'products/product-framed-leafs-artwork-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-plant-artwork' => array(
			'post_title' => 'product-image-framed-plant-artwork',
			'file'       => $attachments_dir . 'products/product-framed-plant-artwork.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-plant-artwork-2' => array(
			'post_title' => 'product-image-framed-plant-artwork-2',
			'file'       => $attachments_dir . 'products/product-framed-plant-artwork-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-single-leaf-artwork' => array(
			'post_title' => 'product-image-framed-single-leaf-artwork',
			'file'       => $attachments_dir . 'products/product-framed-single-leaf-artwork.jpg',
			'type'       => 'jpeg',
		),
		'product-image-framed-single-leaf-artwork-2' => array(
			'post_title' => 'product-image-framed-single-leaf-artwork-2',
			'file'       => $attachments_dir . 'products/product-framed-single-leaf-artwork-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-hand-cream' => array(
			'post_title' => 'product-image-hand-cream',
			'file'       => $attachments_dir . 'products/product-hand-cream.jpg',
			'type'       => 'jpeg',
		),
		'product-image-hand-cream-2' => array(
			'post_title' => 'product-image-hand-cream-2',
			'file'       => $attachments_dir . 'products/product-hand-cream-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-homepod' => array(
			'post_title' => 'product-image-homepod',
			'file'       => $attachments_dir . 'products/product-homepod.jpg',
			'type'       => 'jpeg',
		),
		'product-image-homepod-2' => array(
			'post_title' => 'product-image-homepod-2',
			'file'       => $attachments_dir . 'products/product-homepod-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-hourglass' => array(
			'post_title' => 'product-image-hourglass',
			'file'       => $attachments_dir . 'products/product-hourglass.jpg',
			'type'       => 'jpeg',
		),
		'product-image-hourglass-2' => array(
			'post_title' => 'product-image-hourglass-2',
			'file'       => $attachments_dir . 'products/product-hourglass-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-large-scented-candle' => array(
			'post_title' => 'product-image-large-scented-candle',
			'file'       => $attachments_dir . 'products/product-large-scented-candle.jpg',
			'type'       => 'jpeg',
		),
		'product-image-large-scented-candle-2' => array(
			'post_title' => 'product-image-large-scented-candle-2',
			'file'       => $attachments_dir . 'products/product-large-scented-candle-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-led-bulb' => array(
			'post_title' => 'product-image-led-bulb',
			'file'       => $attachments_dir . 'products/product-led-bulb.jpg',
			'type'       => 'jpeg',
		),
		'product-image-led-bulb-2' => array(
			'post_title' => 'product-image-led-bulb-2',
			'file'       => $attachments_dir . 'products/product-led-bulb-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-office-lamp' => array(
			'post_title' => 'product-image-office-lamp',
			'file'       => $attachments_dir . 'products/product-office-lamp.jpg',
			'type'       => 'jpeg',
		),
		'product-image-office-lamp-2' => array(
			'post_title' => 'product-image-office-lamp-2',
			'file'       => $attachments_dir . 'products/product-office-lamp-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pattern-pillow' => array(
			'post_title' => 'product-image-pattern-pillow',
			'file'       => $attachments_dir . 'products/product-pattern-pillow.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pattern-pillow-2' => array(
			'post_title' => 'product-image-pattern-pillow-2',
			'file'       => $attachments_dir . 'products/product-pattern-pillow-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pendant-cork-lamp' => array(
			'post_title' => 'product-image-pendant-cork-lamp',
			'file'       => $attachments_dir . 'products/product-pendant-cork-lamp.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pendant-cork-lamp-2' => array(
			'post_title' => 'product-image-pendant-cork-lamp-2',
			'file'       => $attachments_dir . 'products/product-pendant-cork-lamp-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pendant-lamp' => array(
			'post_title' => 'product-image-pendant-lamp',
			'file'       => $attachments_dir . 'products/product-pendant-lamp.jpg',
			'type'       => 'jpeg',
		),
		'product-image-pendant-lamp-2' => array(
			'post_title' => 'product-image-pendant-lamp-2',
			'file'       => $attachments_dir . 'products/product-pendant-lamp-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-scented-candle' => array(
			'post_title' => 'product-image-scented-candle',
			'file'       => $attachments_dir . 'products/product-scented-candle.jpg',
			'type'       => 'jpeg',
		),
		'product-image-scented-candle-2' => array(
			'post_title' => 'product-image-scented-candle-2',
			'file'       => $attachments_dir . 'products/product-scented-candle-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-small-camera' => array(
			'post_title' => 'product-image-small-camera',
			'file'       => $attachments_dir . 'products/product-small-camera.jpg',
			'type'       => 'jpeg',
		),
		'product-image-small-camera-2' => array(
			'post_title' => 'product-image-small-camera-2',
			'file'       => $attachments_dir . 'products/product-small-camera-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-smart-speaker' => array(
			'post_title' => 'product-image-smart-speaker',
			'file'       => $attachments_dir . 'products/product-smart-speaker.jpg',
			'type'       => 'jpeg',
		),
		'product-image-smart-speaker-2' => array(
			'post_title' => 'product-image-smart-speaker-2',
			'file'       => $attachments_dir . 'products/product-smart-speaker-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-thermo-flask' => array(
			'post_title' => 'product-image-thermo-flask',
			'file'       => $attachments_dir . 'products/product-thermo-flask.jpg',
			'type'       => 'jpeg',
		),
		'product-image-thermo-flask-2' => array(
			'post_title' => 'product-image-thermo-flask-2',
			'file'       => $attachments_dir . 'products/product-thermo-flask-2.jpg',
			'type'       => 'jpeg',
		),
		'product-image-zigzag-pillow' => array(
			'post_title' => 'product-image-zigzag-pillow',
			'file'       => $attachments_dir . 'products/product-zigzag-pillow.jpg',
			'type'       => 'jpeg',
		),
		'product-image-zigzag-pillow-2' => array(
			'post_title' => 'product-image-zigzag-pillow-2',
			'file'       => $attachments_dir . 'products/product-zigzag-pillow-2.jpg',
			'type'       => 'jpeg',
		),
	);
	
	return $attachments;
}

/**
 * Setup data: Posts
 */
function heim_setup_data_get_posts() {
	$posts = array(
		// Post: The Monstera Plant
		'the-monstera-plant' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-06-26 12:00:00',
			'post_title'   => 'The Monstera Plant',
			'thumbnail'    => 'blog-image-monstera-plant',
			'post_excerpt' => 'Brunch salvia high life vegan ennui migas. Thundercats squid roof party tofu organic flexitarian coffee vegan.',
			'post_content' => '<!-- wp:paragraph -->
<p>High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch. Aesthetic cornhole sartorial authentic artisan typewriter.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"align":"center","className":"is-style-default"} -->
<blockquote class="wp-block-quote has-text-align-center is-style-default"><!-- wp:paragraph -->
<p>The Monstera plant is a member of the Araceae family, which includes other popular houseplants such as the peace lily and philodendron.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Cred small batch dollar toast Tumblr Truffaut meh. Pinterest leggings pork belly McSweeney’s pour-over post-ironic migas. Authentic Portland church-key selfies tofu. Farm-to-table cred 90’s trust fund fingerstache actually Brooklyn, lomo ennui chia sartorial beard.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Tumblr artisan banh mi selvage yr hashtag. Chia Austin single-origin coffee, pork belly chillwave photo<br>booth tofu brunch yr synth meditation health goth artisan organic. Disrupt tattooed typewriter,<br>Godard asymmetrical Shoreditch sartorial banh mi cray direct trade Portland fixie sriracha. Chambray<br>try-hard lo-fi locavore crucifix selvage cardigan. Paleo artisan kale chips flexitarian beard butcher.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2458,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-monstera-2.jpg" alt="" class="wp-image-2458"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2457,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-monstera.jpg" alt="" class="wp-image-2457"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table, neutra tote bag literally sustainable.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Master cleanse Bushwick cornhole narwhal plaid. Seitan vegan Portland master cleanse gluten-free fanny pack raw tofu mixtape organic messenger bag. Aesthetic cornhole photo booth craft beer.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2459,"sizeSlug":"full","linkDestination":"none","className":"is-style-default"} -->
<figure class="wp-block-image size-full is-style-default"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-monstera-3.jpg" alt="" class="wp-image-2459"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Mustache Schlitz next level blog Williamsburg, deep v typewriter tote bag Banksy +1 literally. Lomo 8-bit pour-over mumblecore photo booth. Kitsch pork belly cred, small batch butcher selvage direct trade. Master cleanse Bushwick cornhole narwhal plaid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'Inspiration',
						'slug' => 'inspiration',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Lifestyle',
						'slug' => 'lifestyle',
					),
				),
			),
		),

		// Post: Minimalist Workspace Ideas
		'minimalist-workspace-ideas' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-05-03 12:00:00',
			'post_title'   => 'Minimalist Workspace Ideas',
			'thumbnail'    => 'blog-image-minimalist-workspace',
			'post_excerpt' => 'Artisan sustainable chillwave banh semiotics, cold pressed narwhal hashtag cardigan swag tilde.',
			'post_content' => '<!-- wp:paragraph -->
<p>Cred small batch dollar toast Tumblr Truffaut meh. Pinterest leggings pork belly McSweeney’s pour-over post-ironic migas. Authentic Portland church-key selfies tofu. Farm-to-table cred 90’s trust fund fingerstache actually Brooklyn, lomo ennui chia sartorial beard.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"align":"left","className":"is-style-default"} -->
<blockquote class="wp-block-quote has-text-align-left is-style-default"><!-- wp:paragraph -->
<p>A minimalist workspace involves decluttering, neutral colors, simple designs and smart storage solutions.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Mustache Schlitz next level blog Williamsburg, deep v typewriter tote bag Banksy +1 literally. Lomo 8-bit pour-over mumblecore photo booth. Kitsch pork belly cred, small batch butcher selvage direct trade. Master cleanse Bushwick cornhole narwhal plaid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table, neutra tote bag literally sustainable.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:gallery {"columns":2,"imageCrop":false,"linkTo":"none"} -->
<figure class="wp-block-gallery has-nested-images columns-2"><!-- wp:image {"id":2466,"sizeSlug":"large","linkDestination":"none","className":"is-style-default"} -->
<figure class="wp-block-image size-large is-style-default"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-workspace.jpg" alt="" class="wp-image-2466"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":2467,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-workspace-2.jpg" alt="" class="wp-image-2467"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":2468,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-workspace-3.jpg" alt="" class="wp-image-2468"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Tumblr artisan banh mi selvage yr hashtag. Chia Austin single-origin coffee, pork belly chillwave photo<br>booth tofu brunch yr synth meditation health goth artisan organic. Disrupt tattooed typewriter,<br>Godard asymmetrical Shoreditch sartorial banh mi cray direct trade Portland fixie sriracha. Chambray<br>try-hard lo-fi locavore crucifix selvage cardigan. Paleo artisan kale chips flexitarian beard butcher.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch. Aesthetic cornhole sartorial authentic artisan typewriter.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'News',
						'slug' => 'news',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Lifestyle',
						'slug' => 'lifestyle',
					),
				),
			),
		),

		// Post: Elegant Aroma Diffuser
		'elegant-aroma-diffuser' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-04-18 12:00:00',
			'post_title'   => 'Elegant Aroma Diffuser',
			'thumbnail'    => 'blog-image-aroma-diffuser',
			'post_excerpt' => 'Meditation street art bitters keffiyeh shoreditch, high life roof party pour-over bitters vegan Pitchfork ennui.',
			'post_content' => '<!-- wp:paragraph -->
<p>Meditation street art bitters keffiyeh Shoreditch. High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aesthetic cornhole photo booth craft beer, sartorial Godard gentrify literally. Biodiesel cliche dollar toast hella, Blue Bottle tofu narwhal cronut.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Intelligentsia chambray tousled, kitsch Godard actually pop-up. Listicle ugh flannel tousled roof party. Tofu ethical lumbersexual cray distillery. Freegan cardigan authentic keffiyeh. Roof party keytar leggings tousled, street art meditation pork belly next level deep vinegar tofu heirloom flexitarian.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Authentic Portland church-key selfies tofu. Farm-to-table, cred 90’s trust fund fingerstache chia tofu. Lomo try-hard disrupt PBR&amp;B fixie you probably haven’t heard of them actually Brooklyn. Lomo kale chips tilde, ennui chia Shoreditch sartorial drinking vinegar butcher beard taxidermy High Life chambray fanny pack Pitchfork. Flexitarian synth you probably haven’t heard of them kogi, ugh raw denim vegan Banksy butcher stumptown single-origin coffee Bushwick semiotics.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'Products',
						'slug' => 'products',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Lifestyle',
						'slug' => 'lifestyle',
					),
				),
			),
		),

		// Post: The Design Diaries
		'the-design-diaries' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-03-23 12:00:00',
			'post_title'   => 'The Design Diaries',
			'thumbnail'    => 'blog-image-design-diaries',
			'post_excerpt' => 'Authentic church key selfies tofu farm to table, cred trust fund fingerstache chia tofu try hard kale chips tilde.',
			'post_content' => '<!-- wp:paragraph -->
<p>Authentic Portland church-key selfies tofu. Farm-to-table, cred 90’s trust fund fingerstache chia tofu. Lomo try-hard disrupt PBR&amp;B fixie you probably haven’t heard of them actually Brooklyn. Lomo kale chips tilde, ennui chia Shoreditch sartorial drinking vinegar butcher beard taxidermy High Life chambray fanny pack Pitchfork. Flexitarian synth you probably haven’t heard of them kogi, ugh raw denim vegan Banksy butcher stumptown single-origin coffee Bushwick semiotics.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Intelligentsia chambray tousled, kitsch Godard actually pop-up. Listicle ugh flannel tousled roof party. Tofu ethical lumbersexual cray distillery. Freegan cardigan authentic keffiyeh. Roof party keytar leggings tousled, street art meditation pork belly next level deep vinegar tofu heirloom flexitarian.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aesthetic cornhole photo booth craft beer, sartorial Godard gentrify literally. Biodiesel cliche dollar toast hella, Blue Bottle tofu narwhal cronut.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Meditation street art bitters keffiyeh Shoreditch. High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'News',
						'slug' => 'news',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Lifestyle',
						'slug' => 'lifestyle',
					),
				),
			),
		),

		// Post: Finding the Perfect Coffee Set
		'finding-the-perfect-coffee-set' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-02-08 12:00:00',
			'post_title'   => 'Finding the Perfect Coffee Set',
			'thumbnail'    => 'blog-image-coffee-set',
			'post_excerpt' => 'Master cleanse narwhal plaid vegan master cleanse, gluten-free fanny pack raw tofu mixtape organic literally sustainable.',
			'post_content' => '<!-- wp:paragraph -->
<p>High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch. Aesthetic cornhole sartorial authentic artisan typewriter.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"align":"center","className":"is-style-default"} -->
<blockquote class="wp-block-quote has-text-align-center is-style-default"><!-- wp:paragraph -->
<p>Excellent coffee should be complemented by a coffee set that\'s visually appealing, functional, and capable of withstanding frequent use.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Cred small batch dollar toast Tumblr Truffaut meh. Pinterest leggings pork belly McSweeney’s pour-over post-ironic migas. Authentic Portland church-key selfies tofu. Farm-to-table cred 90’s trust fund fingerstache actually Brooklyn, lomo ennui chia sartorial beard.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Tumblr artisan banh mi selvage yr hashtag. Chia Austin single-origin coffee, pork belly chillwave photo<br>booth tofu brunch yr synth meditation health goth artisan organic. Disrupt tattooed typewriter,<br>Godard asymmetrical Shoreditch sartorial banh mi cray direct trade Portland fixie sriracha. Chambray<br>try-hard lo-fi locavore crucifix selvage cardigan. Paleo artisan kale chips flexitarian beard butcher.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2445,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-coffee.jpg" alt="" class="wp-image-2445"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2446,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-coffee-2.jpg" alt="" class="wp-image-2446"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table, neutra tote bag literally sustainable.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Master cleanse Bushwick cornhole narwhal plaid. Seitan vegan Portland master cleanse gluten-free fanny pack raw tofu mixtape organic messenger bag. Aesthetic cornhole photo booth craft beer.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":2447,"sizeSlug":"full","linkDestination":"none","className":"is-style-default"} -->
<figure class="wp-block-image size-full is-style-default"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/posts/post-coffee-3.jpg" alt="" class="wp-image-2447"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>Mustache Schlitz next level blog Williamsburg, deep v typewriter tote bag Banksy +1 literally. Lomo 8-bit pour-over mumblecore photo booth. Kitsch pork belly cred, small batch butcher selvage direct trade. Master cleanse Bushwick cornhole narwhal plaid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'Inspiration',
						'slug' => 'inspiration',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Collection',
						'slug' => 'collection',
					),
				),
			),
		),

		// Post: Size-Defying Compact Speaker
		'size-defying-compact-speaker' => array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_date'    => '2022-01-06 12:00:00',
			'post_title'   => 'Size-Defying Compact Speaker',
			'thumbnail'    => 'blog-image-compact-speaker',
			'post_excerpt' => 'Cred small batch dollar toast truffaut pour-over post ironic, trust fund actually ennui chia next level beard.',
			'post_content' => '<!-- wp:paragraph -->
<p>Meditation street art bitters keffiyeh Shoreditch. High Life roof party pour-over bitters, vegan Pitchfork ennui migas. Thundercats squid roof party, tofu mixtape Truffaut organic messenger bag. Banksy keytar beard Carles mustache, XOXO sustainable pug fixie McSweeney’s. Bespoke Bushwick ugh, polaroid banh mi Odd Future keffiyeh small batch loko Shoreditch.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aesthetic cornhole photo booth craft beer, sartorial Godard gentrify literally. Biodiesel cliche dollar toast hella, Blue Bottle tofu narwhal cronut.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Intelligentsia chambray tousled, kitsch Godard actually pop-up. Listicle ugh flannel tousled roof party. Tofu ethical lumbersexual cray distillery. Freegan cardigan authentic keffiyeh. Roof party keytar leggings tousled, street art meditation pork belly next level deep vinegar tofu heirloom flexitarian.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Authentic Portland church-key selfies tofu. Farm-to-table, cred 90’s trust fund fingerstache chia tofu. Lomo try-hard disrupt PBR&amp;B fixie you probably haven’t heard of them actually Brooklyn. Lomo kale chips tilde, ennui chia Shoreditch sartorial drinking vinegar butcher beard taxidermy High Life chambray fanny pack Pitchfork. Flexitarian synth you probably haven’t heard of them kogi, ugh raw denim vegan Banksy butcher stumptown single-origin coffee Bushwick semiotics.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Godard single-origin coffee viral gluten-free craft beer biodiesel. Keffiyeh Pinterest umami, loko tattooed Truffaut roof party synth put a bird on it stumptown Vice jean shorts squid. Vinyl asymmetrical Blue Bottle farm-to-table hoodie. Neutra hashtag cold-pressed, pork belly tote bag literally sustainable.</p>
<!-- /wp:paragraph -->',
			'taxonomies'   => array(
				'category' => array(
					array(
						'name' => 'Products',
						'slug' => 'products',
					),
				),
				'post_tag' => array(
					array(
						'name' => 'Collection',
						'slug' => 'collection',
					),
				),
			),
		),
	);
	
	return $posts;
}

/**
 * Setup data: Products
 */
function heim_setup_data_get_products() {
	// Product description
	$product_description = 'Authentic readymade tote bag typewriter banh mi flannel gentrify. Venmo synth meggings fit wolf moon vegan coloring book austin, wayfarers brunch franzen denim thundercats flannel.

    Freegan venmo helvetica gentrify wayfarers banjo subway tile tumblr everyday adaptogen.';

	// Product description 2
	$product_description_2 = 'Meditation street art bitters keffiyeh shoreditch high life roof party pour-over bitters, vegan pitchfork ennui migas thundercats squid roof party tofu mixtape organic messenger bag.

    Intelligentsia chambray tousled kitsch actually flannel tousled ethical cray distillery.';

	// Product short description
	$product_short_description = 'Designed for simplicity and made from high-quality materials. Its clean lines and material combinations creates a modern custom look suitable for any space.
    <ol>
        <li>Eco-friendly &amp; sustainable</li>
        <li>Fast reliable shipping</li>
        <li>Secure payment options</li>
    </ol>';

	$products = array(
		// Product: A5 Notebook
		'a5-notebook' => array(
			'product_type'      => 'simple',
			'name'              => 'A5 Notebook',
			'short_description' => 'A WooCommerce downloadable product is a type of digital product that can be downloaded by the customer after purchase, such as software, music, or e-books.
    <ol>
        <li>Instant access to PDF files</li>
        <li>Unlimited downloads</li>
        <li>Secure payment options</li>
    </ol>',
			'description'       => $product_description,
			'thumbnail'         => 'product-image-a5-notebook',
			'gallery_image'     => 'product-image-a5-notebook-2',
			'regular_price'     => '28',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			//'featured'          => true,
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			/*'attributes'        => array(
				'shipping' => array(
					'name'         => 'Shipping',
					'terms'        => array( 'Ships within 12-24 hours on weekdays', ),
					'is_visible'   => true,
					'is_variation' => false,
				),
			),*/
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'        => 'Essentials',
						'slug'        => 'essentials',
						'description' => 'Discover our latest collection of high-quality home essentials, carefully selected to help you create a welcoming and inviting living environment.',
						'thumbnail'   => 'category-image-essentials',
					),
				),
				/*'product_tag' => array(
					array(
						'name' => 'Imported Product Tag',
						'slug' => 'imported-product-tag',
					),
				),*/
			),
		),

		// Product: Thermo Flask (out of stock)
		'thermo-flask' => array(
			'product_type'      => 'simple',
			'name'              => 'Thermo Flask',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-thermo-flask',
			'gallery_image'     => 'product-image-thermo-flask-2',
			'regular_price'     => '39',
			'sale_price'        => '36',
			'stock_status'      => 'outofstock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Outdoor Wi-Fi Cam
		'outdoor-wi-fi-cam' => array(
			'product_type'      => 'simple',
			'name'              => 'Outdoor Wi-Fi Cam',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-small-camera',
			'gallery_image'     => 'product-image-small-camera-2',
			'regular_price'     => '219',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'        => 'Accessories',
						'slug'        => 'accessories',
						'description' => 'Discover our latest collection of high-quality home accessories, carefully selected to help you create a welcoming and inviting living environment.',
						'thumbnail'   => 'category-image-accessories',
					),
				),
			),
		),

		// Product: LED Bulb 12W
		'led-bulb-12w' => array(
			'product_type'      => 'simple',
			'name'              => 'LED Bulb 12W',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-led-bulb',
			'gallery_image'     => 'product-image-led-bulb-2',
			'regular_price'     => '17',
			'sale_price'        => '16',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Accessories',
						'slug'      => 'accessories',
						'thumbnail' => 'category-image-accessories',
					),
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Powerful Smart Speaker
		'powerful-smart-speaker' => array(
			'product_type'      => 'simple',
			'name'              => 'Powerful Smart Speaker',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-smart-speaker',
			'gallery_image'     => 'product-image-smart-speaker-2',
			'regular_price'     => '380',
			'sale_price'        => '',
			'stock_status'      => 'onbackorder',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Accessories',
						'slug'      => 'accessories',
						'thumbnail' => 'category-image-accessories',
					),
				),
			),
		),

		// Product - Grouped: Framed Leaf Artwork
		'framed-leaf-artwork' => array(
			'product_type'      => 'grouped',
			'name'              => 'Framed Leaf Artwork',
			'short_description' => 'A WooCommerce grouped product is a type of product that allows you to group multiple individual products together and sell them as a package or bundle.',
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-framed-single-leaf-artwork',
			'gallery_image'     => 'product-image-framed-single-leaf-artwork-2',
			'regular_price'     => '',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'grouped_products'  => array(
				// Note: These products must be listed above so they're available
				//'framed-leafs-artwork' => 'Framed Leafs Artwork',
				//'framed-plant-artwork' => 'Framed Plant Artwork',
				'a5-notebook'  => 'A5 Notebook',
				'led-bulb-12w' => 'LED Bulb 12W',
			),
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
		),

		// Product: Canola Oil
		'canola-oil' => array(
			'product_type'      => 'simple',
			'name'              => 'Canola Oil',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-canola-oil',
			'gallery_image'     => 'product-image-canola-oil-2',
			'regular_price'     => '23',
			'sale_price'        => '18',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Ceramic Flower Pot
		'ceramic-flower-pot' => array(
			'product_type'      => 'simple',
			'name'              => 'Ceramic Flower Pot',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-ceramic-flower-pot',
			'gallery_image'     => 'product-image-ceramic-flower-pot-2',
			'regular_price'     => '26',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
		),

		// Product: Large Scented Candle
		'large-scented-candle' => array(
			'product_type'      => 'simple',
			'name'              => 'Large Scented Candle',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-large-scented-candle',
			'gallery_image'     => 'product-image-large-scented-candle-2',
			'regular_price'     => '29',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Decorative Lines Pillow
		'decorative-lines-pillow' => array(
			'product_type'      => 'simple',
			'name'              => 'Decorative Lines Pillow',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-pattern-pillow',
			'gallery_image'     => 'product-image-pattern-pillow-2',
			'regular_price'     => '80',
			'sale_price'        => '73',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
		),

		// Product: Scented Hand Cream
		'scented-hand-cream' => array(
			'product_type'      => 'simple',
			'name'              => 'Scented Hand Cream',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-hand-cream',
			'gallery_image'     => 'product-image-hand-cream-2',
			'regular_price'     => '12',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Adjustable Office Lamp
		'adjustable-office-lamp' => array(
			'product_type'      => 'simple',
			'name'              => 'Adjustable Office Lamp',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-office-lamp',
			'gallery_image'     => 'product-image-office-lamp-2',
			'regular_price'     => '58',
			'sale_price'        => '53',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Accessories',
						'slug'      => 'accessories',
						'thumbnail' => 'category-image-accessories',
					),
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
		),

		// Product: Compact Smart Speaker
		'compact-smart-speaker' => array(
			'product_type'      => 'simple',
			'name'              => 'Compact Smart Speaker',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-homepod',
			'gallery_image'     => 'product-image-homepod-2',
			'regular_price'     => '146',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Accessories',
						'slug'      => 'accessories',
						'thumbnail' => 'category-image-accessories',
					),
				),
			),
		),

		// Product: Framed Plant Artwork
		'framed-plant-artwork' => array(
			'product_type'      => 'simple',
			'name'              => 'Framed Plant Artwork',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-framed-plant-artwork-2',
			'gallery_image'     => 'product-image-framed-plant-artwork',
			'regular_price'     => '39',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
			'has_review'        => true,
		),

		// Product: Scented Wax Candle
		'scented-wax-candle' => array(
			'product_type'      => 'simple',
			'name'              => 'Scented Wax Candle',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-scented-candle',
			'gallery_image'     => 'product-image-scented-candle-2',
			'regular_price'     => '19',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Marbled Vase
		'marbled-vase' => array(
			'product_type'      => 'simple',
			'name'              => 'Marbled Vase',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-marbled-vase',
			'gallery_image'     => 'product-image-marbled-vase-2',
			'regular_price'     => '36',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
		),

		// Product: Zig Zag Pattern Pillow
		'zig-zag-pattern-pillow' => array(
			'product_type'      => 'simple',
			'name'              => 'Zig Zag Pattern Pillow',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-zigzag-pillow',
			'gallery_image'     => 'product-image-zigzag-pillow-2',
			'regular_price'     => '90',
			'sale_price'        => '83',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
		),

		// Product: Scented Eco Lotion
		'scented-eco-lotion' => array(
			'product_type'      => 'simple',
			'name'              => 'Scented Eco Lotion',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-eco-lotion',
			'gallery_image'     => 'product-image-eco-lotion-2',
			'regular_price'     => '12',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Essentials',
						'slug'      => 'essentials',
						'thumbnail' => 'category-image-essentials',
					),
				),
			),
		),

		// Product: Pendant Cork Lamp
		'pendant-cork-lamp' => array(
			'product_type'      => 'simple',
			'name'              => 'Pendant Cork Lamp',
			'short_description' => $product_short_description,
			'description'       => $product_description,
			'thumbnail'         => 'product-image-pendant-cork-lamp',
			'gallery_image'     => 'product-image-pendant-cork-lamp-2',
			'regular_price'     => '173',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Accessories',
						'slug'      => 'accessories',
						'thumbnail' => 'category-image-accessories',
					),
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
		),

		// Product: Framed Leafs Artwork
		'framed-leafs-artwork' => array(
			'product_type'      => 'simple',
			'name'              => 'Framed Leafs Artwork',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-framed-leafs-artwork',
			'gallery_image'     => 'product-image-framed-leafs-artwork-2',
			'regular_price'     => '36',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
		),

		// Product - External: Timeless Pendant Lamp
		'timeless-pendant-lamp' => array(
			'product_type'      => 'external',
			'name'              => 'Timeless Pendant Lamp',
			'short_description' => 'A WooCommerce external product is a type of product that is sold on an external website or platform, but can be displayed and managed through a WooCommerce store.
    <ol>
        <li>Eco-friendly & sustainable</li>
        <li>Fast reliable shipping</li>
        <li>Secure payment options</li>
    </ol>',
			'description'       => $product_description,
			'thumbnail'         => 'product-image-pendant-lamp',
			'gallery_image'     => 'product-image-pendant-lamp-2',
			'regular_price'     => '89',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'button_text'       => 'Buy on Etsy.com',
			'product_url'       => 'https://www.etsy.com/',
			'taxonomies' => array(
				'product_cat' => array(
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
		),

		// Product: Sand Hourglass
		'sand-hourglass' => array(
			'product_type'      => 'simple',
			'name'              => 'Sand Hourglass',
			'short_description' => $product_short_description,
			'description'       => $product_description_2,
			'thumbnail'         => 'product-image-hourglass',
			'gallery_image'     => 'product-image-hourglass-2',
			'regular_price'     => '18',
			'sale_price'        => '',
			'stock_status'      => 'instock',
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'taxonomies'        => array(
				'product_cat' => array(
					array(
						'name'      => 'Decoration',
						'slug'      => 'decoration',
						'thumbnail' => 'category-image-decoration',
					),
				),
			),
			'has_review'        => true,
		),

		// Product - Variable: Formed Dining Chair
		'formed-dining-chair' => array(
			'product_type'      => 'variable',
			'name'              => 'Formed Dining Chair',
			'short_description' => 'Designed for simplicity and made from high-quality materials, its clean lines and modern look is suitable for any space.',
			'description'       => $product_description,
			'thumbnail'         => 'product-image-formed-chair',
			'gallery_image'     => 'product-image-formed-chair-2',
			'stock_status'      => 'instock',        
			'weight'            => '17.6',
			'length'            => '12',
			'width'             => '34',
			'height'            => '56',
			'attributes'        => array(
				'color' => array(
					'name'          => 'Color',
					'terms'         => array( 'Charcoal', 'Granit', ),
					'is_visible'    => false,
					'is_variation'  => true,
					'default_term'  => 'Charcoal',
					'regular_price' => '296',
					'sale_price'    => '268',
				),
				'material' => array(
					'name'          => 'Material',
					'terms'         => array( 'Birch', 'Oak', ),
					'is_visible'    => false,
					'is_variation'  => true,
					'default_term'  => 'Oak',
					'regular_price' => '296',
					'sale_price'    => '268',
				),
			),
			'taxonomies' => array(
				'product_cat' => array(
					array(
						'name'      => 'Living',
						'slug'      => 'living',
						'thumbnail' => 'category-image-living',
					),
				),
			),
			'has_review'        => true,
		),
	);
	
	return $products;
}

/**
 * Home page: Featured Category blocks - Get data
 */
function heim_home_page_get_featured_categories_data() {
	$featured_categories = array(
		'accessories' => array(
			'name'         => 'Accessories',
			'id'           => '',
			'url'          => '',
			'thumbnail_id' => '',
		),
		'essentials'  => array(
			'name'         => 'Essentials',
			'id'           => '',
			'url'          => '',
			'thumbnail_id' => '',
		),
		'living'      => array(
			'name'         => 'Living',
			'id'           => '',
			'url'          => '',
			'thumbnail_id' => '',
		),
	);
	
	if ( ! heim_woocommerce_active() ) {
		return $featured_categories; // Return default array if WooCommerce is unavailable
	}
	
	foreach ( $featured_categories as $featured_category_slug => $featured_category_data ) {
		$featured_category = get_term_by( 'name', $featured_category_data['name'], 'product_cat' );

		if ( ! $featured_category ) {
			continue;
		}
		
		$featured_categories[$featured_category_slug]['id'] = $featured_category->term_id;
		
		$featured_category_url = get_term_link( $featured_category->term_id, 'product_cat' );
		if ( ! is_wp_error( $featured_category_url ) ) {
			$featured_categories[$featured_category_slug]['url'] = $featured_category_url;
		}
		
		$thumbnail_id = get_term_meta( $featured_category->term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			$featured_categories[$featured_category_slug]['thumbnail_id'] = $thumbnail_id;
		}
	}
	
	return $featured_categories;
}

/**
 * Home page: Handpicked Products block - Get product IDs string
 */
function heim_home_page_get_handpicked_products_ids() {
	if ( ! heim_woocommerce_active() ) {
		return '';
	}
	
	$handpicked_products = array(
		'Scented Wax Candle',
		'Framed Plant Artwork',
		'Compact Smart Speaker',
		'Adjustable Office Lamp',
		'Scented Hand Cream',
		'Decorative Lines Pillow',
		'Large Scented Candle',
		'Ceramic Flower Pot',
	);
	$handpicked_product_ids = array();

	foreach ( $handpicked_products as $handpicked_product_title ) {
		$handpicked_product = get_page_by_title( $handpicked_product_title, OBJECT, 'product' );
		
		if ( $handpicked_product ) {
			$handpicked_product_id = $handpicked_product->ID;

			// Make sure product is published since it could be in the trash
			$handpicked_product = get_posts( array(
				'post_type'   => 'product',
				'p'           => $handpicked_product_id,
				'post_status' => 'publish',
				'numberposts' => 1,
			) );
			
			if ( $handpicked_product && ! empty( $handpicked_product ) ) {
				$handpicked_product_ids[] = $handpicked_product_id;
			}
		}
	}

	$handpicked_product_ids = implode( ',', $handpicked_product_ids );
	
	return $handpicked_product_ids;
}
	
/**
 * Setup data: Pages
 */
function heim_setup_data_get_pages() {
	$featured_categories_data = heim_home_page_get_featured_categories_data();
	$handpicked_product_ids   = heim_home_page_get_handpicked_products_ids();
	
	$pages = array(
		// Page: About
		'about' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'About Us',
			'post_content' => '<!-- wp:spacer {"height":"15px","className":"is-style-heim-hide-on-mobile"} -->
<div style="height:15px" aria-hidden="true" class="wp-block-spacer is-style-heim-hide-on-mobile"></div>
<!-- /wp:spacer -->

<!-- wp:media-text {"align":"","mediaId":2951,"mediaLink":"","mediaType":"image","mediaWidth":58,"verticalAlignment":"center","imageFill":false,"className":"is-style-default"} -->
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
<!-- /wp:media-text -->

<!-- wp:spacer {"height":"70px","className":"is-style-heim-max-height-mobile"} -->
<div style="height:70px" aria-hidden="true" class="wp-block-spacer is-style-heim-max-height-mobile"></div>
<!-- /wp:spacer -->',
		),

		// Page: Blog
		'blog' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Blog',
			'post_content' => '',
		),

		// Page: Cart style 2
		'cart-style-2' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Cart',
			'post_content' => '<!-- wp:woocommerce/cart {"align":"wide"} -->
<div class="wp-block-woocommerce-cart alignwide is-loading"><!-- wp:woocommerce/filled-cart-block -->
<div class="wp-block-woocommerce-filled-cart-block"><!-- wp:woocommerce/cart-items-block -->
<div class="wp-block-woocommerce-cart-items-block"><!-- wp:woocommerce/cart-line-items-block -->
<div class="wp-block-woocommerce-cart-line-items-block"></div>
<!-- /wp:woocommerce/cart-line-items-block -->

<!-- wp:woocommerce/cart-cross-sells-block -->
<div class="wp-block-woocommerce-cart-cross-sells-block"><!-- wp:heading {"fontSize":"large"} -->
<h2 class="has-large-font-size">You may be interested in…</h2>
<!-- /wp:heading -->

<!-- wp:woocommerce/cart-cross-sells-products-block -->
<div class="wp-block-woocommerce-cart-cross-sells-products-block"></div>
<!-- /wp:woocommerce/cart-cross-sells-products-block --></div>
<!-- /wp:woocommerce/cart-cross-sells-block --></div>
<!-- /wp:woocommerce/cart-items-block -->

<!-- wp:woocommerce/cart-totals-block -->
<div class="wp-block-woocommerce-cart-totals-block"><!-- wp:woocommerce/cart-order-summary-block -->
<div class="wp-block-woocommerce-cart-order-summary-block"><!-- wp:woocommerce/cart-order-summary-heading-block -->
<div class="wp-block-woocommerce-cart-order-summary-heading-block"></div>
<!-- /wp:woocommerce/cart-order-summary-heading-block -->

<!-- wp:woocommerce/cart-order-summary-coupon-form-block -->
<div class="wp-block-woocommerce-cart-order-summary-coupon-form-block"></div>
<!-- /wp:woocommerce/cart-order-summary-coupon-form-block -->

<!-- wp:woocommerce/cart-order-summary-subtotal-block -->
<div class="wp-block-woocommerce-cart-order-summary-subtotal-block"></div>
<!-- /wp:woocommerce/cart-order-summary-subtotal-block -->

<!-- wp:woocommerce/cart-order-summary-fee-block -->
<div class="wp-block-woocommerce-cart-order-summary-fee-block"></div>
<!-- /wp:woocommerce/cart-order-summary-fee-block -->

<!-- wp:woocommerce/cart-order-summary-discount-block -->
<div class="wp-block-woocommerce-cart-order-summary-discount-block"></div>
<!-- /wp:woocommerce/cart-order-summary-discount-block -->

<!-- wp:woocommerce/cart-order-summary-shipping-block -->
<div class="wp-block-woocommerce-cart-order-summary-shipping-block"></div>
<!-- /wp:woocommerce/cart-order-summary-shipping-block -->

<!-- wp:woocommerce/cart-order-summary-taxes-block -->
<div class="wp-block-woocommerce-cart-order-summary-taxes-block"></div>
<!-- /wp:woocommerce/cart-order-summary-taxes-block --></div>
<!-- /wp:woocommerce/cart-order-summary-block -->

<!-- wp:woocommerce/cart-express-payment-block -->
<div class="wp-block-woocommerce-cart-express-payment-block"></div>
<!-- /wp:woocommerce/cart-express-payment-block -->

<!-- wp:woocommerce/proceed-to-checkout-block -->
<div class="wp-block-woocommerce-proceed-to-checkout-block"></div>
<!-- /wp:woocommerce/proceed-to-checkout-block -->

<!-- wp:woocommerce/cart-accepted-payment-methods-block -->
<div class="wp-block-woocommerce-cart-accepted-payment-methods-block"></div>
<!-- /wp:woocommerce/cart-accepted-payment-methods-block --></div>
<!-- /wp:woocommerce/cart-totals-block --></div>
<!-- /wp:woocommerce/filled-cart-block -->

<!-- wp:woocommerce/empty-cart-block -->
<div class="wp-block-woocommerce-empty-cart-block"><!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
<h2 class="has-text-align-center has-medium-font-size">Your cart is currently empty!</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Browse store</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"className":"is-style-heim-max-height-mobile"} -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-heim-max-height-mobile"></div>
<!-- /wp:spacer --></div>
<!-- /wp:woocommerce/empty-cart-block --></div>
<!-- /wp:woocommerce/cart -->',
		),

		// Page: Checkout Style 2
		'checkout-style-2' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Checkout',
			'post_content' => '<!-- wp:woocommerce/checkout {"align":"wide"} -->
<div class="wp-block-woocommerce-checkout alignwide wc-block-checkout is-loading"><!-- wp:woocommerce/checkout-fields-block -->
<div class="wp-block-woocommerce-checkout-fields-block"><!-- wp:woocommerce/checkout-express-payment-block -->
<div class="wp-block-woocommerce-checkout-express-payment-block"></div>
<!-- /wp:woocommerce/checkout-express-payment-block -->

<!-- wp:woocommerce/checkout-contact-information-block -->
<div class="wp-block-woocommerce-checkout-contact-information-block"></div>
<!-- /wp:woocommerce/checkout-contact-information-block -->

<!-- wp:woocommerce/checkout-shipping-method-block -->
<div class="wp-block-woocommerce-checkout-shipping-method-block"></div>
<!-- /wp:woocommerce/checkout-shipping-method-block -->

<!-- wp:woocommerce/checkout-pickup-options-block -->
<div class="wp-block-woocommerce-checkout-pickup-options-block"></div>
<!-- /wp:woocommerce/checkout-pickup-options-block -->

<!-- wp:woocommerce/checkout-shipping-address-block -->
<div class="wp-block-woocommerce-checkout-shipping-address-block"></div>
<!-- /wp:woocommerce/checkout-shipping-address-block -->

<!-- wp:woocommerce/checkout-billing-address-block -->
<div class="wp-block-woocommerce-checkout-billing-address-block"></div>
<!-- /wp:woocommerce/checkout-billing-address-block -->

<!-- wp:woocommerce/checkout-shipping-methods-block -->
<div class="wp-block-woocommerce-checkout-shipping-methods-block"></div>
<!-- /wp:woocommerce/checkout-shipping-methods-block -->

<!-- wp:woocommerce/checkout-payment-block -->
<div class="wp-block-woocommerce-checkout-payment-block"></div>
<!-- /wp:woocommerce/checkout-payment-block -->

<!-- wp:woocommerce/checkout-order-note-block -->
<div class="wp-block-woocommerce-checkout-order-note-block"></div>
<!-- /wp:woocommerce/checkout-order-note-block -->

<!-- wp:woocommerce/checkout-terms-block -->
<div class="wp-block-woocommerce-checkout-terms-block"></div>
<!-- /wp:woocommerce/checkout-terms-block -->

<!-- wp:woocommerce/checkout-actions-block -->
<div class="wp-block-woocommerce-checkout-actions-block"></div>
<!-- /wp:woocommerce/checkout-actions-block --></div>
<!-- /wp:woocommerce/checkout-fields-block -->

<!-- wp:woocommerce/checkout-totals-block -->
<div class="wp-block-woocommerce-checkout-totals-block"><!-- wp:woocommerce/checkout-order-summary-block -->
<div class="wp-block-woocommerce-checkout-order-summary-block"><!-- wp:woocommerce/checkout-order-summary-cart-items-block -->
<div class="wp-block-woocommerce-checkout-order-summary-cart-items-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-cart-items-block -->

<!-- wp:woocommerce/checkout-order-summary-coupon-form-block -->
<div class="wp-block-woocommerce-checkout-order-summary-coupon-form-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-coupon-form-block -->

<!-- wp:woocommerce/checkout-order-summary-subtotal-block -->
<div class="wp-block-woocommerce-checkout-order-summary-subtotal-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-subtotal-block -->

<!-- wp:woocommerce/checkout-order-summary-fee-block -->
<div class="wp-block-woocommerce-checkout-order-summary-fee-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-fee-block -->

<!-- wp:woocommerce/checkout-order-summary-discount-block -->
<div class="wp-block-woocommerce-checkout-order-summary-discount-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-discount-block -->

<!-- wp:woocommerce/checkout-order-summary-shipping-block -->
<div class="wp-block-woocommerce-checkout-order-summary-shipping-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-shipping-block -->

<!-- wp:woocommerce/checkout-order-summary-taxes-block -->
<div class="wp-block-woocommerce-checkout-order-summary-taxes-block"></div>
<!-- /wp:woocommerce/checkout-order-summary-taxes-block --></div>
<!-- /wp:woocommerce/checkout-order-summary-block --></div>
<!-- /wp:woocommerce/checkout-totals-block --></div>
<!-- /wp:woocommerce/checkout -->',
		),
		
		// Page: Contact Us
		'contact-us' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Contact',
			'post_content' => '<!-- wp:spacer {"height":"12px","className":"is-style-heim-hide-on-mobile"} -->
<div style="height:12px" aria-hidden="true" class="wp-block-spacer is-style-heim-hide-on-mobile"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
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
<!-- /wp:columns -->

<!-- wp:spacer {"height":"24px","className":"is-style-default"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/contact.jpg","id":2528,"dimRatio":10,"minHeight":460,"isDark":false} -->
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
<!-- /wp:cover -->

<!-- wp:spacer {"height":"80px","className":"is-style-heim-max-height-mobile"} -->
<div style="height:80px" aria-hidden="true" class="wp-block-spacer is-style-heim-max-height-mobile"></div>
<!-- /wp:spacer -->

<!-- wp:spacer {"height":"1px"} -->
<div style="height:1px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->',
		),
		
		// Page: FAQ
		'faq' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'FAQ',
			'post_content' => '<!-- wp:spacer {"height":"10px","className":"is-style-heim-hide-on-mobile"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer is-style-heim-hide-on-mobile"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"align":"wide"} -->
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
<!-- /wp:columns -->

<!-- wp:spacer {"height":"20px","className":"is-style-default"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:separator {"align":"wide","className":"is-style-wide"} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"36px","className":"is-style-default"} -->
<div style="height:36px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Payments</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"10px"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">What payment methods are accepted?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border"><!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">Keytar cray slow-carb, Godard banh mi salvia pour-over. Slow-carb odd future seitan normcore. Master cleanse American Apparel gentrify flexitarian beard slow-carb next level.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Is buying online safe?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Neutra Austin roof party Brooklyn, synth Thundercats swag 8-bit photo booth. Plaid letterpress leggings craft beer meh ethical.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"20px","className":"is-style-default"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:separator {"align":"wide","className":"is-style-wide"} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"36px","className":"is-style-default"} -->
<div style="height:36px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Orders</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"10px"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">How do I track my order?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Ex Portland Pitchfork irure mustache. Neutra fap before they sold out literally. Aliquip ugh bicycle rights actually mlkshk, seitan squid craft beer tempor.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">How can I return a product?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Kale chips Truffaut Williamsburg, hashtag fixie Pinterest raw denim hambray drinking vinegar Carles street art Bushwick gastropub. Wolf Tumblr paleo church-key. Plaid food truck Echo Park YOLO bitters hella, direct trade.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Do I need an account to place an order?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Keytar cray slow-carb, Godard banh mi salvia pour-over. Slow-carb @Odd Future seitan normcore.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">How can I cancel my order?</h3>
<!-- /wp:heading -->

<!-- wp:quote {"className":"is-style-heim-slim-border","fontSize":"normal"} -->
<blockquote class="wp-block-quote is-style-heim-slim-border has-normal-font-size"><!-- wp:paragraph -->
<p>Swag slow-carb quinoa VHS typewriter pork belly brunch, paleo single-origin coffee Wes Anderson. Flexitarian Pitchfork forage, literally paleo pour-over. Twee chia photo booth readymade food truck, hoodie roof party swag keytar PBR DIY.</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"46px","className":"is-style-heim-max-height-mobile"} -->
<div style="height:46px" aria-hidden="true" class="wp-block-spacer is-style-heim-max-height-mobile"></div>
<!-- /wp:spacer -->',
		),
		
		// Page: Home
		'home' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Home',
			'post_content' => '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/pages/homepage-cover.jpg","id":2795,"dimRatio":10,"minHeightUnit":"vh","contentPosition":"center center","align":"wide"} -->
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
<!-- /wp:cover -->

<!-- wp:spacer {"height":"22px","className":"is-style-default"} -->
<div style="height:22px" aria-hidden="true" class="wp-block-spacer is-style-default"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","align":"wide","fontSize":"medium"} -->
<h2 class="wp-block-heading alignwide has-text-align-center has-medium-font-size">New &amp; Noteworthy</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"22px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:22px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:woocommerce/product-new {"columns":4,"rows":1,"stockStatus":["","","instock","outofstock","onbackorder"],"align":"wide"} /-->

<!-- wp:columns {"align":"wide","className":"is-equal-gap-mobile is-style-heim-standard-margins"} -->
<div class="wp-block-columns alignwide is-equal-gap-mobile is-style-heim-standard-margins"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:woocommerce/featured-category {"dimRatio":0,"editMode":false,"imageFit":"cover","mediaId":' . $featured_categories_data['accessories']['thumbnail_id'] . ',"mediaSrc":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/categories/category-accessories.jpg","categoryId":' . $featured_categories_data['accessories']['id'] . ',"showDesc":false,"className":"is-style-heim-simplified"} -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill","fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size is-style-fill has-small-font-size"><a class="wp-block-button__link wp-element-button" href="' . $featured_categories_data['accessories']['url'] . '">Shop now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:woocommerce/featured-category --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:woocommerce/featured-category {"dimRatio":0,"editMode":false,"imageFit":"cover","mediaId":' . $featured_categories_data['essentials']['thumbnail_id'] . ',"mediaSrc":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/categories/category-essentials.jpg","categoryId":' . $featured_categories_data['essentials']['id'] . ',"showDesc":false,"className":"is-style-heim-simplified"} -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"white","className":"is-style-fill","fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size is-style-fill has-small-font-size"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="' . $featured_categories_data['essentials']['url'] . '">Shop now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:woocommerce/featured-category --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:woocommerce/featured-category {"dimRatio":0,"editMode":false,"imageFit":"cover","mediaId":' . $featured_categories_data['living']['thumbnail_id'] . ',"mediaSrc":"' . esc_url( get_template_directory_uri() ) . '/assets/images/starter-content/categories/category-living.jpg","categoryId":' . $featured_categories_data['living']['id'] . ',"showDesc":false,"className":"is-style-heim-simplified"} -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' . $featured_categories_data['living']['url'] . '">Shop now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:woocommerce/featured-category --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"38px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:38px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:group {"align":"wide","backgroundColor":"heim-body-contrast-2","className":"is-style-heim-cover-padding","layout":{"type":"constrained"}} -->
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
<!-- /wp:group -->

<!-- wp:spacer {"height":"38px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:38px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"align":"wide","className":"is-style-heim-standard-margins"} -->
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
<!-- /wp:columns -->

<!-- wp:spacer {"height":"22px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:22px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","align":"wide","fontSize":"medium"} -->
<h2 class="wp-block-heading alignwide has-text-align-center has-medium-font-size">Handpicked this Week</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"22px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:22px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:woocommerce/handpicked-products {"align":"wide","columns":4,"orderby":"menu_order","products":[' . $handpicked_product_ids . ']} /-->

<!-- wp:buttons {"align":"wide"} -->
<div class="wp-block-buttons alignwide"><!-- wp:button {"className":"aligncenter"} -->
<div class="wp-block-button aligncenter"><a class="wp-block-button__link wp-element-button" href="#">Shop All</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"34px","className":"is-style-heim-spacer-no-margin"} -->
<div style="height:34px" aria-hidden="true" class="wp-block-spacer is-style-heim-spacer-no-margin"></div>
<!-- /wp:spacer -->

<!-- wp:group {"align":"full","backgroundColor":"heim-body-contrast-2","layout":{"type":"constrained"}} -->
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

		// Page: Order Tracking
		'order-tracking' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Order Tracking',
			'post_content' => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:shortcode -->
[woocommerce_order_tracking]
<!-- /wp:shortcode -->

<!-- wp:spacer {"height":"90px","className":"is-style-heim-max-height-mobile"} -->
<div style="height:90px" aria-hidden="true" class="wp-block-spacer is-style-heim-max-height-mobile"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
		),
		
		// Page: Wishlist
		'wishlist' => array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Wishlist',
			'post_content' => '<!-- wp:shortcode -->
[nmw_wishlist]
<!-- /wp:shortcode -->',
		),
	);
	
	return $pages;
}

/**
 * Setup data: Menus
 */
function heim_setup_data_get_menus() {
	$menus = array(
		// Menu: Primary
		'primary' => array(
			'name'  => 'Primary',
			'items' => array(
				'shop' => array(
					'label'       => 'Shop',
					'type'        => 'page',
					'page_slug'   => 'shop',
					'css_classes' => 'megamenu',
				),
					'catalog' => array(
						'label'     => 'Catalog',
						'type'      => 'page',
						'parent'    => 'shop',
						'page_slug' => 'shop',
					),
						'default-button-filters' => array(
							'label'     => 'Default Button Filters',
							'type'      => 'page',
							'parent'    => 'catalog',
							'page_slug' => 'shop',
						),
						'sidebar-filters' => array(
							'label'  => 'Sidebar Filters',
							'type'   => 'custom',
							'parent' => 'catalog',
							'url'    => '#',
						),
						'sidebar-filters-w-toggle' => array(
							'label'  => 'Sidebar Filters w/ Toggle',
							'type'   => 'custom',
							'parent' => 'catalog',
							'url'    => '#',
						),
						'single-category' => array(
							'label'         => 'Single Category',
							'type'          => 'product-category',
							'parent'        => 'catalog',
							'category_slug' => 'essentials',
						),
						'pagination' => array(
							'label'  => 'Pagination',
							'type'   => 'custom',
							'parent' => 'catalog',
							'url'    => '#',
						),
					'product-types' => array(
						'label'        => 'Product Types',
						'type'         => 'product',
						'parent'       => 'shop',
						'product_slug' => 'sand-hourglass',
					),
						'simple-product' => array(
							'label'        => 'Simple Product',
							'type'         => 'product',
							'parent'       => 'product-types',
							'product_slug' => 'ceramic-flower-pot',
						),
						'variable-product' => array(
							'label'        => 'Variable Product<span class="label">Color, Size, Etc</span>',
							'type'         => 'product',
							'parent'       => 'product-types',
							'product_slug' => 'formed-dining-chair',
						),
						'grouped-product' => array(
							'label'        => 'Grouped Product',
							'type'         => 'product',
							'parent'       => 'product-types',
							'product_slug' => 'framed-leaf-artwork',
						),
						'external-product' => array(
							'label'        => 'External / Affiliate Product',
							'type'         => 'product',
							'parent'       => 'product-types',
							'product_slug' => 'timeless-pendant-lamp',
						),
						'downloadable-product' => array(
							'label'        => 'Downloadable Product',
							'type'         => 'product',
							'parent'       => 'product-types',
							'product_slug' => 'a5-notebook',
						),
					'product-states' => array(
						'label'  => 'Product States',
						'type'   => 'custom',
						'parent' => 'shop',
						'url'    => '#',
					),
						'reviews' => array(
							'label'        => 'Reviews',
							'type'         => 'product',
							'parent'       => 'product-states',
							'product_slug' => 'sand-hourglass',
						),
						'on-sale' => array(
							'label'        => 'On Sale',
							'type'         => 'product',
							'parent'       => 'product-states',
							'product_slug' => 'canola-oil',
						),
						'backorder' => array(
							'label'        => 'Backorder',
							'type'         => 'product',
							'parent'       => 'product-states',
							'product_slug' => 'powerful-smart-speaker',
						),
						'out-of-stock' => array(
							'label'        => 'Out of Stock',
							'type'         => 'product',
							'parent'       => 'product-states',
							'product_slug' => 'thermo-flask',
						),
					'shop-pages' => array(
						'label'     => 'Shop Pages',
						'type'      => 'page',
						'parent'    => 'shop',
						'page_slug' => 'cart',
					),
						'cart' => array(
							'label'     => 'Cart',
							'type'      => 'page',
							'parent'    => 'shop-pages',
							'page_slug' => 'cart',
						),
						'cart-style-2' => array(
							'label'     => 'Cart Style II<span class="label">Block</span>',
							'type'      => 'page',
							'parent'    => 'shop-pages',
							'page_slug' => 'cart-style-2',
						),
						'checkout' => array(
							'label'     => 'Checkout',
							'type'      => 'page',
							'parent'    => 'shop-pages',
							'page_slug' => 'checkout',
						),
						'checkout-style-2' => array(
							'label'     => 'Checkout Style II<span class="label">Block</span>',
							'type'      => 'page',
							'parent'    => 'shop-pages',
							'page_slug' => 'checkout-style-2',
						),
						'my-account' => array(
							'label'     => 'My account',
							'type'      => 'page',
							'parent'    => 'shop-pages',
							'page_slug' => 'my-account',
						),
				'pages' => array(
					'label'     => 'Pages',
					'type'      => 'page',
					'page_slug' => 'about',
				),
					'home' => array(
						'label'     => 'Home',
						'type'      => 'page',
						'parent'    => 'pages',
						'page_slug' => 'home',
					),
					'about-in-sub' => array( // Note: Added "-in-sub" since there should be no duplicate slugs (in the same menu array)
						'label'     => 'About Us',
						'type'      => 'page',
						'parent'    => 'pages',
						'page_slug' => 'about',
					),
					'contact-us' => array(
						'label'     => 'Contact',
						'type'      => 'page',
						'parent'    => 'pages',
						'page_slug' => 'contact-us',
					),
					'blog-in-sub' => array(
						'label'     => 'Blog',
						'type'      => 'page',
						'parent'    => 'pages',
						'page_slug' => 'blog',
					),
					'post' => array(
						'label'     => 'Post',
						'type'      => 'post',
						'parent'    => 'pages',
						'page_slug' => 'finding-the-perfect-coffee-set',
					),
					'post-w-comments' => array(
						'label'     => 'Post w/ Comments',
						'type'      => 'post',
						'parent'    => 'pages',
						'page_slug' => 'the-monstera-plant',
					),
					'faq' => array(
						'label'     => 'FAQ',
						'type'      => 'page',
						'parent'    => 'pages',
						'page_slug' => 'faq',
					),
					'404-not-found' => array(
						'label'  => '404',
						'type'   => 'custom',
						'parent' => 'pages',
						'url'    => get_site_url( null, '/404' ),
					),
				'blog' => array(
					'label'      => 'Blog',
					'type'       => 'page',
					'page_slug'  => 'blog',
				),
				'about' => array(
					'label'     => 'About',
					'type'      => 'page',
					'page_slug' => 'about',
				),
			),
		),

		// Menu: Mobile secondary
		'mobile-secondary' => array(
			'name'  => 'Mobile menu secondary',
			'items' => array(
				'about' => array(
					'label'     => 'About',
					'type'      => 'page',
					'page_slug' => 'about',
				),
				'contact-us' => array(
					'label'     => 'Contact',
					'type'      => 'page',
					'page_slug' => 'contact-us',
				),
				'faq' => array(
					'label'     => 'FAQ',
					'type'      => 'page',
					'page_slug' => 'faq',
				),
				'order-tracking' => array(
					'label'     => 'Order Tracking',
					'type'      => 'page',
					'page_slug' => 'order-tracking',
				),
			),
		),

		// Menu: Footer
		'footer' => array(
			'name'  => 'Footer',
			'items' => array(
				'cookie-policy' => array(
					'label' => 'Cookie Policy',
					'type'  => 'custom',
					'url'   => '#',
				),
				'terms-and-conditions' => array(
					'label' => 'Terms & Conditions',
					'type'  => 'custom',
					'url'   => '#',
				),
				'order-tracking' => array(
					'label'     => 'Order Tracking',
					'type'      => 'page',
					'page_slug' => 'order-tracking',
				),
			),
		),

		// Menu: Quick Links (no menu location)
		'nolocation-quick-links' => array(
			'name'  => 'Quick Links',
			'items' => array(
				'about' => array(
					'label'     => 'About',
					'type'      => 'page',
					'page_slug' => 'about',
				),
				'my-account' => array(
					'label'     => 'My account',
					'type'      => 'page',
					'page_slug' => 'my-account',
				),
				'my-orders' => array(
					'label'     => 'My orders',
					'type'      => 'page',
					'page_slug' => 'my-account',
				),
			),
		),

		// Menu: Customer Care (no menu location)
		'nolocation-customer-care' => array(
			'name'  => 'Customer Care',
			'items' => array(
				'contact-us' => array(
					'label'     => 'Contact Us',
					'type'      => 'page',
					'page_slug' => 'contact-us',
				),
				'faq' => array(
					'label'     => 'FAQs',
					'type'      => 'page',
					'page_slug' => 'faq',
				),
			),
		),
	);
	
	return $menus;
}

/**
 * Setup data: Widgets
 */
function heim_setup_data_get_widgets() {
	$widgets = array(
		// Widgets: Shop
		'shop-filters-widgets' => array(
			// Widget: Product categories
			'product-categories' => array(
				'title'   => '',
				'content' => '<!-- wp:group {"className":"no-toggle","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group no-toggle"><!-- wp:heading {"level":3} -->
<h3>Categories</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-categories /--></div>
<!-- /wp:group -->',
			),
		
			// Widget: Price filter
			'price-filter' => array(
				'title'   => '',
				'content' => '<!-- wp:woocommerce/filter-wrapper {"filterType":"price-filter","heading":"Price"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3>Price</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/price-filter {"showInputFields":false,"showFilterButton":true,"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-price-filter is-loading" data-showinputfields="false" data-showfilterbutton="true" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-categories__placeholder"></span></div>
<!-- /wp:woocommerce/price-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->',
			),

			// Widget: Stock filter
			'stock-filter' => array(
				'title'   => '',
				'content' => '<!-- wp:woocommerce/filter-wrapper {"filterType":"stock-filter","heading":"Status"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3>Stock</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/stock-filter {"showFilterButton":true,"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-stock-filter is-loading" data-show-counts="true" data-heading="" data-heading-level="3" data-show-filter-button="true"><span aria-hidden="true" class="wc-block-product-stock-filter__placeholder"></span></div>
<!-- /wp:woocommerce/stock-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->',
			),

			// Widget: Rating filter
			'rating-filter' => array(
				'title'   => '',
				'content' => '<!-- wp:woocommerce/filter-wrapper {"filterType":"rating-filter","heading":"Rating"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3>Rating</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/rating-filter {"showFilterButton":true,"lock":{"remove":true}} -->
<div class="wp-block-woocommerce-rating-filter is-loading" data-show-counts="true"><span aria-hidden="true" class="wc-block-product-rating-filter__placeholder"></span></div>
<!-- /wp:woocommerce/rating-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->',
			),
		),

		// Widgets: Footer
		'footer-widgets' => array(
			// Widget: Info block
			'info-block' => array(
				'title'   => '',
				'content' => '<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4} -->
<h4>Heim Co.</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"widget-text-max-width"} -->
<p class="widget-text-max-width">A store for people that want to buy less, but better. We offer a unique collection of high end items for every home.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"4px"} -->
<div style="height:4px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:social-links {"iconColor":"heim-text","iconColorValue":"var(\u002d\u002dglobal\u002d\u002dcolor-font)","openInNewTab":true,"className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://instagram.com","service":"instagram"} /-->

<!-- wp:social-link {"url":"https://twitter.com","service":"twitter"} /-->

<!-- wp:social-link {"url":"https://facebook.com","service":"facebook"} /--></ul>
<!-- /wp:social-links -->

<!-- wp:spacer {"height":"1px"} -->
<div style="height:1px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->',
			),

			// Widget: Product categories
			'product-categories' => array(
				'title'   => '',
				'content' => '<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"normal"} -->
<h3 class="has-normal-font-size" style="font-style:normal;font-weight:400">Categories</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-categories {"hasCount":false} /--></div>
<!-- /wp:group -->',
			),

			// Widget: Product categories
			'product-categories-2' => array(
				'title'   => '',
				'content' => '<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"normal"} -->
<h3 class="has-normal-font-size" style="font-style:normal;font-weight:400">Categories </h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-categories {"hasCount":false} /--></div>
<!-- /wp:group -->',
			),
		),
	);
	
	return $widgets;
}
