<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Model\Config\Source;

/**
 * Class Status
 * @package Encomage\StoreLocator\Model\Config\Source
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    const MARKER_STATUS_ENABLED     = 1;
    const MARKER_STATUS_DISABLED    = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Enable'), 'value'   => self::MARKER_STATUS_ENABLED],
            ['label' => __('Disable'), 'value'  => self::MARKER_STATUS_DISABLED]
        ];
    }
}