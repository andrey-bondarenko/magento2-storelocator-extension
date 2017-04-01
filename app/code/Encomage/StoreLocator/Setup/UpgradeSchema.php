<?php

/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Setup;

/**
 * Class UpgradeSchema
 * @package Encomage\StoreLocator\Setup
 */
class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $this->_addAddressDetails($setup);
        }
    }

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function _addAddressDetails($setup)
    {
        $tableName = $setup->getTable('encomage_storelocator');
        if ($setup->getConnection()->isTableExists($tableName)) {
            $columns = [
                'work_time' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'length' => 255,
                    'comment' => 'work time',
                ],
                'address' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'length' => 255,
                    'comment' => 'marker address',
                ],
                'zip' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'length' => 50,
                    'comment' => 'zip code',
                ],
                'phone' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'length' => 50,
                    'comment' => 'phone',
                ],
                'email' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'length' => 50,
                    'comment' => 'email',
                ],
                'is_active' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    'nullable' => false,
                    'default' => '1',
                    'comment' => 'is active marker',
                ]
            ];
            $connection = $setup->getConnection();
            foreach ($columns as $name => $definition) {
                $connection->addColumn($tableName, $name, $definition);
            }
        }
        return $this;
    }
}