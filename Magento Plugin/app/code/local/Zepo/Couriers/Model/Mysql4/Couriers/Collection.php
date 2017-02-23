<?php

class Zepo_Couriers_Model_Mysql4_Couriers_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
 {
     public function _construct()
     {
         //parent::_construct();
         $this->_init('couriers/couriers');
     }
}
