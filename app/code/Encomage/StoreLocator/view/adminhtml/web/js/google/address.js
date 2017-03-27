define([
    'jquery'
], function ($) {
    "use strict";

    $.widget('encomage.googleAddressSearch', {
        /**
         *
         * @private
         */
        _create: function () {
            this._init();
            this._events();
        }
    });
    return $.encomage.googleAddressSearch;
});