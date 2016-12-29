<?php

class Zepo_Couriers_IndexController extends Mage_Core_Controller_Front_Action {

    /**
     * THIS ACTION WE ARE USING TO SUBMIT DATA TO ZEPO
     * FOR SHIPPMENT
     */
    public function IndexAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("Couriers"));
        $this->renderLayout(); 
			
	}

    /**
     * WE NEED TO PASS THIS ACTION IN ZEPO API 
     * IN CASE OF SUCCESSFULLY SUBMITTED FOR THIS 
     * SUCCESS URL WILL BE EXECUTED AND NEED TO UPDATE 
     * SOME INFORMATION LIKE TRACKING NUMBER 
     */
	 
	 
    public function successAction() {
	
	$object = json_decode(file_get_contents('php://input'));
		
	$array = json_decode(json_encode($object), True);
				
	$order_id					=	$array['order_number'];

	$courier_id					=	$array['courier_id'];

	$service_id					=	$array['service_id'];

	$courier_name				=	$array['courier_name'];

	$pickup_status				=	$array['pickup']['success'];
	
	$pickup_number				=	$array['pickup']['pickup_number'];
	
	$pickup_date				=	$array['pickup']['pickup_date'];
	
	$tracking_number			=	$array['shipmentPackages'][0]['tracking_number'];
	
	$serialized_array 			= 	serialize($array); 
	
	
	$data = array(	'order_id' => $order_id,
					'courier_name'=>$courier_name,
					'tracking_number'=>$tracking_number,
					'pickup_response'=>$serialized_array,
					'courier_id'=>$courier_id,
					'service_id'=>$service_id,
					'pickup_number'=>$pickup_number	);
	
	$model = Mage::getModel('couriers/couriers')->addData($data);
	
    try {
		
        $insertId = $model->save()->getId();
		
        echo "Data successfully inserted. Insert ID: " . $insertId;
		
		$logres	=	"Data successfully inserted. Insert ID: " . $insertId;
		
    }	catch (Exception $e)	{
		
        echo $e->getMessage();
		
		$logres	=	$e->getMessage();
		
    }
	
	Mage::log($logres, null, 'successZepo.log', true);
	
	exit;

    }

    /**
     * WE NEED TO PASS THIS ACTION IN ZEPO API
     * IN CASE OF FAILURE. THIS WILL BE EXECUTED 
     * WITH ERROR MESSAGE THAT WE NEED TO MAINTANE 
     */
    public function failAction() {
        
        $data = Mage::app()->getRequest()->getParams();
        echo "<pre>";
        Mage::log(print_r( $data , 1), null, 'failZepo.log');
        print_r($data);
        exit;

    }


    /**
     * Re-Schedule Action
     * THIS WILL EXECUTE RE-SCHEDULE API
     */
    public function rescheduleAction(){
        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("Re-Schedule"));
        $this->renderLayout(); 
    }
}
