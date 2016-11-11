<?php
/**
 * Enqueue JavaScript files.
 *
 * @since    1.0.0
 */
function wp_fitvids_enqueue_scripts() {
	wp_enqueue_script(
		'fitvids',
		plugins_url( 'js/jquery.fitvids.js', dirname( __FILE__ ) ),
		array( 'jquery' ),
		null
	);
}

/**
 * Add an inline script to wp_footer to initialize FitVids.
 *
 * @since    1.0.0
 */
function wp_fitvids_footer_script() {
	$selectors = implode( ', ', apply_filters( 'plugin_fitvids_selectors', array( '.hentry' ) ) );
?>
<script type="text/javascript">
if (window.jQuery) {
	jQuery(document).ready(function() {
		jQuery('<?php echo $selectors; ?>').fitVids();
	});
}
</script>
<?php
}