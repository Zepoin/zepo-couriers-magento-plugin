
<?php


/*		
	class <Namespace>_<Module>_Model_Mysql4_<Module>_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('<module>/<module>');
    }
}

*/


class Zepo_Couriers_Model_Couriers extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('couriers/couriers');
     }
}


?>