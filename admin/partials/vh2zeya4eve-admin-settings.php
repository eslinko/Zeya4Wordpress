<?php
/**
 * Provide a admin setting page for the plugin
 *
 *
 * @link       https://zeya888.com
 * @since      1.0.0
 *
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/admin/partials
 */
?>


<div class="vh2zeya4eve-admin-wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('vh2zeya4eve_settings_group');
        do_settings_sections('vh2zeya4eve-settings');
        submit_button('Save Settings');
        ?>
    </form>
</div>
