define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';
    $.widget('encomage.storeLocator', {
        options: {
            selector: '',
            defLng: '',
            defLat: '',
            defZoom: '',
            markers: ''
        },
        map: null,
        bounds: null,
        _create: function () {
            if (this.options.selector) {
                var map = new google.maps.Map(document.getElementById(this.options.selector), {
                    zoom: parseInt(this.options.defZoom),
                    center: {
                        lat: parseFloat(this.options.defLat),
                        lng: parseFloat(this.options.defLng)
                    }
                });
                for (var i = 0; i < this.options.markers.length; i++) {
                    new google.maps.Marker({
                        position: {
                            lat: parseFloat(this.options.markers[i].latitude),
                            lng: parseFloat(this.options.markers[i].longitude)
                        },
                        map: map
                    });
                }
            }
        }
    });
    return $.encomage.storeLocator;
});