<?php
/**
 * WordPress FitVids.
 *
 * @package   Fitvids
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPL-2.0+
 * @link      https://github.com/barryceelen/wp-fitvids
 * @copyright 2014 Barry Ceelen
 */

/**
 * Plugin class.
 *
 * @package Fitvids
 * @author  Barry Ceelen <b@rryceelen.com>
 */
class Fitvids {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * CSS selectors used to show FitVids where to do its magic.
	 *
	 * @since    1.0.2
	 *
	 * @var      array
	 */
	private $selectors = array();

	/**
	 * Initialize the plugin.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		$this->selectors = apply_filters( 'plugin_fitvids_selectors', array( '.hentry' ) );

		// Enqueue JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add script to footer
		add_action( 'wp_footer', array( $this, 'footer_script' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Registers and enqueues JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'fitvids',
			plugins_url( 'js/jquery.fitvids.js', __FILE__ ),
			array( 'jquery' ),
			null
		);
	}

	/**
	 * Add an inline script to wp_footer to initialize FitVids.
	 *
	 * @since    1.0.0
	 */
	public function footer_script() {
		$selectors = implode( ', ', $this->selectors );
		include( 'tmpl-footer-script.php' );
	}
}
