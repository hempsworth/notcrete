<?php
/**
 * Heim theme plugin installer
 *
 * Based on: https://gist.github.com/hansschuijff/a6c4edb4e5162c1c16006d21fa8b9c8f
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-includes/pluggable.php');
require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/misc.php' );
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

/**
 * Class: Overwrite feedback method in Plugin_Upgrader_Skin to suppress normal feedback
 */
class Heim_Upgrader_Skin extends Plugin_Upgrader_Skin {
	public function feedback( $string, ...$args ) {
	}
	
	public function header() {
	}
 
	public function footer() {
	}

	public function set_result( $result ) {
		$this->result = false;
	}
}


/* Note: Don't add add another class in this file, causes error in theme linter check */

/**
 * Activates a given plugin
 * 
 * If needed it dowloads and/or installs the plugin first
 *
 * @param string $slug The plugin's basename (containing the plugin's base directory and the bootstrap filename)
 * @return void
 */
function heim_plugin_installer_activate_plugin( $plugin ) {
	$plugin_mainfile = trailingslashit( WP_PLUGIN_DIR ) . $plugin;
	/* Nothing to do, when plugin already active
	 * 
	 * WARNING: When a plugin has been removed by ftp, 
	 *          WordPress will still consider it active, 
	 *          untill the plugin list has been visited 
	 *          (and it checks the existence of it)
	 */
	if ( is_plugin_active( $plugin ) ) {
		// Make sure the plugin is still there (files could be removed without wordpress noticing)
		$error = validate_plugin( $plugin );
		if ( ! is_wp_error( $error ) ) {
			wp_send_json_success( esc_html_x( 'Installed and activated', 'Theme setup', 'heim' ) );
		}
	}

	// Install, if neccessary
	if ( ! heim_plugin_installer_is_plugin_installed( $plugin ) ) {
		$error = heim_plugin_installer_install_plugin( $plugin );
		if ( ! empty( $error ) ) {
			wp_send_json_error( $error );
		}
	}
	// Now we activate, when install has been successfull
	if ( ! heim_plugin_installer_is_plugin_installed( $plugin ) ) {
		wp_send_json_error( 'Error: Plugin could not be installed.' );
	}

	$error = validate_plugin( $plugin );
	if ( is_wp_error( $error ) ) {
		$error_message = 'Error: Plugin main file not found. ' . var_export( $error->get_error_code(), true ) . ': ' . var_export( $error->get_error_message(), true ) . '.';
		wp_send_json_error( $error_message );
	}

	$error = activate_plugin( $plugin_mainfile );
	if ( is_wp_error( $error ) ) {
		$error_message = 'Error: Plugin not activated. ' . var_export( $error->get_error_code(), true ) . ': ' . var_export( $error->get_error_message(), true ) . '.';
		wp_send_json_error( $error_message );
	}

	wp_send_json_success( esc_html_x( 'Installed and activated', 'Theme setup', 'heim' ) );
}

/**
 * Is plugin installed?
 * 
 * Get_plugins() returns an array containing all installed plugins
 * with the plugin basename as key
 * 
 * When you pass the plugin dir to get_plugins(),
 * it will return an empty array if that plugin is not yet installed,
 * 
 * When the plugin is installed it will return an array with that plugins data, 
 * using the plugins main filename as key (so not the basename).
 * 
 * @param  string  $plugin Plugin basename.
 * @return boolean         True when installed, otherwise false.
 */
function heim_plugin_installer_is_plugin_installed( $plugin ) {
	$plugins = get_plugins( '/' . heim_plugin_installer_get_plugin_dir( $plugin ) );
	if ( ! empty( $plugins ) ) {
		return true;
	}
	return false;
}

/**
 * Extraxts the plugins directory (=slug for api) from the plugin basename.
 *
 * @param string $plugin Plugin basename.
 * @return string        The directory-part of the plugin basename.
 */
function heim_plugin_installer_get_plugin_dir( $plugin ) {
	$chunks = explode( '/', $plugin );
	if ( ! is_array( $chunks ) ) {
		$plugin_dir = $chunks;
	} else {
		$plugin_dir = $chunks[0];
	}
	return $plugin_dir;
}

/**
 * Intall a given plugin.
 *
 * @param  string      $plugin Plugin basename.
 * @return null|string         Null when install was succesfull, otherwise error message.
 */
function heim_plugin_installer_install_plugin( $plugin ) {
	$api = plugins_api(
		'plugin_information',
		array(
			'slug'   => heim_plugin_installer_get_plugin_dir( $plugin ),
			'fields' => array(
				'short_description' => false,
				'requires'          => false,
				'sections'          => false,
				'rating'            => false,
				'ratings'           => false,
				'downloaded'        => false,
				'last_updated'      => false,
				'added'             => false,
				'tags'              => false,
				'compatibility'     => false,
				'homepage'          => false,
				'donate_link'       => false,
			),
		)
	);

	$skin      = new Heim_Upgrader_Skin( array( 'api' => $api ) );
	$upgrader  = new Plugin_Upgrader( $skin );
	$error     = $upgrader->install( $api->download_link );

	/* 
	 * Check for errors...
	 * $upgrader->install() returns NULL on success, 
	 * otherwise a WP_Error object.
	 */
	if ( is_wp_error( $error ) ) {
		$error_message = 'Error: Install process failed. ' . var_export( $error->get_error_code(), true ) . ': ' . var_export( $error->get_error_message(), true ) . '.';
		wp_send_json_error( $error_message );
	}
}

/**
 * NM: Get plugins
 */
function heim_plugin_installer_get_plugins() {
	$plugins = array(
		'woocommerce' => array(
			'title'             => 'WooCommerce',
			'file'              => 'woocommerce/woocommerce.php',
			'status'            => 'not_installed',
			'status_message'    => _x( 'Not installed', 'Theme setup', 'heim' ),
		),
		/*'contact-form-7' => array(
			'title'             => 'Contact Form 7',
			'file'              => 'contact-form-7/wp-contact-form-7.php',
			'status'            => 'not_installed',
			'status_message'    => _x( 'Not installed', 'Theme setup', 'heim' ),
		),*/
	);

	// Set plugin status
	foreach ( $plugins as $plugin_slug => $plugin ) {
		if ( heim_plugin_installer_is_plugin_installed( $plugin['file'] ) ) {
			$plugins[$plugin_slug]['status'] = 'installed';
			$plugins[$plugin_slug]['status_message'] = _x( 'Installed', 'Theme setup', 'heim' );
		}

		if ( is_plugin_active( $plugin['file'] ) ) {
			// Make sure the plugin is still there (files could be removed without WP noticing)
			$error = validate_plugin( $plugin['file'] );
			if ( ! is_wp_error( $error ) ) {
				$plugins[$plugin_slug]['status'] = 'activated';
				$plugins[$plugin_slug]['status_message'] = _x( 'Installed and activated', 'Theme setup', 'heim' );
			}
		}
	}

	return $plugins;
}
