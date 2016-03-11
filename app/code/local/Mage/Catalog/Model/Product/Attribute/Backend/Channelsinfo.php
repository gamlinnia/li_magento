<?php

class Mage_Catalog_Model_Product_Attribute_Backend_Channelsinfo extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{

    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = array(
            $attrCode => array('test', 'test123')
        );

        $object->setData($attrCode, $value);
        Mage::log('after load', null, 'channelinfo.log');
    }

    public function beforeSave($object)
    {
        Mage::log('before save', null, 'channelinfo.log');
    }

    public function afterSave($object)
    {
        Mage::log('after save', null, 'channelinfo.log');
    }

}