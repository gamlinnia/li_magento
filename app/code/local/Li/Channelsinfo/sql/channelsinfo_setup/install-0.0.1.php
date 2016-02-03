<?php

$installer = $this;

$installer->startSetup();
/**
 * Create table 'catalog/product_attribute_tier_price'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('catalog_product_attribute_channelsinfo'))
    ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true
    ), 'Value ID')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Entity ID')
    ->addColumn('channel', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
        'nullable'  => false,
        'default'   => null
    ), 'Channel')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        'default'   => null
    ), 'Value')
    ->addColumn('attribute', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
        'nullable'  => false,
        'default'   => null
    ), 'Attribute Name')
    ->addForeignKey(
        $installer->getFkName(
            'catalog_product_attribute_channelsinfo',
            'entity_id',
            'catalog/product',
            'entity_id'
        ),
        'entity_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Catalog Product Channel Information Attribute Backend Table');
$installer->getConnection()->createTable($table);
$installer->endSetup();

$installer->addAttribute('catalog_product', 'channelsinfo', array(
    'type'                       => 'varchar',
    'label'                      => 'Channels Information',
    'input'                      => 'text',
//    'backend'                    => 'catalog/product_attribute_backend_channelsinfo',
    'required'                   => false,
    'sort_order'                 => 6,
    'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'apply_to'                   => 'simple',
    'group'                      => 'Channels Information'
));