<?php

class Mage_Catalog_Model_Product_Attribute_Backend_Channelsinfo extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{

    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();      //  $attrCode = channelsinfo
        $collection = Mage::getModel('channelsinfo/channelsinfo')->getCollection();

        $value = array();

        foreach ($collection as $each) {
            $eachAttribute = $each->getData('attribute');
            $eachValue = $each->getData('value');
            $eachChannel = $each->getData('channel');
            $value[] = array(
                'attribute' => $eachAttribute,
                'value' => $eachValue,
                'channel' => $eachChannel
            );
        }

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