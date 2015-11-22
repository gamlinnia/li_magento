<?php

class Li_Aboutme_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction () {
        $this->loadLayout();
        /*block defined in design_layout*/
        $this->getLayout()->getBlock('block_aboutme');
        $this->renderLayout();
    }

}