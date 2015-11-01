<?php

class Li_Schedulejob_Model_Observer {

    public function doSchedules () {
        Mage::log('do cronjobs', null, 'jobs.log');
    }

}