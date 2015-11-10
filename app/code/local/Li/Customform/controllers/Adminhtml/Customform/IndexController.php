<?php

class Li_Customform_Adminhtml_Customform_IndexController extends Mage_Adminhtml_Controller_Action {

    public function indexAction () {
        echo 'customform_index controller';
        $this->loadLayout();
        $this->renderLayout();
    }

}