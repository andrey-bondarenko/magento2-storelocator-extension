<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Block\Adminhtml\Page\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;

/**
 * Class SaveAndContinueButton
 * @package Encomage\StoreLocator\Block\Adminhtml\Page\Edit
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and continue'),
            'on_click' => sprintf("location.href = '%s';", $this->_getSaveAndContinueUrl()),
            'class' => 'save',
            'sort_order' => 30
        ];
    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save');
    }
}