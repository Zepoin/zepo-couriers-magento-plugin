<?php

class Zepo_Couriers_Model_Couriers extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('couriers/couriers');
     }
}
