<?php

class Li_Channelsinfo_Block_Adminhtml_Channelinfo_Skucontent extends Mage_Adminhtml_Block_Widget
{

    public function __construct()
    {
        parent::__construct();

        // Set template for content block.
        $this->setTemplate('channelsinfo/skucontent.phtml');
    }

}