<?php

class Li_Customertab_Block_Adminhtml_Customer_Edit_Tab_Productregistrationtab extends Mage_Adminhtml_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function _construct ()
    {
        parent::_construct();
        $this->setTemplate('customertab/productregistrationtab.phtml');
    }

    public function getCustomtabInfo ()
    {
        $customer = Mage::registry('current_customer');
        $customtab='My Custom tab Action Contents Here';
        return $customtab;
    }

    public function getTabLabel ()
    {
        return $this->__('Product Registration');
    }

    public function getTabTitle ()
    {
        return $this->__('Product Registration');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden ()
    {
        return false;
    }

}