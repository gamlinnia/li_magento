<?php

$installer = $this;

$installer->startSetup();


// Load all Attribute Sets
$attributeSetIds = $installer->getAllAttributeSetIds($installer->getEntityTypeId('catalog_product'));

// Add "Videos" attribute group to all Attribute Sets
foreach ($attributeSetIds as $id)
{
    $installer->addAttributeGroup('catalog_product', $id, 'Channels', 5);
}

$installer->addAttribute('catalog_product', 'channelsinfo', array(
    'group'			=> 'Channels',
    'backend'       => 'channelsinfo/backend_channelsinfo',
    'input_renderer'=> 'channelsinfo/adminhtml_channelinfo',
    'frontend'      => '',
    'label'         => 'Channel Info',
    'input'         => 'channelsinfo',
    'type'          => 'varchar',
    'class'         => '',
    'source'        => '',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'       => true,
    'required'      => false,
    'user_defined'  => true,
    'default'       => '',
    'searchable'    => false,
    'filterable'    => false,
    'unique'        => false,
    'comparable'    => false,
    'visible_on_front'  => false,
));

// Add new "video_gallery" attribute to the "Videos" attribute group in each attribute set
foreach ($attributeSetIds as $id)
{
    $installer->addAttributeToSet('catalog_product', $id, 'Channels', 'channelsinfo');
}

$installer->endSetup();

