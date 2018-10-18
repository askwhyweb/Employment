<?php
class OrviSoft_Employment_Model_Mysql4_Employment extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("employment/employment", "id");
    }
}