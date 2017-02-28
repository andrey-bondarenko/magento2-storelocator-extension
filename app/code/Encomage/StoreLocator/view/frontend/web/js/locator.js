define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';
    $.widget('encomage.storeLocator', {
        options: {
            selector: '',
            defaultLng: '',
            defaultLat: '',
            defaultZoom: '',
            selectedMarkerZoom: '',
            markers: ''
        },
        map: null,
        _create: function () {
            if (this.options.selector) {
                var _this = this;
                this._event();
                this._mapInit();
                this._markerPlacement();
            }
        },
        _mapInit: function () {
            this.map = new google.maps.Map(document.getElementById(this.options.selector), {
                zoom: parseInt(this.options.defaultZoom),
                center: this._prepareCoordinates(this.options.defaultLat, this.options.defaultLng)
            });
        },
        _markerPlacement: function () {
            var _this = this;
            $.each(this.options.markers, function (i, v) {
                new google.maps.Marker({
                    position: _this._prepareCoordinates(v.latitude, v.longitude),
                    map: _this.map
                });
            });
        },
        _event: function () {
            var _this = this;
            $('.js-show-marker').on('click', function () {
                var marker = _this.options.markers[$(this).data('markerId')];
                _this.map.setZoom(parseInt(_this.options.selectedMarkerZoom));
                _this.map.setCenter(_this._prepareCoordinates(marker.latitude, marker.longitude));
            });
        },
        _prepareCoordinates(lat, lng){
            return new google.maps.LatLng(parseFloat(lat), parseFloat(lng))
        }

    });
    return $.encomage.storeLocator;
});