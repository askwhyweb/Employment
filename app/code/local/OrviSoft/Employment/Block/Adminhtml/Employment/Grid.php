<?php

class OrviSoft_Employment_Block_Adminhtml_Employment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("employmentGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("employment/employment")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("employment")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("employee_email", array(
				"header" => Mage::helper("employment")->__("Employee Email"),
				"index" => "employee_email",
				));
				$this->addColumn("employee_id", array(
				"header" => Mage::helper("employment")->__("Employment ID"),
				"index" => "employee_id",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_employment', array(
					 'label'=> Mage::helper('employment')->__('Remove Employment'),
					 'url'  => $this->getUrl('*/adminhtml_employment/massRemove'),
					 'confirm' => Mage::helper('employment')->__('Are you sure?')
				));
			return $this;
		}
			

}