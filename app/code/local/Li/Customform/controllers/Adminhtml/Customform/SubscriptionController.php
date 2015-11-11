<?php

class Li_Customform_Adminhtml_Customform_SubscriptionController extends Mage_Adminhtml_Controller_Action {

    public function indexAction () {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('customform/adminhtml_subscription'));

        $this->renderLayout();
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('customform/adminhtml_subscription');
    }

}