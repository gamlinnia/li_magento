<?php

class Li_Channelsinfo_Block_Adminhtml_Channelinfo extends Varien_Data_Form_Element_Abstract
{

    public function getElementHtml()
    {
        $html = $this->getContentHtml();
        //$html.= $this->getAfterElementHtml();
        return $html;
    }

    public function getContentHtml()
    {
        $setId = Mage::registry('product')->getAttributeSetId();
//        $collection = Mage::getResourceModel('eav/entity_attribute_group_collection')->setAttributeSetFilter($setId);
//        $videoGroupId = null;
//        foreach ($collection as $group)
//        {
//            if ($group->getAttributeGroupName() == 'Videos')
//            {
//                $videoGroupId = $group->getId();
//            }
//        }

        $content = Mage::getSingleton('core/layout')->createBlock('adminhtml/channelinfo_skucontent');
        $content->setId($this->getHtmlId() . '_content')
            ->setElement($this);

        return $content->toHtml();
    }

    public function getDataObject()
    {
        return $this->getForm()->getDataObject();
    }

    public function getAttributeFieldName($attribute)
    {
        $name = $attribute->getAttributeCode();
        if ($suffix = $this->getForm()->getFieldNameSuffix()) {
            $name = $this->getForm()->addSuffixToName($name, $suffix);
        }
        return $name;
    }

    public function toHtml()
    {
        return '<tr><td class="value" colspan="3">' . $this->getElementHtml() . '</td></tr>';
    }

}