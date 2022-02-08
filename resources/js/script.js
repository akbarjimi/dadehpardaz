(function ($) {
	'use strict';


	jQuery(document).ready(function ($) {

		/*------------ Tooltip ------------*/
		$(function () {
			$('[data-tooltip]').tooltip({
				title: function() {
					return $(this).data('tooltip');
				}
			})
		})

		/*------------ Mobile menu ------------*/
		$('#mobile-menu').mmenu({
			"navbar": {
				"add": true,
			},
			"extensions": [
				"pagedim-black",
				"effect-listitems-drop"
			],
			"offCanvas": {
				"position": "right",
				"zposition": "front"
			}
		});


	});

})(jQuery);