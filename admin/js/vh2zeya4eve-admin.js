jQuery(function($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$('body').on('click', '.vh2zeya4eve-admin-wrap .test-api-key', function(e) {
		e.preventDefault();
		$('body').addClass('vh2zeya4eve-loader')
		const apiKey = $('.vh2zeya4eve-admin-wrap input[name=vh2zeya4eve_api_key]').val()
		if(!apiKey.length) {
			$('.vh2zeya4eve-admin-wrap .test-api-key-result').html('<span style="color: red;">Error!</span>');
			return;
		}
		$.ajax({
			url: wpvariables.ajaxurl,
			type: 'POST',
			data: {
				action: 'vh2zeya4eve_test_api_key',
				nonce: wpvariables.nonce,
				api_key: apiKey
			},
			success: function(data) {
				if (data.status) {
					$('.vh2zeya4eve-admin-wrap .test-api-key-result').html('<span style="color: green;">Success!</span>');
				} else {
					$('.vh2zeya4eve-admin-wrap .test-api-key-result').html('<span style="color: red;">Error!</span>');
				}
			},
			complete: function() {
				$('body').removeClass('vh2zeya4eve-loader')
			}
		})
	})
});
