<?php 

class Zepo_Couriers_Model_Rendor extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
	
	public function render(Varien_Object $row) {
		
		$order 		= 	Mage::getModel('sales/order')->load($row->getEntityId());
		
		$order_id	=	$order->getIncrementId();
		
		$model = Mage::getModel('couriers/couriers');

		$model->load($order_id, 'order_id');
		
		$tracking_number	=	$model->tracking_number;
		
		$courier_name		=	$model->courier_name;
		
		if(empty($tracking_number)){
			
		$apiUrl = $this->getUrl('couriers/index/index', array('order_id' => $row->getEntityId()));

		return "<a href=".$apiUrl." target='_blank' class='form-button'> ". Mage::helper('core')->__('Ship Now') ."</button>";
		
		}	else	{
			
		return "$courier_name : $tracking_number";
			
		}
		
		
	}

}