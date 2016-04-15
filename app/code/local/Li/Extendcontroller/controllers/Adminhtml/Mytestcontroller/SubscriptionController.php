<?php

require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';
class Li_Extendcontroller_Adminhtml_Mytestcontroller_SubscriptionController extends Mage_Adminhtml_Catalog_ProductController
{

    public function indexAction () {
        echo '789';
    }

}