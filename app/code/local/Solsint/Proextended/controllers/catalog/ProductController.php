<?php
include_once("Mage/Adminhtml/controllers/Catalog/ProductController.php");
class Solsint_Proextended_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{

    public function newAction()
    {
        echo "Working"; exit; //do here what you want to do
    }
}