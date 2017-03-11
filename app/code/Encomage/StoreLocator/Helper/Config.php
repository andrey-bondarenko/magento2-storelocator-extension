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
    const XML_PATH_GOOGLE_API_KEY_PATH           = 'store_locator/front_options/api_key';
    const XML_PATH_GOOGLE_API_VERSION_PATH       = 'store_locator/front_options/api_version';
    const XML_PATH_IS_ENABLED_FRONTEND_PAGE      = 'store_locator/front_options/is_active';
    const XML_PATH_DEFAULT_COORDINATES_LAT_PATH  = 'store_locator/marker_options/default_lat';
    const XML_PATH_DEFAULT_COORDINATES_LNG_PATH  = 'store_locator/marker_options/default_lng';
    const XML_PATH_DEFAULT_ZOOM_PATH             = 'store_locator/marker_options/zoom_for_default_map';
    const XML_PATH_SELECTED_MARKER_ZOOM_PATH     = 'store_locator/marker_options/zoom_for_stores_marker';

    /**
     * @return bool
     */
    public function isEnabledFrontendPage()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_IS_ENABLED_FRONTEND_PAGE);
    }
}
