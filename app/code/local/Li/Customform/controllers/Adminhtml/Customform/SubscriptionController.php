<?php

class Li_Customform_Adminhtml_Customform_SubscriptionController extends Mage_Adminhtml_Controller_Action {

    public function indexAction () {
        $this->loadLayout();

        $this->_addContent(
            $this->getLayout()->createBlock('customform/adminhtml_subscription')
        );

        $this->renderLayout();
    }

    public function editAction () {
        echo 'edit action';
        $productId  = (int) $this->getRequest()->getParam('id');
        var_dump($productId);
    }

    public function massDeleteAction()
    {
        $custom_form_id = $this->getRequest()->getParam('custom_form_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($taxIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select tax(es).'));
        } else {
            try {
                $rateModel = Mage::getModel('tax/calculation_rate');
                foreach ($taxIds as $taxId) {
                    $rateModel->load($taxId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tax')->__(
                        'Total of %d record(s) were deleted.', count($taxIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    /* grid action for filter and sorting */
    public function gridAction() {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('customform/adminhtml_subscription_grid')->toHtml()
        );
    }

    /* this method is for acl to grant admin privilege */
    protected function _isAllowed() {
        /* pass menu tree to isAllowed method */
        return Mage::getSingleton('admin/session')->isAllowed('system/customform');
    }

    public function exportCsvAction(){
        $fileName   = 'customform.csv';
        $grid       = $this->getLayout()->createBlock('customform/adminhtml_subscription_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction(){
        $fileName   = 'customform.xls';
        $grid       = $this->getLayout()->createBlock('customform/adminhtml_subscription_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile());
    }

}