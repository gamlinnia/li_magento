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

        Mage::log('Index Rebuild.:', null, 'jobs.log');
        try {
            /* @var $indexCollection Mage_Index_Model_Resource_Process_Collection */
            $indexCollection = Mage::getModel('index/process')->getCollection();
            foreach ($indexCollection as $index) {
                Mage::log('Rebuild indexes:' . $index, null, 'jobs.log');
                /* @var $index Mage_Index_Model_Process */
                $index->reindexAll();
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'jobs.log');
        }
    }

}