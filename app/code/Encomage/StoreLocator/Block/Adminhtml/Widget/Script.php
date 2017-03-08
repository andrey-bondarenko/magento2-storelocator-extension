<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block\Adminhtml\Widget;

/**
 * Class Script
 * @package Encomage\StoreLocator\Block\Adminhtml\Widget
 */
class Script extends \Magento\Backend\Block\Template
{
    const MARKERS_AJAX_URL = 'storelocator/widget/ajaxMarkers';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Script constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        array $data
    )
    {
        parent::__construct($context, $data);
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return [
            'ajaxUrl'       => $this->getUrl(self::MARKERS_AJAX_URL),
            'widgetId'      => $this->_getCurrentWidget() ? (int)$this->_getCurrentWidget()->getInstanceId() : null,
            'widgetCode'    => $this->_getCurrentWidget() ? $this->_getCurrentWidget()->getInstanceCode() : null,
        ];
    }

    /**
     * @return null | \Magento\Widget\Model\Widget\Instance
     */
    protected function _getCurrentWidget()
    {
        return $this->_coreRegistry->registry('current_widget_instance');
    }
}