<?php 
/*
Plugin Name: GGA - All Browsers Auto Reload
Plugin URI: http://example.com/
Description: Description
Version: 0.1
Author: Pete Nelson (@GunGeekATX)
Author URI: http://petenelson.com
*/

add_action( 'wp_ajax_gga_all_browsers_auto_reload', 'gga_all_browsers_auto_reload_ajax' );
add_action( 'wp_ajax_nopriv_gga_all_browsers_auto_reload', 'gga_all_browsers_auto_reload_ajax' );

function gga_all_browsers_auto_reload_ajax() {
	$key = '_gga_all_browsers_auto_reload_version';

	$opt = get_option( $key, $default = false );
	if (false == $opt) {
		add_option( $key, time(), '', 'no');
		$opt = get_option( $key, $default = false );
	}

	if (isset($_REQUEST['new']) && $_REQUEST['new'] == '1')
		update_option( $key, time() );
	else
		echo $opt;

	die();
}


add_action( 'wp_enqueue_scripts', 'gga_all_browsers_auto_reload_wp_enqueue_scripts');
function gga_all_browsers_auto_reload_wp_enqueue_scripts() {

	$values = array(
		'admin_ajax' => admin_url( 'admin-ajax.php' ),
		'version' => ''
	);

	wp_enqueue_script( 'gga_all_browsers_auto_reload', plugin_dir_url( __FILE__ ) . 'gga-auto-reload.js', 'jquery', 1.0, $in_footer = true );
	wp_localize_script( 'gga_all_browsers_auto_reload', 'gga_all_browsers_auto_reload', $values );

}
