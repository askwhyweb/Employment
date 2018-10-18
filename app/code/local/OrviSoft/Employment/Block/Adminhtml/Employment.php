<?php


class OrviSoft_Employment_Block_Adminhtml_Employment extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_employment";
	$this->_blockGroup = "employment";
	$this->_headerText = Mage::helper("employment")->__("Employment Manager");
	$this->_addButtonLabel = Mage::helper("employment")->__("Add New Item");
	parent::__construct();
	
	}

}