<?php
/*
	The uninstall file
*/

if( !defined( 'ABSPATH') &&  !defined('WP_UNINSTALL_PLUGIN') )
	    exit();
	
	global $wpdb;
	
	// delete widget option
	delete_option( 'widget_Twitterfontana_Widget');
	// delete plugin feeds (options)
	$wpdb->query( 'DELETE FROM ' . $wpdb->options . ' WHERE option_name LIKE "twitterfontana_%"' );