<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Plugin\Block;


/**
 * Class Topmenu
 * @package Encomage\StoreLocator\Plugin\Block
 */
class Topmenu
{
    /**
     * @var \Magento\Framework\Data\Tree\NodeFactory
     */
    protected $_nodeFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * Topmenu constructor.
     * @param \Magento\Framework\Data\Tree\NodeFactory $nodeFactory
     */
    public function __construct(
        \Magento\Framework\Data\Tree\NodeFactory $nodeFactory,
        \Magento\Framework\UrlInterface $urlBuilder
    )
    {
        $this->_nodeFactory = $nodeFactory;
        $this->_urlBuilder = $urlBuilder;
    }

    /**
     * @param \Magento\Theme\Block\Html\Topmenu $subject
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @param int $limit
     */
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    )
    {
        $node = $this->_nodeFactory->create(
            [
                'data' => [
                    'name' => __('Store Locator'),
                    'id' => 'store-locator',
                    'url' => $this->_urlBuilder->getUrl('storelocator')
                ],
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }
}