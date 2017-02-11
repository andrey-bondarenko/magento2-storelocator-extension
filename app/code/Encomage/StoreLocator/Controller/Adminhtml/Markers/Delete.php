<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Controller\Adminhtml\Markers;

/**
 * Class Delete
 * @package Encomage\StoreLocator\Controller\Adminhtml\Markers
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var \Encomage\StoreLocator\Model\Marker
     */
    protected $_markerObject;

    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Encomage\StoreLocator\Model\MarkerFactory $markerFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Encomage\StoreLocator\Model\MarkerFactory $markerFactory
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_markerObject = $markerFactory->create();
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $markerId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($markerId) {
            try {
                $this->_markerObject->setEntityId($markerId)->deleteMarker();
                $this->messageManager->addSuccessMessage(__('Store marker was deleted'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage(), __('Something went wrong.'));
            }
        }
        return $resultRedirect->setPath('*/*/grid');
    }
}