<?php

/**
 * @author Andrey Bondarenko
 * @link http://encomage.com
 * @mail info@encomage.com
 */

namespace Encomage\StoreLocator\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class InstallSchema
 * @package Encomage\StoreLocator\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('encomage_storelocator')) {
            $table = $installer->getConnection()->newTable($installer->getTable('encomage_storelocator'))
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'auto_increment' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'Name'
                )
                ->addColumn(
                    'latitude',
                    \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'Coordinate latitude'
                )
                ->addColumn(
                    'longitude',
                    \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'Coordinate longitude'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    50,
                    [
                        'nullable' => false,
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'comment',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'Comment'
                );
            $table->setComment('Encomage StoreLocator');
            $installer->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}