<?php
/**
 * @package com.encomage.storelocator.m2
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class FrontendColumn
 * @package Encomage\StoreLocator\Model\Config\Source
 */
class FrontendColumn implements ArrayInterface
{
    const SHOW_ON_LEFT_COLUMNS = 'left';
    const SHOW_ON_RIGHT_COLUMNS = 'right';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::SHOW_ON_LEFT_COLUMNS,
                'label' => __('Left Column'),
            ],
            [
                'value' => self::SHOW_ON_RIGHT_COLUMNS,
                'label' => __('Right Column'),
            ]
        ];
    }
}
