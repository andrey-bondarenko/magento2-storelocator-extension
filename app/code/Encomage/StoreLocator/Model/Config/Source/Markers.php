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
     * Markers constructor.
     * @param \Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory
     */
    public function __construct(\Encomage\StoreLocator\Model\ResourceModel\Marker\CollectionFactory $markersCollectionFactory)
    {
        $this->_markersCollection = $markersCollectionFactory->create();
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->_markersCollection->getItems() as $item) {
            $options[] = [
                'label' => $item->getName(),
                'value' => $item->getId()
            ];
        }
        return $options;
    }
}
