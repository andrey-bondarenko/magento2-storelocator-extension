define([
    "jquery",
    'jquery/ui'
], function ($) {
    "use strict";

    $.widget('encomage.locatorWidgetDependency', {

        options: {
            selectedProduct: "input[name*='product_id",
            typeSelect: "select[name*='target_type']",
            product: 'product'
        },
        /**
         *
         * @private
         */
        _create: function () {
            this._events();
        },

        
        _events: function () {
            var $this = this;
        }
    });
    return $.encomage.locatorWidgetDependency;
});