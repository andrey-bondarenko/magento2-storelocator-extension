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
        _map: null,
        _placedMarkers: [],
        _create: function () {
            if (this.options.selector) {
                this._event();
                this._mapInit();
                this._markerPlacement();
            }
        },
        _mapInit: function () {
            this._map = new google.maps.Map(document.getElementById(this.options.selector), {
                zoom: parseInt(this.options.defaultZoom),
                center: this._prepareCoordinates(this.options.defaultLat, this.options.defaultLng)
            });
        },
        _markerPlacement: function () {
            var _this = this;
            $.each(this.options.markers, function (i, v) {
                _this._placedMarkers[i] = new google.maps.Marker({
                    position: _this._prepareCoordinates(v.latitude, v.longitude),
                    map: _this._map
                });
                if (v.comment) {
                    _this._placedMarkers[i].info = new google.maps.InfoWindow({
                        content: v.comment
                    })
                }
                google.maps.event.addListener(_this._placedMarkers[i], 'click', function () {
                    _this._placedMarkers[i].info.open(_this._map, _this._placedMarkers[i]);
                });
            });
        },
        _event: function () {
            var _this = this;
            $('.js-show-marker').on('click', function () {
                var marker = _this.options.markers[$(this).data('markerId')];
                _this._map.setZoom(parseInt(_this.options.selectedMarkerZoom));
                _this._map.setCenter(_this._prepareCoordinates(marker.latitude, marker.longitude));
            });
        },
        _prepareCoordinates: function (lat, lng) {
            return new google.maps.LatLng(parseFloat(lat), parseFloat(lng))
        }

    });
    return $.encomage.storeLocator;
});