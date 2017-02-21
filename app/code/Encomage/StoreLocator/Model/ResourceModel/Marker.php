<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\ResourceModel;

/**
 * Class Marker
 * @package Encomage\StoreLocator\Model\ResourceModel
 */
class Marker extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Class construct
     */
    protected function _construct()
    {
        $this->_init('encomage_storelocator', 'entity_id');
    }
}