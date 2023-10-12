<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://zeya888.com
 * @since      1.0.0
 *
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/admin
 * @author     Skoryk Dmytro <skorikdeveloper@gmail.com>
 */
class Vh2zeya4eve_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vh2zeya4eve_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vh2zeya4eve_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vh2zeya4eve-admin.css', array(), rand(0, 9999), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vh2zeya4eve_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vh2zeya4eve_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vh2zeya4eve-admin.js', array( 'jquery' ), rand(0, 9999), false );
        wp_localize_script( $this->plugin_name, 'wpvariables', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'vh2zeya4eve_nonce' ),
        ));
	}

    // create settings page
    public function vh2zeya4eve_settings_page() {
        add_menu_page(
            'Vh2zeya4eve Settings',
            'Vh2zeya4eve Settings',
            'manage_options',
            'vh2zeya4eve-settings',
            array($this, 'vh2zeya4eve_settings_page_html'),
            'dashicons-admin-generic',
            50
        );
    }

    public function vh2zeya4eve_settings_page_html() {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // connected file with template of settings page
        require_once plugin_dir_path(__FILE__) . 'partials/vh2zeya4eve-admin-settings.php';
    }

    public function vh2zeya4eve_register_settings() {
        register_setting('vh2zeya4eve_settings_group', 'vh2zeya4eve_api_key');
        register_setting('vh2zeya4eve_settings_group', 'vh2zeya4eve_product_ids');

        add_settings_section(
            'vh2zeya4eve_api_settings',
            '',
            null,
            'vh2zeya4eve-settings'
        );

        add_settings_field(
            'vh2zeya4eve_api_key',
            'API Key',
            [$this, 'vh2zeya4eve_display_api_key_field'],
            'vh2zeya4eve-settings',
            'vh2zeya4eve_api_settings'
        );

        add_settings_field(
            'vh2zeya4eve_product_ids',
            'Product IDs (comma separated)',
            [$this, 'vh2zeya4eve_display_product_ids_field'],
            'vh2zeya4eve-settings',
            'vh2zeya4eve_api_settings'
        );
    }

    public function vh2zeya4eve_display_api_key_field() {
        $api_key = get_option('vh2zeya4eve_api_key');
        echo "<input type='text' name='vh2zeya4eve_api_key' value='{$api_key}' required/>";
        echo "<button class='test-api-key button button-primary'>".__('Test Key', VH2ZEYA4EVE_TEXTDOMAIN)."</button>";
        echo '<div class="test-api-key-result"></div>';
    }

    public function vh2zeya4eve_display_product_ids_field() {
        $product_ids = get_option('vh2zeya4eve_product_ids');
        echo "<input type='text' name='vh2zeya4eve_product_ids' value='{$product_ids}' />";
    }

    // test api key callback
    public function vh2zeya4eve_test_api_key() {
        $api_key = $_POST['api_key'];

        // check nonce
        $nonce = $_POST['nonce'];
        if (!wp_verify_nonce($nonce, 'vh2zeya4eve_nonce')) {
            die('Security check');
        }

        $api = new Vh2zeya4eve_Api();

        wp_send_json(['status' => $api->checkApiKey($api_key)]);
    }
}