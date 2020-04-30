jQuery(document).ready(function (event) {
	"use strict";

	jQuery('.ekit-mailChimpForm').on('submit', function (e) {
		e.preventDefault();
		let mailForm = jQuery(this).serialize(),
			listed = jQuery(this).attr('data-listed'),
			message = jQuery(this).attr('data-success-message'),
			messageBox = jQuery(this).children('.ekit-mail-message');

		jQuery.ajax({
			data: mailForm,
			type: 'get',
			url: ekit_site_url.siteurl + '/wp-json/elementskit/v1/widget/mailchimp/sendmail/?listed=' + listed,
			success: function (response) {
				messageBox.show();
				if (response.error.length > 0) {
					messageBox.removeClass('error').html('Found error : ' + response.error).addClass('error');
					return;
				}
				var obj = JSON.parse(response.success.body);
				if (obj.status == 'subscribed') {
					messageBox.removeClass('success').html(message).addClass('success');
					return;
				}
				messageBox.html(obj.title);
			}
		});
	});

});