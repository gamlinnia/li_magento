<?php

class Li_Channelsinfo_Model_Backend_Channelsinfo extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{

    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = array(
            $attrCode => array('test', 'test123')
        );

        $object->setData($attrCode, $value);
        var_dump($attrCode);
    }

    public function beforeSave($object)
    {
        var_dump('before save');
    }

    public function afterSave($object)
    {
        var_dump('after save');
    }

}