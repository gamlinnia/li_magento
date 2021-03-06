<?php

class Li_Customform_Block_Adminhtml_Subscription extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct () {
        $this->_headerText = Mage::helper('customform')->__('Customform Subscription');

        $this->_blockGroup = 'customform';
        $this->_controller = 'adminhtml_subscription';

        parent::__construct();
    }

    protected function _prepareLayout () {
//        $this->_removeButton('add');

        return parent::_prepareLayout();
    }

    public function isSingleStoreMode() {
        if (!Mage::app()->isSingleStoreMode()) {
            return false;
        }
        return true;
    }

}