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
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Enable plugins to filter our wrapper class
		$this->wrapper_class = apply_filters( 'fitvids_wrapper_class', 'fitvids-wrapper' );

		// Enqueue JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add script to footer
		add_action( 'wp_footer', array( $this, 'init_fitvids' ) );

		// Filter default embed width and height
		add_filter( 'embed_defaults', array( $this, 'filter_embed_defaults' ) );

		// Filter oembed output
		add_filter( 'oembed_dataparse', array( $this, 'filter_oembed_dataparse'), 99, 3 );

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
		wp_enqueue_script( 'fitvids', plugins_url( 'js/jquery.fitvids.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}

	/**
	 * Wrap video oEmbed html in a div so we can target it with FitVids.
	 *
	 * @since    1.0.0
	 */
	public function filter_oembed_dataparse( $output, $data, $url ) {
		if ( 'video' != $data->type ) {
			return $output;
		}
		$output = '<div class="' . $this->wrapper_class . '">' . $output . '</div>';
		return $output;
		/**
		 * @todo ssl-ify stuff at this point or better on the_content?
		 * if ( is_ssl() ) {
		 * $search = array('src="http://www.youtube.com','src="http://youtube.com');
		 * $replace = array('src="https://www.youtube-nocookie.com','src="https://youtube-nocookie.com');
		 * $output = str_replace($search, $replace, $output);
		 * 	}
		 */
	}

	/**
	 * Set default embed width and height to 0 if $GLOBALS['content_width'] is not set.
	 *
	 * This overrides the default width of 500px.
	 *
	 * @since    1.0.0
	 */
	public function filter_embed_defaults( $array ) {

		if ( ! empty( $GLOBALS['content_width'] ) ) {
			$width = (int) $GLOBALS['content_width'];
		}

		if ( empty( $width ) ) {
			$array = array( 'width' => 0, 'height' => 0 );
		}

		return $array;
	}

	/**
	 * Initialize FitVids.
	 *
	 * @since    1.0.0
	 */
	public function init_fitvids() {
		$class = $this->wrapper_class;
		include( 'tmpl-footer-script.php' );
	}

}
