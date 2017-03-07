<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\Config\Source;

/**
 * Class Markers
 * @package Encomage\StoreLocator\Model\Config\Source
 */
class Markers implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @var \Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    protected $_markersCollection;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var array
     */
    protected $_options = [];

    /**
     * @var array
     */
    protected $_markersByStore = [];


    /**
     * Markers constructor.
     * @param \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory
     */
    public function __construct(
        \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_markersCollection = $markersCollectionFactory->create();
        $this->_systemStore = $systemStore;
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $widget = $this->_getCurrentWidget();
            $stores = $widget ? $widget->getStoreIds() : $this->_systemStore->getStoreCollection();
            foreach ($stores as $store) {
                if (!$store instanceof \Magento\Store\Model\Store) {
                    $store = $this->_systemStore->getStoreData($store);
                }
                $marker = $this->_getMarkersByStore($store->getId());
                if ($marker) {
                    $this->_options[] = [
                        'label' => __($store->getName()),
                        'value' => $marker
                    ];
                }
            }
        }
        return $this->_options;
    }

    /**
     * @param null $markerId
     * @return null
     */
    protected function _getMarkersByStore($markerId = null)
    {
        if (!$this->_markersByStore) {
            foreach ($this->_markersCollection as $marker) {
                $markerStores = $marker->getStoreIds();
                foreach ($markerStores as $store) {
                    $this->_markersByStore[$store][] = [
                        'label' => __($marker->getName()),
                        'value' => $marker->getId()
                    ];
                }
            }
        }
        if ($markerId) {
            return isset($this->_markersByStore[$markerId]) ? $this->_markersByStore[$markerId] : null;
        }
        return $this->_markersByStore;
    }

    /**
     * @return null | \Magento\Widget\Model\Widget\Instance
     */
    protected function _getCurrentWidget()
    {
        return $this->_coreRegistry->registry('current_widget_instance');
    }
}
