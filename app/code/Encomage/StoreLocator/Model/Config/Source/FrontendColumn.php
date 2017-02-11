<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\Config\Source;

/**
 * Class FrontendColumn
 * @package Encomage\StoreLocator\Model\Config\Source
 */
class FrontendColumn implements \Magento\Framework\Option\ArrayInterface
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
