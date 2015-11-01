<?php

class Li_Schedulejob_Model_Observer {

    public function doSchedules () {
        Mage::log('Refresh caches:', null, 'jobs.log');
        try {
            $allTypes = Mage::app()->useCache();
            foreach ($allTypes as $type => $enabled) {
                Mage::log('Refresh caches:' . $type, null, 'jobs.log');
                Mage::app()->getCacheInstance()->cleanType($type);
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'jobs.log');
        }
    }

}