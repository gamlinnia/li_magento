<?php
require_once "Mage/Adminhtml/controllers/Catalog/ProductController.php";
class SilkSoftware_RewriteMagento_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{

	public function deletemanualAction() {

		$id        = $this->getRequest()->getParam('id');

		$pid        = $this->getRequest()->getParam('pid');

		$manual=	Mage::getModel('usermanuals/usermanuals')->load($id);

		$manual->delete();

		Mage::getModel('catalog/product')->load($pid)->setUpdatedAt(strtotime('now'))->save();

		$this->_redirect('*/*/edit', array(
			'id'    =>  $pid,
			'tab'=>'product_info_tabs_user_manuals'
		));

	}


	public function deletedriverAction() {

		$id        = $this->getRequest()->getParam('id');

		$pid        = $this->getRequest()->getParam('pid');

		$driver=	Mage::getModel('drivers/drivers')->load($id);

		$driver->delete();

		Mage::getModel('catalog/product')->load($pid)->setUpdatedAt(strtotime('now'))->save();

		$this->_redirect('*/*/edit', array(
			'id'    =>  $pid,
			'tab'=>'product_info_tabs_user_manuals'
		));

	}


	public function deletefirmwareAction() {

		$id        = $this->getRequest()->getParam('id');

		$pid        = $this->getRequest()->getParam('pid');

		$firmware=	Mage::getModel('firmware/firmware')->load($id);

		$firmware->delete();

		Mage::getModel('catalog/product')->load($pid)->setUpdatedAt(strtotime('now'))->save();

		$this->_redirect('*/*/edit', array(
			'id'    =>  $pid,
			'tab'=>'product_info_tabs_user_manuals'
		));

	}



	/**
	 * Save product action
	 */
	public function saveAction()
	{
		$storeId        = $this->getRequest()->getParam('store');
		$redirectBack   = $this->getRequest()->getParam('back', false);
		$productId      = $this->getRequest()->getParam('id');
		$isEdit         = (int)($this->getRequest()->getParam('id') != null);

		$data = $this->getRequest()->getPost();
		if ($data) {
			$this->_filterStockData($data['product']['stock_data']);

			$product = $this->_initProductSave();

			try {
				$product->save();
				$productId = $product->getId();


				//save videos

				if(isset($data['links']['videos'])) {

					$productvideos_collection=Mage::getModel('productvideos/productvideos')->getCollection()->addFieldToFilter('product_id',$productId);

					foreach($productvideos_collection as $productvideos_key=>$productvideos_val) {

						$productvideos_val->delete();

					}

					$productvideos_data=Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['links']['videos']);


					foreach($productvideos_data as $productvideos_id=>$productvideos_data_value) {

						$position=0;

						if(isset($productvideos_data_value['position'])) {

							$position=(int)$productvideos_data_value['position'];

						}

						Mage::getModel('productvideos/productvideos')
							->setVideogalleryId($productvideos_id)
							->setProductId($productId)
							->setPosition($position)
							->setId(null)
							->save();

						Mage::getModel('catalog/product')->load($productId)->setUpdatedAt(strtotime('now'))->save();

					}


				}

				//save  videos

				//save User Manuals

				if (isset($_FILES)){


					if ($_FILES['user_manuals']['name']) {


						$io = new Varien_Io_File();


						$path = Mage::getBaseDir('media') . DS . 'download' . DS . 'user_manual' . DS;


						$uploader = new Varien_File_Uploader('user_manuals');
						//$uploader->setAllowedExtensions(array('jpg'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						$destFile = $path.$_FILES['user_manuals']['name'];
						$filename = $uploader->getNewFileName($destFile);
						$uploader->save($path, $filename);

						$filename=implode('_',explode(' ',$filename));

						$file_path='download/user_manual/'.$filename;


						Mage::getModel('usermanuals/usermanuals')
							->setFile($file_path)
							->setProductId($productId)
							->setId(null)
							->save();

						Mage::getModel('catalog/product')->load($productId)->setUpdatedAt(strtotime('now'))->save();

					}
					else {

					}

				}
				else {


				}

				//save User Manuals




				//save Drivers

				if (isset($_FILES)){


					if ($_FILES['drivers']['name']) {


						$io = new Varien_Io_File();


						$path = Mage::getBaseDir('media') . DS . 'Download_Files' . DS . 'Drivers' . DS;


						$uploader = new Varien_File_Uploader('drivers');
						//$uploader->setAllowedExtensions(array('jpg'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						$destFile = $path.$_FILES['drivers']['name'];
						$filename = $uploader->getNewFileName($destFile);
						$uploader->save($path, $filename);

						$filename=implode('_',explode(' ',$filename));

						$file_path='Download_Files/Drivers/'.$filename;


						Mage::getModel('drivers/drivers')
							->setFile($file_path)
							->setProductId($productId)
							->setId(null)
							->save();

						Mage::getModel('catalog/product')->load($productId)->setUpdatedAt(strtotime('now'))->save();



					}
					else {

					}

				}
				else {


				}

				//save Drivers


				//save Firmware

				if (isset($_FILES)){


					if ($_FILES['firmware']['name']) {


						$io = new Varien_Io_File();


						$path = Mage::getBaseDir('media') . DS . 'Download_Files' . DS . 'Firmware' . DS;


						$uploader = new Varien_File_Uploader('firmware');
						//$uploader->setAllowedExtensions(array('jpg'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						$destFile = $path.$_FILES['firmware']['name'];
						$filename = $uploader->getNewFileName($destFile);
						$uploader->save($path, $filename);

						$filename=implode('_',explode(' ',$filename));

						$file_path='Download_Files/Firmware/'.$filename;


						Mage::getModel('firmware/firmware')
							->setFile($file_path)
							->setProductId($productId)
							->setId(null)
							->save();

						Mage::getModel('catalog/product')->load($productId)->setUpdatedAt(strtotime('now'))->save();



					}
					else {

					}

				}
				else {


				}

				//save Firmware




				if (isset($data['copy_to_stores'])) {
					$this->_copyAttributesBetweenStores($data['copy_to_stores'], $product);
				}

				$this->_getSession()->addSuccess($this->__('The product has been saved.'));
			} catch (Mage_Core_Exception $e) {
				$this->_getSession()->addError($e->getMessage())
					->setProductData($data);
				$redirectBack = true;
			} catch (Exception $e) {
				Mage::logException($e);
				$this->_getSession()->addError($e->getMessage());
				$redirectBack = true;
			}
		}

		if ($redirectBack) {
			$this->_redirect('*/*/edit', array(
				'id'    => $productId,
				'_current'=>true
			));
		} elseif($this->getRequest()->getParam('popup')) {
			$this->_redirect('*/*/created', array(
				'_current'   => true,
				'id'         => $productId,
				'edit'       => $isEdit
			));
		} else {
			$this->_redirect('*/*/', array('store'=>$storeId));
		}
	}

	public function videosAction()
	{
		$this->_initProduct();
		$this->loadLayout();
		$this->getLayout()->getBlock('catalog.product.edit.tab.videos');
		// ->setProductsVideos($this->getRequest()->getPost('products_videos', null));
		$this->renderLayout();
	}


	public function videosGridAction()
	{
		$this->_initProduct();
		$this->loadLayout();
		$this->getLayout()->getBlock('catalog.product.edit.tab.videos');
		//->setProductsVideos($this->getRequest()->getPost('products_videos', null));
		$this->renderLayout();
	}

	/**
	 * add by tim, 2016/1/27
	 * Get channel reviews grid and serializer block
	 */
	public function channelreviewsAction()
	{
		$this->_initProduct();
		$this->loadLayout();
		$this->getLayout()->getBlock('catalog.product.edit.tab.channelreviews');
		$this->renderLayout();
	}

	public function channelreviewsGridAction()
	{
		$this->_initProduct();
		$this->loadLayout();
		$this->getLayout()->getBlock('catalog.product.edit.tab.channelreviews');
		$this->renderLayout();
	}

}
				