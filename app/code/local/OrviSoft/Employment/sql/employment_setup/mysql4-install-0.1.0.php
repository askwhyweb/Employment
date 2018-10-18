<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table employment(id int not null auto_increment, employee_email varchar(255), employee_id varchar(255), primary key(id));
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 