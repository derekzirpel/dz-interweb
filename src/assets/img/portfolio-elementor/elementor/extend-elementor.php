<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//define( 'ELEMENTOR_PANDO__FILE__', __FILE__ );

/**
 * Load Hello World
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function elpt_load() {
	// Load localization file
	load_plugin_textdomain( 'powerfolio' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		//add_action( 'admin_notices', 'elpt_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'elpt_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'elpt_load' );


function elpt_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . esc_html( 'Powerfolio + Elementor is not working because you are using an old version of Elementor.', 'powerfolio' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'powerfolio' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function get_upgrade_message() {
	$raw ='';	
	$raw .='<div style="border: 1px solid #eee; padding: 10px; background: #eee; border-radius: 6px;">';	
		$raw .='<h3 style="font-weight: bold; tet-transform: uppercase; font-size: 14px; margin-bottom: 10px; text-trasnform: uppercase;">'.__('Enable all features', 'powerfolio').'</h3>';	
		$raw .='<p style="margin-bottom: 10px; font-size: 14px; line-heigh: 22px;">'.__( 'Upgrade your plugin to PRO version to unlock all features!', 'powerfolio' ).'</p>';	
		$raw .='<a href="' . pe_fs()->get_upgrade_url() . '" style="background: #ea0e59; color: #fff; font-weight: bold; padding: 5px 10px; border-radius: 3px; display: inline-block; font-size: 14px; text-transform: uppercase;">'.__( 'Click here to Upgrade', 'powerfolio' ).'</a>';	
		$raw .='<hr style="margin-top: 20px; margin-bottom: 20px;">';
		$raw .='<p style="margin-bottom: 10px; font-size: 14px;">'.__( 'After upgrade, you will get access to the following content:', 'powerfolio' ).'</p>';	
			$raw .='<ul style="list-style-type: circle; list-style-position: outside; font-style: italic;">';
				$raw .='<li style="margin-bottom: 5px;">'.__('- 14 hover effects', 'powerfolio').'</li>';
				$raw .='<li style="margin-bottom: 5px;">'.__('- 8 grid styles', 'powerfolio').'</li>';						
				$raw .='<li style="margin-bottom: 5px;">'.__('- Extra CSS effects', 'powerfolio').'</li>';
				$raw .='<li style="margin-bottom: 5px;">'.__('- Option to display a specific portfolio category', 'powerfolio').'</li>';
				$raw .='<li style="margin-bottom: 5px;">'.__('- Option to display content from any post type to the grid', 'powerfolio').'</li>';
				$raw .='<li style="margin-bottom: 5px;">'.__('- A new widget (portfolio carousel)', 'powerfolio').'</li>';
				$raw .='<li style="margin-bottom: 5px;">'.__('- Extra customization options', 'powerfolio').'</li>';
			$raw .='</ul>';
		
	$raw .='</div>';

	return $raw;
}