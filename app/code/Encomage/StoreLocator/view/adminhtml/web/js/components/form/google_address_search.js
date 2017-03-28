define([
    "jquery",
    "Magento_Ui/js/form/element/abstract",
    "Magento_Ui/js/modal/alert",
    "ko"
], function ($, Abstract, alert, ko) {
    return Abstract.extend({
        defaults: {
            placeholder: 'Start type...',
            placeholderLng: 'Longitude...',
            placeholderLat: 'Latitude...'

        },
        valueLat: ko.observable(''),
        valueLng: ko.observable(''),
        valueSearch: ko.observable(''),
        _defaultZoom: 8,
        _selectedMarkerZoom: 20,
        _dbClickZoom: 12,
        _zoomIterator: 1,
        _map: null,
        _marker: null,
        _autocomplete: null,
        _infoWindow: null,
        _defaultLatLng: {
            lat: '47.795770',
            lng: '35.202652'
        },

        /**
         * Construct
         */
        onElementRender: function () {
            this._infoWindow = new google.maps.InfoWindow();
            this._init();
            this._initFieldsValue();
            this._autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('google-address-search')),
                {types: ['geocode']});
            this._events();

        },

        _initFieldsValue:function () {
            if(this.initialValue){
                var data = this.initialValue.split(':');
                this.valueLat(data[0]);
                this.valueLng(data[1]);
            }
        },

        /**
         *
         * @private
         */
        _events: function () {
            var _this = this;
            this._autocomplete.addListener('place_changed', function () {
                _this._infoWindow.close();
                var place = _this._autocomplete.getPlace();
                if (!place.geometry) {
                    alert({
                        content: "Autocomplete's returned place contains no geometry"
                    });
                }
                if (place.geometry.viewport) {
                    _this._map.fitBounds(place.geometry.viewport);
                } else {
                    _this._map.setCenter(place.geometry.location);
                    _this._map.setZoom(_this._defaultZoom);
                }
                _this._updateMarker(place.geometry.location);
            });
            this._map.addListener('dblclick', function (e) {
                var currentZoom = _this._map.getZoom();
                if (currentZoom < _this._dbClickZoom) {
                    _this._map.setZoom(_this._dbClickZoom);
                }
                _this._updateMarker(e.latLng);
            });
            this._marker.addListener('click', function () {
                _this._map.setZoom(_this.selectedShippingMethod);
                _this._map.setCenter(_this._marker.getPosition());
            });
        },
        /**
         *
         * @param location
         * @private
         */
        _updateMarker: function (location) {
            this._marker.setVisible(false);
            this._marker.setPosition(location);
            this._map.setCenter(location);
            this._marker.setVisible(true);
            this._updateFieldsParams(location.lat(), location.lng());
        },
        /**
         *
         * @private
         */
        _init: function () {
            this._map = new google.maps.Map(document.getElementById('google-address-search-map'), {
                zoom: this._defaultZoom,
                center: new google.maps.LatLng(this._defaultLatLng.lat, this._defaultLatLng.lng)
            });
            this._marker = new google.maps.Marker({
                map: this._map,
                anchorPoint: new google.maps.Point(0, -29)
            });
        },
        /**
         *
         * @param lat
         * @param lng
         * @private
         */
        _updateFieldsParams: function (lat, lng) {
            this.valueLat(lat);
            this.valueLng(lng);
            this.value(lat + ':' + lng)
        }
    })
});