<?php

class Mage_Adminhtml_Block_Channelinfo_Skucontent extends Mage_Adminhtml_Block_Widget
{

    public function __construct()
    {
        parent::__construct();

        // Set template for content block.
        $this->setTemplate('channelsinfo/skucontent.phtml');
    }

}