<?php

$installer = $this;

$installer->startSetup();

$installer->removeAttribute('catalog_product', 'channelsinfo');

$installer->endSetup();

