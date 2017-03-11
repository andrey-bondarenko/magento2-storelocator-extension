<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block\Widget;

use Encomage\StoreLocator\Block\MapAbstract;
use Magento\Widget\Block\BlockInterface;

/**
 * Class StoreLocator
 * @package Encomage\StoreLocator\Block\Widget
 */
class StoreLocator extends MapAbstract implements BlockInterface
{
    const MAP_CONTAINER_ID = 'map-widget';

    /**
     * @var \Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    protected $_collection;

    /**
     * Class construct
     */
    protected function _construct()
    {
        parent::_construct();
        if (!$this->_isPlacedMainLocatorBlock()) {
            $this->setTemplate('widget/store-locator.phtml');
        }
    }

    /**
     * @return $this|\Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    public function getCollection()
    {
        if (!$this->_collection) {
            $this->_collection = $this->_markersCollection
                ->addFieldToFilter('entity_id', ['in' => $this->getData('markers')]);
        }
        return $this->_collection;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $params = parent::getParams();
        if ($this->hasData('center_marker')) {
            $params['centerMarkerId'] = (int)$this->getCenterMarker();
        }
        return $params;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->hasData('widget_frontend_label')
            ? $this->getWidgetFrontendLabel()
            : null;
    }

    /**
     * @return bool
     */
    public function isShowMarkersList()
    {
        return (bool)$this->getIsShowMarkersList();
    }
    
    /**
     * @return string
     */
    public function getMapBlockAttributes()
    {
        $attributes = [
            'id' => $this->getMapContainerId(),
            'style' => $this->_getStyles()
        ];
        $stringAttributes = '';
        foreach ($attributes as $attributeName => $attributeData) {
            if ($attributeData) {
                $stringAttributes .= $attributeName . '="' . $attributeData . '" ';
            }
        }
        return $stringAttributes;
    }

    /**
     * @return string
     */
    protected function _getStyles()
    {
        $styles = '';
        if ($this->hasData('widget_width')) {
            $styles .= 'width:' . $this->escapeHtml($this->getWidgetWidth()) . '; ';
        }
        if ($this->hasData('widget_height')) {
            $styles .= 'height:' . $this->escapeHtml($this->getWidgetHeight()) . '; ';
        }
        return $styles;
    }
    
    /**
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _isPlacedMainLocatorBlock()
    {
        return $this->getLayout()->isBlock('store.locator.page');
    }
}
