<?php
 
  $installer = $this;
 
  $installer->startSetup();
 
  $installer->run("-- DROP TABLE IF EXISTS {$this->getTable('couriers')};
 
	CREATE TABLE {$this->getTable('couriers')} (
	`id` INT( 11 ) unsigned NOT NULL auto_increment,
	`name` VARCHAR( 100 ) NOT NULL ,
	);

  ");
 
  $installer->endSetup();
  
?>
