<?php
/**
 * @package com.encomage.storelocator.m2
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Marker
 * @package Encomage\StoreLocator\Model
 */
class Marker extends AbstractModel
{
    /**
     * Class construct
     */
    protected function _construct()
    {
        $this->_init('Encomage\StoreLocator\Model\Resource\Marker');
    }
}