<?php

class Li_Customform_Adminhtml_Customform_SubscriptionController extends Mage_Adminhtml_Controller_Action {

    public function indexAction () {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('customform/adminhtml_subscription'));

        $this->renderLayout();
    }

    public function editAction () {
        echo 'edit action';
        $post = $this->getRequest()->getPost();
        var_dump($post);
        if ($this->_getRequest()->isPost()) {
            echo 'got post' . PHP_EOL;
        }
        var_dump($this->_getRequest()->getParam('subscription_grid'));
    }

    /* this method is for acl to grant admin privilege */
    protected function _isAllowed() {
        /* pass menu tree to isAllowed method */
        return Mage::getSingleton('admin/session')->isAllowed('system/customform');
    }

}