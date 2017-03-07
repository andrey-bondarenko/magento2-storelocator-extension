<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Helper;


use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 * @package Encomage\StoreLocator\Helper
 */
class Config extends AbstractHelper
{
    const GOOGLE_API_KEY_PATH           = 'store_locator/front_options/api_key';
    const GOOGLE_API_VERSION_PATH       = 'store_locator/front_options/api_version';
    const DEFAULT_COORDINATES_LAT_PATH  = 'store_locator/marker_options/default_lat';
    const DEFAULT_COORDINATES_LNG_PATH  = 'store_locator/marker_options/default_lng';
    const DEFAULT_ZOOM_PATH             = 'store_locator/marker_options/zoom_for_default_map';
    const SELECTED_MARKER_ZOOM_PATH     = 'store_locator/marker_options/zoom_for_stores_marker';
}
