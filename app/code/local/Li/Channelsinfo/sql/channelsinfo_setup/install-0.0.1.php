<?php

/**
 * Create table 'catalog/product_attribute_tier_price'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('catalog/product_attribute_channel_name'))
    ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Value ID')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Entity ID')
    ->addColumn('channel', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
        'nullable'  => false,
        'default'   => null,
    ), 'Channel')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        'default'   => null,
    ), 'Value')
    ->addIndex(
        $installer->getIdxName(
            'catalog/product_attribute_channel_name',
            array('entity_id', 'channel'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('entity_id', 'channel'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->addIndex($installer->getIdxName('catalog/product_attribute_tier_price', array('entity_id')),
        array('entity_id'))
    ->addForeignKey(
        $installer->getFkName(
            'catalog/product_attribute_channel_name',
            'entity_id',
            'catalog/product',
            'entity_id'
        ),
        'entity_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Catalog Product Channel Name Attribute Backend Table');
$installer->getConnection()->createTable($table);
