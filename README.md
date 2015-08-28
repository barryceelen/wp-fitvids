WordPress FitVids
=================

A simple implementation of the wonderful [Fitvids.js](http://fitvidsjs.com) jQuery plugin to make videos embedded in posts responsive.

Currently targets videos contained inside an element with the `.hfeed` class.
You can add and remove target classes by adding a filter to `plugin_fitvids_selectors`.

```
add_filter( 'plugin_fitvids_selectors', 'prefix_my_cool_filter_function' );

function prefix_my_cool_filter_function( $targets ) {
	$targets[] = '.yay-an-element-containing-videos';
	return $targets;
}
```
