<?php

require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';
class Li_Extendcontroller_Adminhtml_Extendcontroller_SubscriptionController extends Mage_Adminhtml_Catalog_ProductController
{

    public function indexAction () {
        echo '456';
    }

    public function newAction()
    {
         echo "done"; exit;
    }

}