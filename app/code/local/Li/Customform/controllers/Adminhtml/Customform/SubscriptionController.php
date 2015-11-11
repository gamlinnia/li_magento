<?php

class Li_Customform_Adminhtml_Customform_SubscriptionController extends Mage_Adminhtml_Controller_Action {

    public function indexAction () {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('customform/adminhtml_subscription'));

        $this->renderLayout();
    }

    /* this method is for acl to grant admin privilege */
    protected function _isAllowed() {
        /* pass menu tree to isAllowed method */
        return Mage::getSingleton('admin/session')->isAllowed('system/customform');
    }

}