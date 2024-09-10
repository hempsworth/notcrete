(function($) {
	'use strict';
	
    $(function() {
        // Block editor: Enable "color mode" by adding data attribute to <body> tag
        var $body = $('body');
        if ($body.hasClass('block-editor-page') && heim_data_admin) {
            $body.attr('data-color-mode', heim_data_admin.color_mode);
        }
    });
})(jQuery);