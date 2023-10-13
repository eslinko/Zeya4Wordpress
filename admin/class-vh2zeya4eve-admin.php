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
	public function enqueue_styles() : void
    {

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
	public function enqueue_scripts() : void
    {

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
    public function vh2zeya4eve_settings_page() : void
    {
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

    public function vh2zeya4eve_settings_page_html() : void
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // connected file with template of settings page
        require_once plugin_dir_path(__FILE__) . 'partials/vh2zeya4eve-admin-settings.php';
    }

    public function vh2zeya4eve_register_settings() : void
    {
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

    public function vh2zeya4eve_display_api_key_field() : void
    {
        $api_key = get_option('vh2zeya4eve_api_key');
        echo "<input type='text' name='vh2zeya4eve_api_key' value='{$api_key}' required/>";
        echo "<button class='test-api-key button button-primary'>".__('Test Key', VH2ZEYA4EVE_TEXTDOMAIN)."</button>";
        echo '<div class="test-api-key-result"></div>';
    }

    public function vh2zeya4eve_display_product_ids_field() : void
    {
        $product_ids = get_option('vh2zeya4eve_product_ids');
        echo "<input type='text' name='vh2zeya4eve_product_ids' value='{$product_ids}' />";
    }

    // test api key callback
    public function vh2zeya4eve_test_api_key() : void
    {
        $api_key = $_POST['api_key'];

        // check nonce
        $nonce = $_POST['nonce'];
        if (!wp_verify_nonce($nonce, 'vh2zeya4eve_nonce')) {
            die('Security check');
        }

        $api = new Vh2zeya4eve_Api();

        wp_send_json(['status' => $api->checkApiKey($api_key)]);
    }

    public function vh2zeya4eve_display_custom_order_meta($order) : void
    {
        echo '<p class="form-field form-field-wide"><strong>'.__('Emitted Lovestars:', VH2ZEYA4EVE_TEXTDOMAIN).'</strong> ' . get_post_meta($order->get_id(), 'vh2zeya4eve_emittedLovestars', true) . '</p>';
        echo '<p class="form-field form-field-wide"><strong>'.__('Invitation Code:', VH2ZEYA4EVE_TEXTDOMAIN).'</strong> ' . get_post_meta($order->get_id(), 'vh2zeya4eve_invitationCode', true) . '</p>';
    }

    public function vh2zeya4eve_order_completed($order_id, $order) : bool
    {
        if (!$order) {
            return false;
        }

        $items = $order->get_items();
        $product_ids = explode(',', get_option('vh2zeya4eve_product_ids'));
        $total_sum = 0;

        foreach ($items as $item) {
            $product_id = $item->get_product_id();
            if (in_array($product_id, $product_ids)) {
                $total_sum += $item->get_total();
            }
        }

        if($total_sum < 1) {
            return false;
        }

        $api = new Vh2zeya4eve_API();
        $response = $api->createRuleAction($total_sum);

        if ($response->status === 'error') {
            return $response->message;
        }

        if (!empty($response->ruleActionId) && !empty($response->emittedLovestars) && !empty($response->invitationCode)) {
            // Сохраните полученные данные в мета-поля заказа
            update_post_meta($order_id, 'vh2zeya4eve_ruleActionId', sanitize_text_field($response->ruleActionId));
            update_post_meta($order_id, 'vh2zeya4eve_emittedLovestars', sanitize_text_field($response->emittedLovestars));
            update_post_meta($order_id, 'vh2zeya4eve_invitationCode', sanitize_text_field($response->invitationCode));

            $billing_email = $order->get_billing_email();

            return VH2Zeya4eve_Emails::sendMail($billing_email, 'Your Zeya Invitation Code', 'your code 1111');
        } else {
            return false;
        }
    }
}
