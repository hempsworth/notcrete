<?php
/**
 * Heim theme setup
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class: Theme setup
 */
class Heim_Theme_Setup {
	
	/**
	 * Page setup
	 */
	protected $theme_title = 'Heim';
	protected $page_slug = 'heim-theme-setup';
	protected $page_title;
	
	/**
	 * Setup loaded status
	 */
	protected $setup_loaded_option_slug = 'heim_setup_loaded';
	protected $setup_loaded = false;
	
	/**
	 * Tasks completed status
	 */
	protected $tasks_completed_option_slug = 'heim_setup_tasks_completed';
	protected $task_completed_content = 'none';
	
	/**
	 * Content install tasks
	 */
	protected $content_install_tasks = array();
	
	/**
	 * Constructor
	 */
	public function __construct() {
		// Includes
		require_once HEIM_THEME_INC_DIR . '/setup/includes/heim-plugin-installer.php';
		
		// Admin page title
		$this->page_title = esc_html_x( 'Theme Setup', 'Theme setup', 'heim' );
		
		// Set content install tasks
		$this->content_install_tasks = array(
			'attachments' => array(
				'progressMessage' => esc_html_x( 'Importing Attachments', 'Theme setup', 'heim' ),
			),
			'posts' => array(
				'progressMessage' => esc_html_x( 'Importing Posts', 'Theme setup', 'heim' ),
			),
			'products' => array(
				'progressMessage' => esc_html_x( 'Importing Products', 'Theme setup', 'heim' ),
			),
			'pages' => array(
				'progressMessage' => esc_html_x( 'Importing Pages', 'Theme setup', 'heim' ),
			),
			'menus' => array(
				'progressMessage' => esc_html_x( 'Importing Menus', 'Theme setup', 'heim' ),
			),
			'widgets' => array(
				'progressMessage' => esc_html_x( 'Importing Widgets', 'Theme setup', 'heim' ),
			),
			'configure' => array(
				'progressMessage' => esc_html_x( 'Configuring Settings', 'Theme setup', 'heim' ),
			),
		);
		
		// Set "setup loaded" status
		$this->setup_loaded = get_option( $this->setup_loaded_option_slug, false );
		$this->setup_loaded = ( '1' === $this->setup_loaded ) ? true : false;
		
		// Get completed setup tasks
		$tasks_completed = get_option( $this->tasks_completed_option_slug, array() );
		
		// Set content tasks status
		if ( empty( $tasks_completed ) ) {
			$this->task_completed_content = 'none';
		} else {
			$content_task_missing = false;
			foreach ( $this->content_install_tasks as $task_id => $task ) {
				if ( ! isset( $tasks_completed[$task_id] ) ) {
					$content_task_missing = true;
					break;
				}
			}
			$this->task_completed_content = ( $content_task_missing ) ? 'some' : 'all';
		}
		
		$this->init();
	}
	
	/**
	 * Hooks and filters
	 */	
	public function init() {
		// Enqueue styles and scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
		
		// Theme switch hook - If setup hasn't loaded previously, add hook for loading it after theme activation
		if ( ! $this->setup_loaded ) {
			add_action( 'after_switch_theme', array( $this, 'redirect_to_setup' ) );
			
			$this->tasks_set_completed( 'loaded' );
		}
		
		// Add WP admin page
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		
		// AJAX hooks
		add_action( 'wp_ajax_plugin_install', array( $this, 'plugin_install' ) );
		add_action( 'wp_ajax_content_install', array( $this, 'content_install' ) );
	}
	
	/**
	 * Theme activation redirect
	 */
	public function redirect_to_setup() {
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
			wp_redirect( admin_url( 'themes.php?page=' . esc_attr( $this->page_slug ) ) );
		}
	}
	
	/**
	 * Include assets
	 */
	public  function assets() {
		wp_enqueue_style( 'heim-setup', get_template_directory_uri() . '/includes/setup/assets/setup.css', array(), time() );
		wp_enqueue_script( 'heim-setup', get_template_directory_uri() . '/includes/setup/assets/setup.js', array( 'jquery' ), time() );
		wp_localize_script( 'heim-setup', 'heim_setup_data', array(
			'ajaxurl'     => admin_url( 'admin-ajax.php' ),
			'wpnonce'     => wp_create_nonce( 'heim_setup_nonce' ),
			'importtasks' => $this->content_install_tasks,
		) );
	}
	
	/**
	 * Admin page
	 */
	public function menu_page() {
		add_theme_page( $this->page_title, $this->page_title, 'manage_options', $this->page_slug, array( $this, 'view' ) );
	}
	
	/**
	 * Steps
	 */
	public function get_steps() {
		$steps = array( 
			'intro' => array(
				'id'	        => 'intro',
				'callback'      => 'do_next_step',
				'view'	        => 'view_intro',
			),
			'plugins' => array(
				'id'	        => 'plugins',
				'callback'      => 'plugins_install',
				'view'          => 'view_plugins',
			),
			'content' => array(
				'id'	        => 'content',
				'callback'      => 'content_install',
				'view'	        => 'view_content',
			),
			'final' => array(
				'id'            => 'final',
				'callback'      => '',
				'view'	        => 'view_final',
			),
		);
		
		return $steps;
	}
	
	/**
	 * View
	 */
	public function view() {
		$steps = $this->get_steps();
		
		?>
		<div class="heim-setup wrap">
			<?php printf( '<h1>%s</h1>', esc_html( $this->page_title ) ); ?>
			
			<div id="heim-setup-notice" class="hide">
				<p></p>
			</div>
			
			<div class="heim-setup-view card">
				<div class="heim-setup-cover"></div>
				
				<div class="heim-setup-steps">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>">
					
					<?php
					foreach ( $steps as $step ) {
						echo '<div class="heim-setup-step step-' . esc_attr( $step['id'] ) . '" data-step="' . esc_attr( $step['id'] ) . '">';
							$content = call_user_func( array( $this, $step['view'] ) );
							echo wp_kses_post( $content );
						echo '</div>';
					}
					?>
				</div>
				
				<div class="heim-setup-spinner">
					<img src="images/spinner.gif">
				</div>
			</div>
		</div>
	<?php
	}
	
	/**
	 * View: Intro
	 */
	public function view_intro() {
		ob_start();
		
		?>
		<h2>
			<?php
				/* translators: %s: theme title */
				printf( esc_html_x( 'Welcome to %s', 'Theme setup', 'heim' ), esc_html( $this->theme_title ) );
			?>
		</h2>
		
		<div class="heim-setup-summary">
			<p><?php echo esc_html_x( 'This wizard will help you set-up the theme, install WooCommerce and import demo content. This is optional and should take a couple of minutes.', 'Theme setup', 'heim' ); ?></p>
		</div>
		
		<div class="heim-setup-button-wrap">
			<a href="<?php echo esc_url( admin_url() ); ?>" class="button button-secondary">
				<?php echo esc_html_x( 'Skip', 'Theme setup', 'heim' ); ?>
			</a>
			
			<strong>1 / 3</strong>
			
			<a href="#" class="button button-primary heim-setup-button" data-callback="do_next_step" data-step="intro">
				<?php echo esc_html_x( 'Next', 'Theme setup', 'heim' ); ?>
			</a>
		</div>
		<?php
		
		$content = ob_get_clean();
		
		return $content;
	}
	
	/**
	 * View: Plugins/WooCommerce
	 */
	public function view_plugins() {
		$plugins = heim_plugin_installer_get_plugins();
		
		$woocommerce_plugin_activated = ( isset( $plugins['woocommerce'] ) && 'activated' === $plugins['woocommerce']['status'] ) ? true : false;
		
		ob_start();
		
		?>
		<h2><?php echo esc_html_x( 'Install WooCommerce', 'Theme setup', 'heim' ); ?></h2>
		
		<?php if ( ! $woocommerce_plugin_activated ) : ?>
		
		<div class="heim-setup-summary">
			<p><?php echo esc_html_x( "Let's start by installing WooCommerce. This is an optional step, but required to enable the theme's e-commerce features.", 'Theme setup', 'heim' ); ?></p>
		</div>
		
		<ul class="heim-setup-tasks heim-setup-tasks-plugins">
			<?php
			foreach ( $plugins as $plugin_slug => $plugin ) {
				printf(
					'<li data-status="%1$s" data-plugin="%2$s"><div>%3$s: <span>%4$s</span></div></li>',
					esc_html( $plugin['status'] ),
					esc_attr( $plugin['file'] ),
					esc_html_x( 'Status', 'Theme setup', 'heim' ),
					esc_html( $plugin['status_message'] )
				);
			}				
		
			?>
		</ul>
		
		<div class="heim-setup-button-wrap">
			<a href="#" class="button button-secondary heim-setup-button" data-callback="do_next_step" data-step="plugins">
				<?php echo esc_html_x( 'Skip', 'Theme setup', 'heim' ); ?>
			</a>
			
			<strong>2 / 3</strong>
			
			<a href="#" class="button button-primary heim-setup-button" data-callback="plugins_install" data-step="plugins">
				<?php echo esc_html_x( 'Next', 'Theme setup', 'heim' ); ?>
			</a>
		</div>
		
		<?php else : ?>
		
		<div class="heim-setup-summary">
			<p><?php echo esc_html_x( 'Great, WooCommerce is already installed.', 'Theme setup', 'heim' ); ?></p>
		</div>
		
		<div class="heim-setup-button-wrap">
			<a href="#" class="button button-primary heim-setup-button" data-callback="do_next_step" data-step="plugins">
				<?php echo esc_html_x( 'Next', 'Theme setup', 'heim' ); ?>
			</a>
		</div>
		<?php
		
		endif;
		
		$content = ob_get_clean();
		
		return $content;
	}
	
	/**
	 * View: Content
	 */
	public function view_content() {
		if ( 'none' === $this->task_completed_content ) {
			$content_status = esc_html_x( 'Not installed', 'Theme setup', 'heim' );
		} else {
			$content_status = ( 'all' === $this->task_completed_content ) ? esc_html_x( 'Installed', 'Theme setup', 'heim' ) : esc_html_x( 'Partially installed', 'Theme setup', 'heim' );
		}
		
		$button_title = ( 'none' === $this->task_completed_content ) ? esc_html_x( 'Import', 'Theme setup', 'heim' ) : esc_html_x( 'Import Again', 'Theme setup', 'heim' );
		
		ob_start();
		
		?>
		<h2><?php echo esc_html_x( 'Import Content', 'Theme setup', 'heim' ); ?></h2>
		
		<div class="heim-setup-summary">
			<p><?php echo esc_html_x( 'Do you want to import the demo content?', 'Theme setup', 'heim' ); ?></p>
			
			<p>
				<?php
					/* translators: 1: strong tag open 2: strong tag close */
					printf( esc_html_x( '%1$sNote:%2$s It\'s recommended to import the demo content on a New/Empty WordPress installation.', 'Theme setup', 'heim' ), '<strong>', '</strong>' );
				?>
			</p>
			
			<ul class="heim-setup-tasks heim-setup-tasks-content">
				<li class="heim-setup-task-content">
					<div>Status: <span><?php echo esc_html( $content_status ); ?></span></div>
				</li>
			</ul>
		</div>
		
		<div class="heim-setup-button-wrap">
			<a href="#" class="button button-secondary heim-setup-button" data-callback="do_next_step" data-step="content">
				<?php echo esc_html_x( 'Skip', 'Theme setup', 'heim' ); ?>
			</a>
			
			<strong>3 / 3</strong>
			
			<a href="#" class="button button-primary heim-setup-button" data-callback="content_install" data-step="content">
				<?php echo esc_html( $button_title ); ?>
			</a>
		</div>
		<?php
		
		$content = ob_get_clean();
		
		return $content;
	}
	
	/**
	 * View: Final
	 */
	public function view_final() {
		ob_start();
		
		?>
		<h2><?php echo esc_html_x( "That's It!", 'Theme setup', 'heim' ); ?></h2>
		
		<div class="heim-setup-summary">
			<p><?php echo esc_html_x( 'Setup is done, you can it run again via "Appearance > Theme Setup" in the WordPress admin if needed.', 'Theme setup', 'heim' ); ?></p>
		</div>

		<div class="heim-setup-info">
			<ul>
				<li><strong><?php echo esc_html_x( 'Useful links:', 'Theme setup', 'heim' ); ?></strong></li>
				<li><a href="#" target="_blank"><?php echo esc_html_x( 'Theme Documentation', 'Theme setup', 'heim' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-admin' ) ); ?>" target="_blank"><?php echo esc_html_x( 'WooCommerce Setup Wizard', 'Theme setup', 'heim' ); ?></a></li>
			</ul>
		</div>
		
		<div class="heim-setup-button-wrap">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-primary" target="_blank"><?php echo esc_html_x( 'Visit Site', 'Theme setup', 'heim' ); ?></a>
		</div>
		<?php
		
		$content = ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Tasks: Set completed
	 */
	public function tasks_set_completed( $task ) {
		if ( 'loaded' === $task ) {
			update_option( $this->setup_loaded_option_slug, '1' );
		} else {
			$tasks_completed = get_option( $this->tasks_completed_option_slug, array() );

			$tasks_completed[$task] = 1;

			update_option( $this->tasks_completed_option_slug, $tasks_completed );
		}
	}
	
	/**
	 * Plugins - AJAX: Install/activate single plugin
	 */
	public function plugin_install() {
		if ( ! check_ajax_referer( 'heim_setup_nonce', 'wpnonce' ) || empty( $_POST['plugin'] ) ) {
			wp_send_json_error( 'No plugin slug available' );
		}
		
		$plugin = sanitize_text_field( $_POST['plugin'] );
		
		heim_plugin_installer_activate_plugin( $plugin );
		
		exit;
	}
	
	/**
	 * Content - AJAX: Install
	 */
	public function content_install() {
		check_ajax_referer( 'heim_setup_nonce', 'wpnonce' );
		
		$installation_task = ( isset( $_POST['task'] ) ) ? sanitize_text_field( $_POST['task'] ) : null;
		
		switch ( $installation_task ) {
			case 'attachments':
				$this->install_attachments();
				$this->tasks_set_completed( 'attachments' );
				break;
			
			case 'posts':
				$this->install_posts();
				$this->tasks_set_completed( 'posts' );
				break;
			
			case 'products':
				$this->install_products();
				$this->tasks_set_completed( 'products' );
				break;
			
			case 'pages':
				$this->install_pages();
				$this->tasks_set_completed( 'pages' );
				break;
				
			case 'menus':
				$this->install_menus();
				$this->tasks_set_completed( 'menus' );
				break;
				
			case 'widgets':
				$this->install_widgets();
				$this->tasks_set_completed( 'widgets' );
				break;
			
			case 'configure':
				$this->install_configure();
				$this->tasks_set_completed( 'configure' );
				break;
		}
		
		exit;
	}
	
	/**
	 * Install: Attachments
	 */
	public function install_attachments() {
		$attachments = heim_setup_data_get_attachments();
		
		// Change WooCommerce image-size settings before importing
		if ( heim_woocommerce_active() ) {
			// Image width
			update_option( 'woocommerce_single_image_width', 700 );
			update_option( 'woocommerce_thumbnail_image_width', 400 );
			
			// Disable thumbnail cropping
			update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );
		}
		
		$upload_dir = wp_upload_dir();
		
		foreach ( $attachments as $attachment_slug => $attachment_data ) {
			$attachment_exists = get_posts( array(
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'name'           => $attachment_slug,
				'posts_per_page' => 1,
			) );
			
			// If attachment exists, continue to next
			if ( ! empty( $attachment_exists ) ) {
				printf( 'Heim setup: Attachment %s already exists. ', esc_html( $attachment_slug ) );
				continue;
			}
			
			$source_file = get_parent_theme_file_path( $attachment_data['file'] );
			$filename = basename( $source_file );
			$existing_file = $upload_dir['path'] . '/' . $filename;
						
			// Upload file, or get file data if it already exists
			if ( ! file_exists( $existing_file ) ) {
				// Based on: https://stackoverflow.com/a/19750945
				$upload = wp_upload_bits( $filename, null, file_get_contents( $source_file ) );
				if ( $upload['error'] ) {
					printf( 'Heim setup: Failed to upload file: %s ', esc_html( $upload['error'] ) );
					continue;
				}
			} else {
				$upload = wp_check_filetype( basename( $filename ), null );
				
				if ( ! $upload || ! is_array( $upload ) ) {
					printf( 'Heim setup: Failed to get filetype for: %s ', esc_html( $filename ) );
					continue;
				}
				
				$upload['file'] = $existing_file;
			}
			
			$attachment_args = array(
				'guid'           => $upload['file'],
				'post_mime_type' => $upload['type'],
				'post_title'     => sanitize_file_name( $attachment_slug ),
				'post_content'   => '',
				'post_status'    => 'inherit',
			);
			
			// Add attachment for uploaded file
			$attachment_id = wp_insert_attachment( $attachment_args, $upload['file'] );

			// Required by wp_generate_attachment_metadata()
			require_once ABSPATH . 'wp-admin/includes/image.php';
			
			// Add metadata for attachment
			$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
			wp_update_attachment_metadata( $attachment_id, $attachment_metadata );
		}
	}
	
	/**
	 * Install: Posts
	 */
	public function install_posts() {
		$posts = heim_setup_data_get_posts();
		
		foreach ( $posts as $post_slug => $post_data ) {
			$post_exists = get_posts( array(
				'post_type'   => 'post',
				'name'        => $post_slug,
				'post_status' => 'publish',
				'numberposts' => 1,
			) );
			
			if ( ! empty( $post_exists ) ) {
				printf( 'Heim setup: Post exists: %s. ', esc_html( $post_data['post_title'] ) );
				continue;
			}
			
			// Add main post
			$post_id = wp_insert_post( $post_data );
			
			// Add featured image
			if ( isset( $post_data['thumbnail'] ) ) {
				$attachment = get_posts( array(
					'post_type'      => 'attachment',
					'name'           => $post_data['thumbnail'],
					'post_status'    => 'inherit',
					'posts_per_page' => 1,
				) );
				$attachment = ( $attachment ) ? array_pop( $attachment ) : null;
				
				if ( $attachment ) {
					set_post_thumbnail( $post_id, $attachment->ID );
				}
			}
			
			// Add categories and tags
			if ( isset( $post_data['taxonomies'] ) ) {
				foreach ( $post_data['taxonomies'] as $taxonomy_slug => $terms ) {
					$post_term_ids = array();
					
					foreach ( $terms as $term_item ) {
						$term_exists = term_exists( $term_item['slug'], $taxonomy_slug );
						
						if ( $term_exists && ! empty( $term_exists ) ) {
							$post_term = $term_exists;
						} else {
							$post_term = wp_insert_term( $term_item['name'], $taxonomy_slug, array( 'slug' => $term_item['slug'], ) );
						}
						
						if ( is_array( $post_term ) && isset( $post_term['term_id'] ) ) {
							// Note: The ID must be an integer when term is non-hierarchical (like a Tag) - https://developer.wordpress.org/reference/functions/wp_set_post_terms/#user-contributed-notes
							$post_term_ids[] = intval( $post_term['term_id'] );
						}
					}
					
					if ( ! empty( $post_term_ids ) ) {
						wp_set_post_terms( $post_id, $post_term_ids, $taxonomy_slug, true );
						
						// Remove default "uncategorized" category
						if ( 'category' === $taxonomy_slug ) {
							wp_remove_object_terms( $post_id, 'uncategorized', $taxonomy_slug );
						}
					}
				}
			}
		}
	}
	
	/**
	 * Install: Products
	 */
	public function install_products() {
		if ( ! class_exists( 'woocommerce' ) ) {
			echo 'Heim setup: WooCommerce not available';
			exit;
		}
		
		$products = heim_setup_data_get_products();
		
		$products_count = count( $products ) + 1;
		
		foreach ( $products as $product_slug => $product_data ) {
			// Does product already exist?
			$product_exists = get_page_by_title( $product_data['name'], OBJECT, 'product' );
			// Make sure product is published since it could be in the trash
			$product_exists = ( $product_exists ) ? get_posts( array(
				'post_type'   => 'product',
				'p'           => $product_exists->ID,
				'post_status' => 'publish',
				'numberposts' => 1,
			) ) : null;
			
			if ( $product_exists && ! empty( $product_exists ) ) {
				printf( 'Heim setup: Product "%s" exists. ', esc_html( $product_data['name'] ) );
				continue;
			}
			
			// Get WooCommerce product class
			switch ( $product_data['product_type'] ) {
				case 'external':
					$product = new WC_Product_External();
					break;
				
				case 'grouped':
					$product = new WC_Product_Grouped();
					break;
						
				case 'variable':
					$product = new WC_Product_Variable();
					break;
				
				default:
					$product = new WC_Product_Simple();
					break;
			}
			
			// Menu order
			$menu_order = $products_count--;
			$product->set_menu_order( $menu_order );
			
			// Name and description
			$product->set_name( $product_data['name'] );
			$product->set_short_description( $product_data['short_description'] );
			$product->set_description( $product_data['description'] );
			
			// Price (non variable)
			if ( 'variable' !== $product_data['product_type'] ) {
				$product->set_regular_price( intval( $product_data['regular_price'] ) );
				
				if ( isset( $product_data['sale_price'] ) && intval( $product_data['sale_price'] ) > 0 ) {
					$product->set_sale_price( intval( $product_data['sale_price'] ) );
				}
			}
			
			// Thumbnail
			$thumbnail_attachment = get_posts( array(
				'post_type'      => 'attachment',
				'name'           => $product_data['thumbnail'],
				'post_status'    => 'inherit',
				'posts_per_page' => 1,
			) );
			$thumbnail_attachment = ( $thumbnail_attachment ) ? array_pop( $thumbnail_attachment ) : null;
			if ( $thumbnail_attachment ) {
				$product->set_image_id( $thumbnail_attachment->ID );
			}
			
			// Gallery image
			if ( isset( $product_data['gallery_image'] ) ) {
				$gallery_image_attachment = get_posts( array(
					'post_type'      => 'attachment',
					'name'           => $product_data['gallery_image'],
					'post_status'    => 'inherit',
					'posts_per_page' => 1,
				) );
				$gallery_image_attachment = ( $gallery_image_attachment ) ? array_pop( $gallery_image_attachment ) : null;
				if ( $gallery_image_attachment ) {
					$product->set_gallery_image_ids( array( $gallery_image_attachment->ID ) );
				}
			}
			
			// Catalog visibility
			$product->set_catalog_visibility( 'visible' );

			// Stock status
			$product->set_stock_status( $product_data['stock_status'] );
			
			// Grouped product
			if ( 'grouped' === $product_data['product_type'] ) {
				$grouped_product_ids = array();
				
				foreach ( $product_data['grouped_products'] as $product_slug => $product_title ) {
					$grouped_product = get_page_by_title( $product_title, OBJECT, 'product' );
					$grouped_product_id = ( $grouped_product ) ? $grouped_product->ID : null;
					
					if ( $grouped_product_id ) {
						$grouped_product_ids[] = $grouped_product_id;
					}
				}
				
				$product->set_children( $grouped_product_ids );
			}
			
			// External product
			if ( 'external' === $product_data['product_type'] ) {
				$product->set_button_text( $product_data['button_text'] );
				$product->set_product_url( $product_data['product_url'] );
			}
			
			// Dimensions and weight
			if ( isset( $product_data['weight'] ) ) {
				$product->set_weight( $product_data['weight'] );
			}
			if ( isset( $product_data['length'] ) ) {
				$product->set_length( $product_data['length'] );
			}
			if ( isset( $product_data['width'] ) ) {
				$product->set_width( $product_data['width'] );
			}
			if ( isset( $product_data['height'] ) ) {
				$product->set_height( $product_data['height'] );
			}
			
			// Featured
			if ( isset( $product_data['featured'] ) ) {
				$product->set_featured( true );
			}
			
			// Product Categories and Tags
			if ( isset( $product_data['taxonomies'] ) ) {
				foreach ( $product_data['taxonomies'] as $taxonomy_slug => $terms ) {
					$term_ids = array();

					foreach ( $terms as $term_item ) {
						$term_exists = term_exists( $term_item['name'], $taxonomy_slug );
						
						if ( $term_exists ) {
							$term_ids[] = intval( $term_exists['term_id'] );
							continue;
						}
						
						// Add description
						$term_description = ( isset( $term_item['description'] ) ) ? $term_item['description'] : '';
						
						$term_added = wp_insert_term( $term_item['name'], $taxonomy_slug, array( 'slug' => $term_item['slug'], 'description' => $term_description ) );
						
						if ( is_wp_error( $term_added ) ) {
							printf( 'Heim setup: Unable to add product taxonomy: %s. ', esc_html( $term_item['name'] ) );
							continue;
						}
						
						// Add thumbnail
						if ( isset( $term_item['thumbnail'] ) ) {
							$thumbnail = get_posts( array(
								'post_type'      => 'attachment',
								'name'           => $term_item['thumbnail'],
								'post_status'    => 'inherit',
								'posts_per_page' => 1,
							) );
							$thumbnail = ( $thumbnail ) ? array_pop( $thumbnail ) : null;
							if ( $thumbnail ) {
								update_term_meta( $term_added['term_id'], 'thumbnail_id', intval( $thumbnail->ID ) );
							}
						}
						
						$term_ids[] = $term_added['term_id'];
					}
					
					if ( 'product_cat' === $taxonomy_slug ) {
						$product->set_category_ids( $term_ids );
					} else {
						$product->set_tag_ids( $term_ids );
					}
				}
			}
			
			// Product Attributes and Variations
			if ( isset( $product_data['attributes'] ) ) {
				$attributes = array();
				$attribute_position_count = -1;
				
				// Add attributes
				foreach ( $product_data['attributes'] as $attribute_slug => $attribute_data ) {
					$attribute_position_count++;
					
					// Check if attribute already exists
					/*ALT (global attributes): $attribute_id = wc_attribute_taxonomy_id_by_name( 'pa_' . $attribute_slug );
					
					if ( ! $attribute_id ) {
						// Create attribute
						$attribute_id = wc_create_attribute( array(
							//'id'           => '',
							'name'         => $attribute_data['name'],
							'slug'         => $attribute_slug,
							'type'         => 'select',
							'orderby'      => 'menu_order',
							'has_archives' => 0,
						) );
						
						if ( is_wp_error( $attribute_id ) ) {
							echo 'Heim setup: Unable to add product attribute: ' . $attribute_data['name'] . '. ';
							continue;
						}
					}
					
					// Steps below are needed (not sure if this will work)
					https://stackoverflow.com/questions/58110425/created-woocommerce-product-attribute-programmatically-and-added-terms-to-them-b
					https://www.websitebuilderinsider.com/how-to-create-attributes-in-woocommerce-programmatically/
					// - Register taxonomy
					// - Add terms
					// - Create array of term IDs (pass it to $attribute->set_options below)
					
					$attribute = new WC_Product_Attribute();
					$attribute->set_id( $attribute_id );
					$attribute->set_name( 'pa_' . $attribute_slug );
					$attribute->set_options( $attribute_data['terms'] ); // OBS: Dette må endres til array med term IDs
					$attribute->set_position( $attribute_position_count );
					$attribute->set_visible( true );
					if ( $attribute_data['is_variation'] ) {
						$attribute->set_variation( true );
					}
					$attributes[] = $attribute;*/
					$attribute = new WC_Product_Attribute();
					$attribute->set_name( $attribute_data['name'] );
					$attribute->set_options( $attribute_data['terms'] );
					$attribute->set_position( $attribute_position_count );
					if ( $attribute_data['is_visible'] ) {
						$attribute->set_visible( true );
					}
					if ( $attribute_data['is_variation'] ) {
						$attribute->set_variation( true );
					}
					$attributes[] = $attribute;
				}
				
				$product->set_attributes( $attributes );
				$product->save(); // Note: Make sure to save before adding variations
				
				// Add variations
				foreach ( $product_data['attributes'] as $variation_slug => $variation_data ) {
					if ( ! $variation_data['is_variation'] ) {
						continue;
					}
					
					$variation_options = array();
					foreach ( $variation_data['terms'] as $variation_option ) {
						//$variation_options[$variation_slug] = $variation_option;
						$variation_options[$variation_option] = '';
					}

					$variation = new WC_Product_Variation();
					$variation->set_parent_id( $product->get_id() );
					$variation->set_attributes( $variation_options );
					$variation->set_regular_price( $variation_data['regular_price'] );
					if ( isset( $variation_data['sale_price'] ) ) {
						$variation->set_sale_price( $variation_data['sale_price'] );
					}
					$variation->save();
				}
			} else {
				$product->save();
			}
			
			// Add review
			// Based on: https://stackoverflow.com/a/63824837
			if ( isset( $product_data['has_review'] ) ) {
				$product_id = $product->get_id();
				$current_user = wp_get_current_user();
				
				if ( $product_id && $current_user ) {
					$comment_id = wp_insert_comment( array(
						'comment_post_ID'      => $product_id,
						'comment_author'       => $current_user->display_name,
						'comment_author_email' => $current_user->user_email,
						'comment_author_url'   => '',
						'comment_content'      => 'Authentic keffiyeh master cleanse fingerstache single-origin coffee, cred beard sustainable gentrify gastropub. Kitsch ethical plaid wayfarers chia meditation artisan.',
						'comment_type'         => 'review',
						'comment_parent'       => 0,
						'user_id'              => $current_user->ID,
						'comment_author_IP'    => '',
						'comment_agent'        => '',
						'comment_date'         => gmdate( 'Y-m-d H:i:s' ),
						'comment_approved'     => 1,
					) );
					
					if ( $comment_id ) {
						update_comment_meta( $comment_id, 'rating', 5 );
						update_comment_meta( $comment_id, 'verified', 1 );
						
						$product->set_average_rating( '5.00' );
						$product->set_review_count( '1' );
						$product->set_rating_counts( array( 1, ) );
						
						$product->save();
					}
				}
			}
		}
	}
	
	/**
	 * Install: Pages
	 */
	public function install_pages() {
		$pages = heim_setup_data_get_pages();
		
		foreach ( $pages as $page_slug => $page_params ) {
			$page_params['post_name'] = $page_slug;
			
			$page_exists = get_page_by_path( $page_params['post_name'] );
			
			if ( $page_exists ) {
				printf( 'Heim setup: Page exists: %s. ', esc_html( $page_params['post_title'] ) );
				continue;
			}
			
			wp_insert_post( $page_params );
		}
	}
	
	/**
	 * Install: Menus
	 */
	public function install_menus() {
		$menus = heim_setup_data_get_menus();
		
		$menu_locations = array();
		
		foreach ( $menus as $menu_location => $menu_data ) {
			// Does the menu already exist?
			$menu_exists = wp_get_nav_menu_object( $menu_data['name'] );
			if ( $menu_exists ) {
				printf( 'Heim setup: Menu already exists: %s. ', esc_html( $menu_data['name'] ) );
				continue;
			}
			
			$menu_id       = wp_create_nav_menu( $menu_data['name'] );
			$menu_item_ids = array();
			
			foreach ( $menu_data['items'] as $item_slug => $item_data ) {
				// Title and status
				$menu_item_data = array(
					'menu-item-title'   => $item_data['label'],
					'menu-item-status'  => 'publish',
				);
				
				// CSS classes
				if ( isset( $item_data['css_classes'] ) ) {
					$menu_item_data['menu-item-classes'] = $item_data['css_classes'];
				}
				
				// Parent menu item
				if ( isset( $item_data['parent'] ) && isset( $menu_item_ids[$item_data['parent']] ) ) {
					$menu_item_data['menu-item-parent-id'] = $menu_item_ids[$item_data['parent']];
				}
				
				// Item link (ID or URL)
				switch ( $item_data['type'] ) {
					case 'page':
						$woocommerce_page_slugs = array(
							'shop'       => 'shop',
							'cart'       => 'cart',
							'checkout'   => 'checkout',
							'my-account' => 'myaccount',
						);
						
						// Is this a WooCommerce page?
						if ( heim_woocommerce_active() && isset( $woocommerce_page_slugs[$item_data['page_slug']] ) ) {
							$page_id = wc_get_page_id( $woocommerce_page_slugs[$item_data['page_slug']] );
							$page_id = ( intval( $page_id ) < 0 ) ? null : $page_id;
						} else {
							$page = get_page_by_path( $item_data['page_slug'], OBJECT, 'page' );
							$page_id = ( $page && isset( $page->ID ) ) ? $page->ID : null;
						}
						
						if ( ! $page_id ) {
							printf( 'Heim setup: Page not found: %s. ', esc_html( $item_data['label'] ) );
							
							$menu_item_data['menu-item-url']  = home_url( '/' );
							$menu_item_data['menu-item-type'] = 'custom';
						} else {
							$menu_item_data['menu-item-object-id'] = $page_id;
							$menu_item_data['menu-item-object']    = 'page';
							$menu_item_data['menu-item-type']      = 'post_type';
						}
						break;
					
					case 'post':
						$post = get_page_by_path( $item_data['page_slug'], OBJECT, 'post' );
						$post_id = ( $post && isset( $post->ID ) ) ? $post->ID : null;
									
						if ( ! $post_id ) {
							printf( 'Heim setup: Post not found: %s. ', esc_html( $item_data['label'] ) );
							
							$menu_item_data['menu-item-url']  = home_url( '/' );
							$menu_item_data['menu-item-type'] = 'custom';
						} else {
							$menu_item_data['menu-item-object-id'] = $post_id;
							$menu_item_data['menu-item-object']    = 'post';
							$menu_item_data['menu-item-type']      = 'post_type';
						}
						break;
						
					case 'product':
						$product_id = null;
						
						if ( heim_woocommerce_active() ) {
							$product = get_page_by_path( $item_data['product_slug'], OBJECT, 'product' );
							$product_id = ( $product && isset( $product->ID ) ) ? $product->ID : null;
						}
						
						if ( ! $product_id ) {
							printf( 'Heim setup: Product not found: %s. ', esc_html( $item_data['label'] ) );

							$menu_item_data['menu-item-url']  = home_url( '/' );
							$menu_item_data['menu-item-type'] = 'custom';
						} else {
							$menu_item_data['menu-item-object-id'] = $product_id;
							$menu_item_data['menu-item-object']    = 'product';
							$menu_item_data['menu-item-type']      = 'post_type';
						}
						break;
					
					case 'product-category':
						$product_category_id = null;
						
						if ( heim_woocommerce_active() ) {
							$product_category = get_term_by( 'slug', $item_data['category_slug'], 'product_cat' );
							$product_category_id = ( $product_category && isset( $product_category->term_id ) ) ? $product_category->term_id : null;
						}
						
						if ( ! $product_category_id ) {
							printf( 'Heim setup: Product Category not found: %s. ', esc_html( $item_data['label'] ) );

							$menu_item_data['menu-item-url']  = home_url( '/' );
							$menu_item_data['menu-item-type'] = 'custom';
						} else {
							$menu_item_data['menu-item-object-id'] = $product_category_id;
							$menu_item_data['menu-item-object']    = 'product_cat';
							$menu_item_data['menu-item-type']      = 'taxonomy';
						}
						break;
					
					// "Custom" menu item
					default:
						$menu_item_data['menu-item-url']  = $item_data['url'];
						$menu_item_data['menu-item-type'] = 'custom';
						break;
				}
				
				$menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );
				
				if ( is_wp_error( $menu_item_id ) ) {
					printf( 'Heim setup: Unable to add menu item: %s. ', esc_html( $item_data['label'] ) );
					continue;
				}
				
				$menu_item_ids[$item_slug] = $menu_item_id;
			}
			
			// Make sure the menu has a location-slug and is saved
			if ( strpos( $menu_location, 'nolocation' ) === false && ! is_wp_error( $menu_id ) ) {
				$menu_locations[$menu_location] = $menu_id;
			}
		}
		
		if ( ! empty( $menu_locations ) ) {
			// Assign menus to menu locations
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}
	}
	
	/**
	 * Install: Widgets
	 *
	 * Based on: https://gist.github.com/tyxla/372f51ea1340e5e643f6b47e2ddf43f2
	 */
	public function install_widgets() {
		$widgets = heim_setup_data_get_widgets();
		
		// Remove default widgets/blocks from footer sidebar/location
		$sidebars_widgets = get_option( 'sidebars_widgets', array() );
		if ( isset( $sidebars_widgets['footer-widgets'] ) ) {
			$sidebars_widgets['footer-widgets'] = array();
			update_option( 'sidebars_widgets', $sidebars_widgets );
		}
		
		foreach ( $widgets as $sidebar_id => $widget ) {
			foreach ( $widget as $widget_slug => $widget_data ) {
				// Get sidebars, widgets and their instances
				$sidebars_widgets = get_option( 'sidebars_widgets', array() );
				$widget_instances = get_option( 'widget_block', array() );
				
				// Make sure sidebar exists
				if ( ! isset( $sidebars_widgets[$sidebar_id] ) ) {
					printf( 'Heim setup: Sidebar ID not found: %s. ', intval( $sidebar_id ) );
					continue;
				}
				
				// Does the sidebar have a widget with matching content length? (unable to check for ID or slug)
				$widget_matching = false;
				foreach ( $sidebars_widgets[$sidebar_id] as $index => $sidebar_widget_id ) {
					$sidebar_widget_key = str_replace( 'block-', '', $sidebar_widget_id );
					
					if ( isset( $widget_instances[$sidebar_widget_key] ) ) {
						if ( strlen( $widget_data['content'] ) === strlen( $widget_instances[$sidebar_widget_key]['content'] ) ) {
							$widget_matching = true;
							break;
						}
					}
				}
				
				if ( $widget_matching ) {
					printf( 'Heim setup: Widget added (matching content length): %s. ', esc_html( $widget_slug ) );
					continue;
				}
				
				// Get key for the next widget instance
				$widget_instances_keys = array_filter( array_keys( $widget_instances ), 'is_int' );
				$widget_key            = ( $widget_instances_keys ) ? max( $widget_instances_keys ) + 1 : 2;
				
				// Add widget to sidebar
				$sidebars_widgets[$sidebar_id][] = 'block-' . $widget_key;
				
				// Add new widget instance
				$widget_instances[$widget_key] = array(
					'title'   => '',
					'content' => $widget_data['content'],
				);
				
				// Store updated sidebars, widgets and their instances
				update_option( 'sidebars_widgets', $sidebars_widgets );
				update_option( 'widget_block', $widget_instances );
			}
		}
	}
	
	/**
	 * Install: Configure
	 */
	public function install_configure() {
		// Permalinks
		/*Needed? global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%day%/%postname%/' );
		//$wp_rewrite->set_permalink_structure( '/%postname%/' );
		update_option( 'rewrite_rules', false );
		$wp_rewrite->flush_rules( true );*/
		
		// Delete default post
		$default_post = get_page_by_title( 'Hello world!', OBJECT, 'post' );
		if ( $default_post ) {
			wp_delete_post( $default_post->ID );
		}
		
		// Show page on front option
		update_option( 'show_on_front', 'page' );
		
		// Default front/home-page
		$homepage = get_page_by_title( 'Home', OBJECT, 'page' );
		if ( $homepage ) {
			update_option( 'page_on_front', $homepage->ID );
		}
		
		// Default posts page
		$posts_page = get_page_by_title( 'Blog', OBJECT, 'page' );
		if ( $posts_page ) {
			update_option( 'page_for_posts', $posts_page->ID );
		}
		
		// Posts per page
		update_option( 'posts_per_page', 6 );
		
		// WooCommerce
		// NOTE: Image size settings are configured in "install_attachments()"
		if ( heim_woocommerce_active() ) {
			// Default shop page
			$shop_page_id = wc_get_page_id( 'shop' );
			if ( $shop_page_id ) {
				update_option( 'woocommerce_shop_page_id', $shop_page_id );
			}
			
			// Enable store notice
			update_option( 'woocommerce_demo_store', true );
			
			// Change store notice text
			update_option( 'woocommerce_demo_store_notice', 'Get ready for our sitewide sale starting August 8<sup>th</sup>' );
			
			// Set catalog columns and rows
			update_option( 'woocommerce_catalog_columns', 4 );
			update_option( 'woocommerce_catalog_rows', 4 );
			
			// Enable my-account registration
			update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
			
			// Enable AJAX pagination
			set_theme_mod( 'shop_ajax_pagination', 'ajax-button' );
			
			// Wishlist: Set page
			$wishlist_page = get_page_by_title( 'Wishlist', OBJECT, 'page' );
			if ( $wishlist_page ) {
				set_theme_mod( 'nmww_wishlist_page', $wishlist_page->ID );
			}
		}
	}
	
}

$heim_theme_setup = new Heim_Theme_Setup();

// For testing:
/*global $heim_theme_setup;
$heim_theme_setup = new Heim_Theme_Setup();

add_action( 'admin_init', function() {
	global $heim_theme_setup;
	$heim_theme_setup->install_pages();
});*/
