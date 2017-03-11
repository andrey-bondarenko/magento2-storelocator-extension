<?php
/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Test\Unit\Model;

/**
 * Class MarkerTest
 * @package Encomage\StoreLocator\Test\Unit\Model
 */
class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    protected $_objectManager;

    /**
     * @var \Encomage\StoreLocator\Model\Marker
     */
    protected $_markerModel;

    /**
     * Set up the test
     */
    protected function setUp()
    {
        $this->_objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->_markerModel = $this->_objectManager->getObject(
            'Encomage\StoreLocator\Model\Marker'
        );
    }

    /**
     * @inheritdoc
     */
    public function testValidateData()
    {
        $actualQuery = [
            'name'          => 'test marker',
            'latitude'      => '47.0076',
            'longitude'     => '48.0076',
            'store_id'      => '1'
        ];

        $expectedQuery = [];
        $this->assertEquals($expectedQuery, $this->_markerModel->validateData($actualQuery));
    }

    /**
     * @inheritdoc
     */
    public function testValidateDataWithoutData()
    {
        $actualQuery = [];

        $expectedQuery = [
            __('Name is required field.'),
            __('Latitude is required field.'),
            __('Longitude is required field.'),
            __('Store Views is required field.')
        ];
        $this->assertEquals($expectedQuery, $this->_markerModel->validateData($actualQuery));
    }
}