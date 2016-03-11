<?php

class Mage_Adminhtml_Block_Channelinfo_Skucontent extends Mage_Adminhtml_Block_Widget
{

    public function __construct()
    {
        parent::__construct();

        // Set template for content block.
        $this->setTemplate('channelsinfo/skucontent.phtml');
    }

    protected function _prepareLayout()
    {

        $this->setChild('add_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('catalog')->__('Add New Option'),
                    'class' => 'add',
                    'onclick'   => 'answer.add(this)',
                    'id'    => 'add_new_defined_option'
                ))
        );

        return parent::_prepareLayout();
    }

    public function getAddButtonHtml()
    {
        return $this->getChildHtml('add_button');
    }

}