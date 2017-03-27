define([
    "jquery",
    "Magento_Ui/js/form/element/abstract",
    "Magento_Ui/js/modal/alert"
], function ($, Abstract, alert) {
    return Abstract.extend({
        defaults: {
            placeholder: 'Start type...'
        },
        _defaultZoom: 8,
        _selectedMarkerZoom: 20,
        _dbClickZoom: 12,
        _zoomIterator: 1,
        _map: null,
        _marker: null,
        _autocomplete: null,
        _infoWindow: null,
        _fields: {
            lat: null,
            lng: null
        },

        /**
         * Construct
         */
        onElementRender: function () {
            var _this = this;
            this._infoWindow = new google.maps.InfoWindow();
            this._init();
            this._autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('google-address-search')),
                {types: ['geocode']});
            this._events();

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
            this._map.addListener('dblclick', function(e) {
                var currentZoom = _this._map.getZoom();
                if(currentZoom < _this._dbClickZoom){
                    _this._map.setZoom(_this._dbClickZoom);
                }
                _this._updateMarker(e.latLng);
            });
            this._marker.addListener('click', function() {
                _this._map.setZoom(_this.selectedShippingMethod);
                _this._map.setCenter(_this._marker.getPosition());
            });
        },
        /**
         *
         * @param location
         * @private
         */
        _updateMarker: function(location){
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
                center: new google.maps.LatLng('47.795770', '35.202652')
            });
            this._marker = new google.maps.Marker({
                map: this._map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            var lat, lng;
            lat = $("input[name='latitude']");
            lng = $("input[name='longitude']");
            if (lat.length && lng.length) {
                this._fields.lat = lat;
                this._fields.lng = lng;
            }
        },
        /**
         *
         * @param lat
         * @param lng
         * @private
         */
        _updateFieldsParams: function (lat, lng) {
            if (this._fields.lat && this._fields.lng) {
                $(this._fields.lat).val(lat);
                $(this._fields.lng).val(lng);
            }
        }
    })
});