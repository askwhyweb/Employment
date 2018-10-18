<?php
class OrviSoft_Employment_Block_Adminhtml_Employment_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("employment_form", array("legend"=>Mage::helper("employment")->__("Item information")));

				
						$fieldset->addField("employee_email", "text", array(
						"label" => Mage::helper("employment")->__("Employee Email"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "employee_email",
						));
					
						$fieldset->addField("employee_id", "text", array(
						"label" => Mage::helper("employment")->__("Employment ID"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "employee_id",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getEmploymentData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getEmploymentData());
					Mage::getSingleton("adminhtml/session")->setEmploymentData(null);
				} 
				elseif(Mage::registry("employment_data")) {
				    $form->setValues(Mage::registry("employment_data")->getData());
				}
				return parent::_prepareForm();
		}
}
