<?php

class Zepo_Couriers_Model_Mysql4_Couriers extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
     {
         $this->_init('couriers/couriers', 'couriers_id');
     }
}
