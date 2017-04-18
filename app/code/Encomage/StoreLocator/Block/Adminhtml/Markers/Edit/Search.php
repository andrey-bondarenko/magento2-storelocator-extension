<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block\Adminhtml\Markers\Edit;

/**
 * Class Search
 * @package Encomage\StoreLocator\Block\Adminhtml\Markers\Edit
 */
class Search  extends \Magento\Backend\Block\Template
{
    /**
     * Class construct
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('Encomage_StoreLocator::markers/edit/search.phtml');
    }
}