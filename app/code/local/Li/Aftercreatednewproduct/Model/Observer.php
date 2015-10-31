<?php

class Li_Aftercreatednewproduct_Model_Observer {

    public function registerVisit (Varien_Event_Observer $observer) {
        Mage::log('catch the observer', null, 'customEvent.log');
        $product = $observer->getProduct();
        $category = $observer->getCategory();
        Mage::log($product->debug(), null, 'customEvent.log');
        Mage::log($category->debug(), null, 'customEvent.log');
    }

    public function savedProductCustomCallapi (Varien_Event_Observer $observer) {
        Mage::log('run function savedProductCustomCallapi', null, 'customEvent.log');
        /** @var $product Mage_Catalog_Model_Product */
        $product = clone $observer->getEvent()->getProduct();
        $originalStore = $product->getStoreId();
        Mage::log($product->debug(), null, 'customEvent.log');
    }

}