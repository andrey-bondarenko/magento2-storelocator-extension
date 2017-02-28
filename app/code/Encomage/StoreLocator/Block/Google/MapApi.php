<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block\Google;

/**
 * Class MapAbstract
 * @package Encomage\StoreLocator\Block
 */
class MapApi extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Encomage_StoreLocator::js/script.phtml';
    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->_scopeConfig->getValue(\Encomage\StoreLocator\Helper\Config::GOOGLE_API_KEY_PATH);
    }

    /**
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->_scopeConfig->getValue(\Encomage\StoreLocator\Helper\Config::GOOGLE_API_VERSION_PATH);
    }
}