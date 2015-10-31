<?php

class Li_Aftercreatednewproduct_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction () {
        $this->loadLayout();
        $parameters = array(
            'product' => Mage::getModel('catalog/product')->load(1609),
            'category' => Mage::getModel('catalog/category')->load(7)
        );
        Mage::dispatchEvent('aftercreatednewproduct_register_visit', $parameters);
        $this->renderLayout();
    }
}