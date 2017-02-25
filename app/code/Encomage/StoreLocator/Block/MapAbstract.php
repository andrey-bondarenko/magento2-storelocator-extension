<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block;

/**
 * Class MapAbstract
 * @package Encomage\StoreLocator\Block
 */
abstract class MapAbstract extends \Magento\Framework\View\Element\Template
{
    const MAP_CONTAINER_ID = 'map';

    /**
     * @var \Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    protected $_markersCollection;

    /**
     * @var \Encomage\StoreLocator\Helper\Config
     */
    protected $_configHelper;

    /**
     * @var \Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    protected $_collection;

    /**
     * MapAbstract constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory
     * @param \Encomage\StoreLocator\Helper\Config $config
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory,
        \Encomage\StoreLocator\Helper\Config $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_configHelper = $config;
        $this->_markersCollection = $markersCollectionFactory->create();
    }

    /**
     * @return $this|\Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    public function getCollection()
    {
        if (!$this->_collection) {
            $this->_collection = $this->_markersCollection->getDataByStore();
        }
        return $this->_collection;
    }

    /**
     * @return string
     */
    public function getMapContainerId()
    {
        return static::MAP_CONTAINER_ID;
    }

    /**
     * @return array
     */
    public function getDefaultParams()
    {
        return [
            'selector' => $this->getMapContainerId(),
            'defLat' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::DEFAULT_COORDINATES_LAT_PATH
            ),
            'defLng' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::DEFAULT_COORDINATES_LNG_PATH
            ),
            'defZoom' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::DEFAULT_ZOOM_PATH
            ),
            'markers' => $this->_getStoreMarkers()
        ];
    }
    

    /**
     * @return array
     */
    protected function _getStoreMarkers()
    {
        $collection = $this->getCollection();
        $storeMarkers = [];
        foreach ($collection as $item) {
            $storeMarkers[] = $item->getData();
        }
        return $storeMarkers;
    }
}