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
        Mage::log($observer->getEvent()->debug(), null, 'event.log');
        $restResponse = $this->CallAPI(
            'GET',
            'http://rwdev.buyabs.corp/product_sync/rest/route.php/api/getMappedAttributeSetOrSubcategory?inputValue=Speakers&inputType=subCategory',
            array()
        );
        Mage::log($restResponse, null, 'rest.log');
    }

    public function CallAPI ($method, $url, $header = null, $data = false) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        /*Custom Header*/
        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result, true);
    }

}