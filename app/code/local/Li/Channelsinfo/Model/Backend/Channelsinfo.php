<?php

class Li_Channelsinfo_Model_Backend_Channelsinfo extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{

    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = array(
            'channelsinfo' => array()
        );

        $object->setData($attrCode, $value);
    }

}