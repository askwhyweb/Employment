<?php

class OrviSoft_Employment_Adminhtml_EmploymentController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('employment/employment');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("employment/employment")->_addBreadcrumb(Mage::helper("adminhtml")->__("Employment  Manager"),Mage::helper("adminhtml")->__("Employment Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Employment"));
			    $this->_title($this->__("Manager Employment"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Employment"));
				$this->_title($this->__("Employment"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("employment/employment")->load($id);
				if ($model->getId()) {
					Mage::register("employment_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("employment/employment");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Employment Manager"), Mage::helper("adminhtml")->__("Employment Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Employment Description"), Mage::helper("adminhtml")->__("Employment Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("employment/adminhtml_employment_edit"))->_addLeft($this->getLayout()->createBlock("employment/adminhtml_employment_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("employment")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Employment"));
		$this->_title($this->__("Employment"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("employment/employment")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("employment_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("employment/employment");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Employment Manager"), Mage::helper("adminhtml")->__("Employment Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Employment Description"), Mage::helper("adminhtml")->__("Employment Description"));


		$this->_addContent($this->getLayout()->createBlock("employment/adminhtml_employment_edit"))->_addLeft($this->getLayout()->createBlock("employment/adminhtml_employment_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("employment/employment")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Employment was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setEmploymentData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setEmploymentData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("employment/employment");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("employment/employment");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'employment.csv';
			$grid       = $this->getLayout()->createBlock('employment/adminhtml_employment_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'employment.xml';
			$grid       = $this->getLayout()->createBlock('employment/adminhtml_employment_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
