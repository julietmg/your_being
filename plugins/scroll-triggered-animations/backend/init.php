<?php 
include dirname(__FILE__) . '/page.php';
include dirname(__FILE__) . '/hooks-free.php';

function toast_sta_menu(){ 
	add_menu_page('Scroll Triggered Animations', 'Scroll Triggered Animations', 'manage_options', 'toast_sta_items', 'toast_sta_options_page', 'dashicons-lightbulb');
}
add_action( 'admin_menu', 'toast_sta_menu' );

function toast_sta_backend_scripts($hook){
	if($hook == 'toplevel_page_toast_sta_items') {
		wp_enqueue_style( 'toast_sta_backend_css', plugin_dir_url( __FILE__ ) . 'style.css', array(), 'null', false );
		wp_enqueue_script( 'toast_sta_backend_js', plugin_dir_url( __FILE__ ) . 'scripts.js', array(), 'null', false );
		wp_enqueue_style( 'sta_animations_css', plugin_dir_url( __FILE__ ) . '../frontend/animations.css');
	}
}
add_action('admin_enqueue_scripts', 'toast_sta_backend_scripts');

/*
 * AJAX function which runs when an option is updated
 */
function sta_update_options(){
	$option = sanitize_text_field($_POST['option']);
	$value = sanitize_text_field($_POST['value']);
	
	if($value == 'off' || $value == 'false'){
		$value = 'off';
	}elseif($value == 'checked' || $value == 'true'){
		$value = 'on';
	}
	
	$sta_options = get_option( 'toast_sta_settings' ); 
	$sta_options[$option] = $value;
	update_option('toast_sta_settings', $sta_options);
	die();
}
add_action('wp_ajax_sta_update_options', 'sta_update_options');
add_action('wp_ajax_nopriv_sta_update_options', 'sta_update_options');