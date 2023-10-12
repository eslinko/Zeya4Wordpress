<?php

/**
 * Fired during plugin activation
 *
 * @link       https://zeya888.com
 * @since      1.0.0
 *
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/includes
 * @author     Skoryk Dmytro <skorikdeveloper@gmail.com>
 */
class Vh2zeya4eve_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            // Stop activation redirect and show error
            wp_die(__('Sorry, but this plugin requires the Woocommerce to be installed and active. <br> <a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>', VH2ZEYA4EVE_TEXTDOMAIN));
        }
	}

}
