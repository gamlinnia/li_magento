<?php

class Li_Aftercreatednewproduct_Block_Newproducts extends Mage_Core_Block_Template {

    public function getProducts () {
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->setOrder('created_at')
            ->setPageSize(5);

        return $products;
    }

}