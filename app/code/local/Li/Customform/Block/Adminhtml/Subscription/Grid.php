<?php

class Li_Customform_Block_Adminhtml_Subscription_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct () {
        parent::__construct();

        $this->setId('subscription_grid');
        $this->setDefaultSort('subscription_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection () {
        $collection = Mage::getModel('customform/subscription')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns () {

        $this->addColumn('subscription_id', array(
            'index' => 'subscription_id',
            'header' => Mage::helper('customform')->__('subscription_id'),
            'type' => 'number',
            'sortable' => true,
            'width' => '100px'
        ));

        $this->addColumn('name', array(
            'index' => 'name',
            'header' => Mage::helper('customform')->__('name'),
            'sortable' => false
        ));

        $this->addColumn('email', array(
            'index' => 'email',
            'header' => Mage::helper('customform')->__('Email'),
            'sortable' => false
        ));

        $this->addColumn('created_at', array(
            'index' => 'created_at',
            'header'=> Mage::helper('customform')->__('Created At'),
            'type' => 'datetime',
            'sortable' => true,
            'width' => '150px'
        ));

        $this->addColumn('status', array(
            'index' => 'status',
            'header' => Mage::helper('customform')->__('Status'),
            'sortable' => true,
            'frame_callback' => array($this, 'prepareStatusLayout'),
            'width' => '150px'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('subscription_id');

        $this->getMassactionBlock()->setFormFieldName('custom_form');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('catalog')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('catalog/product_status')->getOptionArray();

        /* 塞進一個空白的option */
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('catalog')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        if (Mage::getSingleton('admin/session')->isAllowed('catalog/update_attributes')){
            $this->getMassactionBlock()->addItem('attributes', array(
                'label' => Mage::helper('catalog')->__('Update Attributes'),
                'url'   => $this->getUrl('*/catalog_product_action_attribute/edit', array('_current'=>true))
            ));
        }

        Mage::dispatchEvent('adminhtml_catalog_product_grid_prepare_massaction', array('block' => $this));
        return $this;
    }

    public function prepareStatusLayout ($value) {
        $class = '';
        switch ($value) {
            case 'pending' :
                $class = 'grid-severity-notice';
                break;
            case 'approved' :
                $class = 'grid-severity-major';
                break;
            case 'declined' :
                $class = 'grid-severity-critical';
                break;
        }
        return '<span class="' . $class . '"><span>' . $value . '</span></span>';
    }

    public function getGridUrl () {
        return $this->getUrl('*/*/grid', array(
            '_current' => true
        ));
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array(
                'id'=>$row->getId())
        );
    }
}