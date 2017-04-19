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
     * @var \Encomage\StoreLocator\Model\Marker
     */
    protected $_firstCollectionMarker;

    /**
     * @var \Encomage\StoreLocator\Helper\Config
     */
    protected $_configHelper;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $_assetRepository;

    /**
     * @var \Magento\Framework\View\Asset\GroupedCollection
     */
    protected $_assetCollection;

    /**
     * @var string
     */
    protected $_cssIdentifier = 'Encomage_StoreLocator::css/storelocator.css';

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
        \Magento\Framework\View\Asset\Repository $assetRepository,
        \Magento\Framework\View\Asset\GroupedCollection $assetCollection,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_configHelper = $config;
        $this->_markersCollection = $markersCollectionFactory->create();
        $this->_assetRepository = $assetRepository;
        $this->_assetCollection = $assetCollection;
        $this->_addGoogleMapApiScript()
            ->_addStyleAsset();
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
    public function getJsParams()
    {
        return [
            'selector' => $this->getMapContainerId(),
            'defaultLat' => (float)$this->_getFirstCollectionMarker()->getLatitude(),
            'defaultLng' => (float)$this->_getFirstCollectionMarker()->getLongitude(),
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
     * @return \Encomage\StoreLocator\Model\Marker
     */
    protected function _getFirstCollectionMarker()
    {
        if (!$this->_firstCollectionMarker) {
            $this->_firstCollectionMarker = $this->getCollection()->getFirstItem();
        }
        return $this->_firstCollectionMarker;
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

    /**
     * @return $this
     */
    protected function _addStyleAsset()
    {
        $this->_assetCollection->add(
            $this->_cssIdentifier,
            $this->_assetRepository->createAsset($this->_cssIdentifier)
        );
        return $this;
    }
}