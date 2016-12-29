<?php
 
  $installer = $this;
 
  $installer->startSetup();
 
  $installer->run("
  
	DROP TABLE IF EXISTS {$this->getTable('couriers')};
	
	CREATE TABLE IF NOT EXISTS {$this->getTable('couriers')} (
	  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  `order_id` varchar(20) DEFAULT NULL,
	  `dispatch_date` datetime DEFAULT NULL,
	  `delivery_date` datetime DEFAULT NULL,
	  `courier_name` varchar(100) DEFAULT NULL,
	  `tracking_number` varchar(200) DEFAULT NULL,
	  `pickup_response` varchar(2000) DEFAULT NULL,
	  `courier_id` tinyint(3) unsigned DEFAULT NULL,
	  `service_id` tinyint(3) unsigned DEFAULT NULL,
	  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `updated_at` datetime NOT NULL,
	  `pickup_number` varchar(50) DEFAULT NULL,
	  `expected_pickup_date` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `order_id` (`order_id`),
	  KEY `FK_order_dispatch_1` (`order_id`)
	)

  ");
 
  $installer->endSetup();
  
?>