<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\ResourceModel\Marker;

/**
 * Class Collection
 * @package Encomage\StoreLocator\Model\ResourceModel\Marker
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Class construct
     */
    protected function _construct()
    {
        $this->_init(
            'Encomage\StoreLocator\Model\Marker',
            'Encomage\StoreLocator\Model\ResourceModel\Marker'
        );
    }
}