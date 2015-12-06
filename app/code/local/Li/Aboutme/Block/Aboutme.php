<?php

class Li_Aboutme_Block_Aboutme extends Mage_Core_Block_Template {

    public function getStores () {
        return Mage::app()->getStores();
    }

    public function getCurrentStoreId () {
        return Mage::app()->getStore()->getId();
    }

}