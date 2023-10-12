<?php
// Email sending are set on sending only completed orders
function log_order_completion($order_id) {
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();

    // Get the absolute path to your plugin folder
    $plugin_dir = plugin_dir_path(__FILE__);

    // Define the log file location within your plugin folder
    $log_file = $plugin_dir . 'logfile.log';

    // Define the log message
    $log_message = "Order Completed - Order ID: {$order_id}, Customer Name: {$order_data['billing']['first_name']} {$order_data['billing']['last_name']}\n";

    // Use the absolute path for error_log
    error_log($log_message, 3, $log_file);
}

// https://www.businessbloomer.com/woocommerce-add-extra-content-order-email/

/*

if ( $email->id == 'cancelled_order' ) {}
if ( $email->id == 'customer_completed_order' ) {}
if ( $email->id == 'customer_invoice' ) {}
if ( $email->id == 'customer_new_account' ) {}
if ( $email->id == 'customer_note' ) {}
if ( $email->id == 'customer_on_hold_order' ) {}
if ( $email->id == 'customer_refunded_order' ) {}
if ( $email->id == 'customer_reset_password' ) {}
if ( $email->id == 'failed_order' ) {}
if ( $email->id == 'new_order' ) {}

*/

// custom text with order id
function send_specific_content_email( $order, $sent_to_admin, $plain_text, $email ) {
  
  $allowed_product_ids = [4476, 10950]; // Define the allowed product IDs.
  // Get the order items.
  $order_items = $order->get_items();

  // Check if any item in the order matches the allowed product IDs.
  $has_allowed_product = false;
  foreach ( $order_items as $item ) {
    $product_id = $item->get_product_id();
    if ( in_array( $product_id, $allowed_product_ids ) ) {
      $has_allowed_product = true;
      break; // Exit the loop if a match is found.
    }
  }
  
  if ( $email->id == 'customer_completed_order' && $has_allowed_product ) {
    echo "<h2>Specific content when order ID matches</h2> Here's the content you added.";
  }
}

add_action( 'woocommerce_email_before_order_table', 'send_specific_content_email', 20, 4 );