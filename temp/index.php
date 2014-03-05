<?php
	if (($_SERVER['REMOTE_ADDR'] == "38.98.105.2") || ($_SERVER['REMOTE_ADDR'] == "74.68.158.12")) {
			/**
		 * Front to the WordPress application. This file doesn't do anything, but loads
		 * wp-blog-header.php which does and tells WordPress to load the theme.
		 *
		 * @package WordPress
		 */

		/**
		 * Tells WordPress to load the WordPress theme and output it.
		 *
		 * @var bool
		 */
		define('WP_USE_THEMES', true);

		/** Loads the WordPress Environment and Template */
		require( dirname( __FILE__ ) . '/wp-blog-header.php' );

	} else {

		include('index1.php');
	}