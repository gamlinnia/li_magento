<?php

class Mage_Catalog_Model_Product_Attribute_Backend_Channelsinfo extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{

    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = array();

        $object->setData($attrCode, $value);
    }

    public function beforeSave($object)
    {

    }

    public function afterSave($object)
    {

    }

}