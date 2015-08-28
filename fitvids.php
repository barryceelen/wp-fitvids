<?php
/**
 * WordPress FitVids
 *
 * @package   Fitvids
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPL-2.0+
 * @link      https://github.com/barryceelen/wp-fitvids
 * @copyright 2014 Barry Ceelen
 *
 * @wordpress-plugin
 * Plugin Name:       Fitvids
 * Plugin URI:        https://github.com/barryceelen/wp-fitvids
 * Description:       Make videos responsive with the Fitvids jquery plugin
 * Version:           1.0.1
 * Author:            Barry Ceelen
 * Author URI:        https://github.com/barryceelen/
 * Text Domain:       fitvids
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/barryceelen/wp-fitvids
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'class-fitvids.php' );
	add_action( 'plugins_loaded', array( 'Fitvids', 'get_instance' ) );
}
