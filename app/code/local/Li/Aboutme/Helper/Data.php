<?php
class Li_Aboutme_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getStores () {
        return Mage::app()->getStores();
    }

}