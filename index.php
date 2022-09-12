<?php
/**
 * Plugin Name: WP Settings Framework
 * Description: WP Settings framework using gutenberg component and script
 * Plugin URI: #
 * Version: 1.0
 * Requires at least: 5.0
 * Tested up to: 6.0
 * Requires PHP: 7.0
 * Author: rayhanuddin2020
 * Author URI: https://wp-settings.com
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-settings
 * Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'WP_SETTINGS_FR_LITE', TRUE );
define( 'WP_SETTINGS_FR_ROOT', dirname(__FILE__) );

define( 'WP_SETTINGS_FR_URL', plugins_url( '/', __FILE__ ) );
define( 'WP_SETTINGS_FR_ROOT_JS', plugins_url( '/assets/js/', __FILE__ ) );
define( 'WP_SETTINGS_FR_BUILD_JS', plugins_url( '/build/', __FILE__ ) );
define( 'WP_SETTINGS_FR_ROOT_CSS', plugins_url( '/assets/css/', __FILE__ ) );
define( 'WP_SETTINGS_FR_BUILD_CSS', plugins_url( '/build/', __FILE__ ) );
define( 'WP_SETTINGS_FR_ROOT_ICON', plugins_url( '/assets/icons/', __FILE__ ) );
define( 'WP_SETTINGS_FR_ROOT_IMG', plugins_url( '/assets/img/', __FILE__ ) );
define( 'WP_SETTINGS_FR_BUILD_IMG', plugins_url( '/build/img/', __FILE__ ) );

define( 'WP_SETTINGS_FR_DIR_URL', plugin_dir_url( __FILE__ ));
define( 'WP_SETTINGS_FR_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_SETTINGS_FR_BASE', plugin_basename( WP_SETTINGS_FR_ROOT ) );
define( 'WP_SETTINGS_FR_PLUGIN_BASE', plugin_basename(__FILE__) );

do_action( 'wp_settings_fr_loaded' );

/**
 * Register a custom menu page.
 */
function wp_seetings_register_fr_custom_menu_page() {
	add_menu_page(
		__( 'WP Settings', 'wp-settings' ),
		'WP Settings',
		'manage_options',
		__DIR__.'/myplugin-admin.php',
		'',
		'',
		6
	);
}

add_action( 'admin_menu', 'wp_seetings_register_fr_custom_menu_page' );

function wp_seetings_selectively_enqueue_admin_script( $hook ) {
	//$screen = get_current_screen();
    if ( 'wp-options-components/myplugin-admin.php' != $hook ) {
       return;
    }

    if(!file_exists(WP_SETTINGS_FR_DIR_PATH . 'build/framework/options/settings.asset.php')){
       return;
	}

    $assets = include_once( WP_SETTINGS_FR_DIR_PATH . 'build/framework/options/settings.asset.php' );
	
    wp_enqueue_script( 'wp-settings-script', WP_SETTINGS_FR_BUILD_JS . 'framework/options/settings.js', $assets['dependencies'], $assets['version'], true );
   
	foreach($assets['dependencies'] as $style){
		wp_enqueue_style($style);
	}
}

add_action( 'admin_enqueue_scripts', 'wp_seetings_selectively_enqueue_admin_script' );

//Blocks

function qs_register_block_first() {

    if ( ! function_exists( 'register_block_type' ) ) {
        // Block editor is not available.
        return;
    }

	if(!file_exists(WP_SETTINGS_FR_DIR_PATH . 'build/blocks')){
       return;
	}
	$blocks = moption_ready_get_dir_list('blocks');
	if(is_array($blocks)){
		foreach($blocks as $item){
			register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/'.$item );
		}
	}
    
	// register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-1' );
	// register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-2' );
	// //register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-3' );
}

// Hook: Editor assets.
add_action( 'init', 'qs_register_block_first' );

function moption_ready_get_dir_list($path = 'blocks'){

	$widgets_modules = [];
	$dir_path        = WP_SETTINGS_FR_DIR_PATH."build/".$path;
	$dir             = new \DirectoryIterator($dir_path);
	 
	 foreach ($dir as $fileinfo) {
		 if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			 $widgets_modules[$fileinfo->getFilename()] = $fileinfo->getFilename();
			
		 }
	 }

	 return $widgets_modules;
}
