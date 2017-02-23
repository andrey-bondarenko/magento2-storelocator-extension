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
    /**
     * @var \Encomage\StoreLocator\Helper\Config
     */
    protected $_helperConfig;

    /**
     * @var \Encomage\StoreLocator\Model\ResourceModel\Marker\Collection
     */
    protected $_markersCollection;

    /**
     * MapAbstract constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory
     * @param \Encomage\StoreLocator\Helper\Config $helperConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory,
        \Encomage\StoreLocator\Helper\Config $helperConfig,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_helperConfig = $helperConfig;
        $this->_markersCollection = $markersCollectionFactory->create();
    }
}