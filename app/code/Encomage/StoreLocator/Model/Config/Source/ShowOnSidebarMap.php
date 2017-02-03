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
 * Class ShowOnSidebarMap
 * @package Encomage\StoreLocator\Model\Config\Source
 */
class ShowOnSidebarMap implements ArrayInterface
{

    const SIDEBAR_MAP_MARKER_RANDOM = 'random';
    const SIDEBAR_MAP_MARKER_STORE_MARKER = 'marker';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = true;//TODO:: Implement
        if ($collection) {
            return [
                [
                    'value' => self::SIDEBAR_MAP_MARKER_RANDOM,
                    'label' => __('Random Marker')
                ],
                [
                    'value' => self::SIDEBAR_MAP_MARKER_STORE_MARKER,
                    'label' => __('Marker To Store')
                ]
            ];
        }
        return [
            [
                [
                    'value' => 0,
                    'label' => __('No markers for this store')
                ]
            ]
        ];
    }
}
