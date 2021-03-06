<?php

class Li_Customform_IndexController extends Mage_Core_Controller_Front_Action {

    const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';
    const XML_PATH_ENABLED          = 'contacts/contacts/enabled';

    public function indexAction () {
        $this->loadLayout();
        /*block defined in design_layout*/
        $this->getLayout()->getBlock('block_newform')
            ->setFormAction( Mage::getUrl('*/*/post') );
        $this->renderLayout();
    }

    public function secondAction () {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function subscriptionAction () {
        echo 'start';
        $subscription = Mage::getModel('customform/subscription');
        echo get_class($subscription);
        $subscription->setFirstname('John');
        $subscription->setLastname('Doe');
        $subscription->setEmail('john.doe@example.com');
        $subscription->setMessage('A short message to test');

        $subscription->save();

        echo 'success';
    }

    public function postAction () {
        $post = $this->getRequest()->getPost();
        Zend_Debug::dump($post);

        echo 'XML_PATH_EMAIL_TEMPLATE' . Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE) . PHP_EOL;
        echo 'XML_PATH_EMAIL_SENDER' . Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER) . PHP_EOL;
        echo 'XML_PATH_EMAIL_RECIPIENT' . Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT) . PHP_EOL;

        if ($post) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }


                if ($error) {
                    throw new Exception();
                }

                $cusotmform = Mage::getModel('customform/subscription');
                $cusotmform->setData('name', trim($post['name']))
                ->setData('email', trim($post['email']))
                ->setData('comment', trim($post['comment']))
                ->setData('created_at', strtotime('now'))
                ->setData('updated_at', strtotime('now'));
                $cusotmform->save();

                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                        /*
                         * default XML_PATH_EMAIL_TEMPLATE => contacts_email_email_template
                         * default XML_PATH_EMAIL_SENDER => general
                         * default XML_PATH_EMAIL_RECIPIENT => thisisbook@taiwan-motors.com.tw
                         * */
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
                    );
                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }

                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('customform')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('customform')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }
        } else {
            $this->_redirect('*/*/');
        }
    }

    public function collectionAction () {

        $productCollection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('image');

        foreach ($productCollection as $product) {
            Zend_Debug::dump($product->debug());
        }

        echo $productCollection->getSelect()->__toString();

    }

}