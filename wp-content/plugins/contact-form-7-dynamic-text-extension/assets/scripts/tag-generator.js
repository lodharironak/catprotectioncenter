(function($) {
    'use strict';
    if (typeof wpcf7 === 'undefined' || wpcf7 === null) {
        return;
    }
    window.wpcf7dtx = window.wpcf7dtx || {};
    wpcf7dtx.taggen = {};

    wpcf7dtx.taggen.escapeRegExp = function(str) {
        return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
    };

    wpcf7dtx.taggen.replaceAll = function(input, f, r, no_escape) {
        if (input !== undefined && input !== null && typeof(input) == 'string' && input.trim() !== '' && input.indexOf(f) > -1) {
            var rexp = new RegExp(wpcf7dtx.taggen.escapeRegExp(f), 'g');
            if (no_escape) { rexp = new RegExp(f, 'g'); }
            return input.replace(rexp, r);
        }
        return input;
    };

    wpcf7dtx.taggen.updateOption = function(e) {
        var $this = $(e.currentTarget),
            value = encodeURIComponent(wpcf7dtx.taggen.replaceAll($this.val(), "'", '&#39;'));
        $this.siblings('input[type="hidden"].option').val(value);
    };

    $(function() {
        $('form.tag-generator-panel .dtx-option').on('change keyup click', wpcf7dtx.taggen.updateOption);
        $('.contact-form-editor-panel #tag-generator-list a.thickbox.button[href*="inlineId=tag-generator-panel-dynamic_"]').each(function() {
            var $btn = $(this),
                name = $btn.text();
            $btn.addClass('dtx-form-tag');
            if (name == 'dynamic drop-down menu' || name == 'dynamic checkboxes' || name == 'dynamic radio buttons') {
                $btn.attr('href', $btn.attr('href').replace('height=500', 'height=750'));
            }
        });
    });
})(jQuery);