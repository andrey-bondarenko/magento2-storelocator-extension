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
        $this->_addGoogleMapApiScript();
    }


    /**
     * @return $this|\Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    public function getCollection()
    {
        return $this->_markersCollection;
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
    public function getParams()
    {
        return [
            'selector' => $this->getMapContainerId(),
            'defaultLat' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::XML_PATH_DEFAULT_COORDINATES_LAT_PATH
            ),
            'defaultLng' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::XML_PATH_DEFAULT_COORDINATES_LNG_PATH
            ),
            'defaultZoom' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::XML_PATH_DEFAULT_ZOOM_PATH
            ),
            'selectedMarkerZoom' => $this->_scopeConfig->getValue(
                \Encomage\StoreLocator\Helper\Config::XML_PATH_SELECTED_MARKER_ZOOM_PATH
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
            $storeMarkers[$item->getId()] = $item->getData();
        }
        return $storeMarkers;
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _addGoogleMapApiScript()
    {
        if (!$this->getLayout()->isBlock('google.maps.api')) {
            $this->getLayout()->addBlock(
                'Encomage\StoreLocator\Block\Google\MapApi',
                'google.maps.api',
                'head.additional'
            );
        }
        return $this;
    }
}