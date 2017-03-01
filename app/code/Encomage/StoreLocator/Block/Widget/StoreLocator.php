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
        //TODO:: Need find better solution
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
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _isPlacedMainLocatorBlock()
    {
        return $this->getLayout()->isBlock('store.locator.page');
    }
}
