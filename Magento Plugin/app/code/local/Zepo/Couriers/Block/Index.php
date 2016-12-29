<?php   
class Zepo_Couriers_Block_Index extends Mage_Core_Block_Template{   

	public function getRequestObject() {

        $data = Mage::app()->getRequest()->getParams();
        
        $order = Mage::getModel('sales/order')->load( $data['order_id'] );

        // if order not found 
        if(!$order->getid()) return array();

        // $invoice = 0;
        $grandTotal = $order->getGrandTotal();
		
		$grandTotal = round($grandTotal, 0);

        // complete contact name
        $shipping = $order->getShippingAddress();
        $contact_name = array();
        if( $shipping->getFirstname() ) $contact_name[] = $shipping->getFirstname();
        if( $shipping->getMiddlename() ) $contact_name[] = $shipping->getMiddlename();
        if( $shipping->getLastname() ) $contact_name[] = $shipping->getLastname();
        $contact_name = implode(' ', $contact_name);

        // street address
        $street = $shipping->getStreet();
        $streetAdd = array();
        foreach ($street as $s) $streetAdd[] = $s;
        $streetAdd = implode(' ', $streetAdd);

        $address = array();
        if( $shipping->getCompany() ) $address[] = $shipping->getCompany();
        if( $streetAdd ) $address[] = $streetAdd;

        $address = implode(' ', $address);

        // payment method . 
        $payment = 'online';

        if( $order->getPayment()->getMethodInstance()->getCode() == 'cashondelivery' ) $payment = 'COD';

        // category name 
        // This should contain the category name of the product being sent. 
        // The category name can be fetched from the ‘Category’ under which it is listed on the Magento Store
        // For E.g.: If ‘Jeans’ is being shipped and it is listed under ‘Boy’s Clothing’ on the Magento Store
        // Package Description = Boy’s Clothing
        // For multiple products being shipped with in the same order, the Product Description will be Category Names separated by commas
        // For E.g.: If ‘Jeans’ and ‘Top’ are being shipped and they are respectively listed under 
        // ‘Boys Clothing’ and ‘Girls Tops’ on the Magento Store
        // Package Description = Boys Clothing, Girls Tops
        $categoryName = array();
        $items = $order->getAllVisibleItems();
        foreach($items as $i){
            
            $product = Mage::getModel('catalog/product')->load( $i->getProductId() );

            if(!$product) continue;

            $cats = $product->getCategoryIds();

            foreach ($cats as $category_id) {

                $_cat = Mage::getModel('catalog/category')->load($category_id);
                if($_cat->getid() != 2) $categoryName[$_cat->getid()] = $_cat->getName();

            } 

        }


        // here we will join all collected categories with comma(",")
        $categoryName = implode(',', array_values($categoryName));

        $arr = array();

        $pickup_pincode = Mage::getStoreConfig('general/store_information/pickup_pincode');

        if($pickup_pincode) $arr['pickup_pincode'] = $pickup_pincode;

        $arr['delivery_pincode'] = $order->getShippingAddress()->getPostcode();

        $arr['order_number'] = $order->getIncrementId();

        $arr['payment_mode'] = $payment;

        $arr['insurance'] = false;

        $arr['number_of_package'] = 1;

        $arr['package_details'] = array();

        $arr['package_details']['details'] = array();

        if( $order->getWeight() ) $arr['package_details']['details']['weight'] = (float) $order->getWeight();
        if( $order->getLength() ) $arr['package_details']['details']['length'] = (float) $order->getLength();
        if( $order->getHeight() ) $arr['package_details']['details']['height'] = (float) $order->getHeight();
        if( $order->getWidth() )  $arr['package_details']['details']['width'] = (float) $order->getWidth();

        $arr['package_details']['details']['invoice'] = (float) $grandTotal;

        $arr['package_details']['details']['packagedescription'] = $categoryName;

        $arr['delivery_address'] = array();

        $arr['delivery_address']['contact_name'] = $contact_name;
        $arr['delivery_address']['company_name'] = $contact_name;
        $arr['delivery_address']['address'] = $address;
        $arr['delivery_address']['city'] = $shipping->getCity();
        $arr['delivery_address']['state'] = $shipping->getRegion();
        $arr['delivery_address']['pincode'] = $shipping->getPostcode();
        $arr['delivery_address']['country'] = $shipping->getCountryId();
        $arr['delivery_address']['contact_no'] = $shipping->getTelephone();
        $arr['delivery_address']['email'] = $shipping->getEmail();

        $arr['success_callback_url'] = Mage::getBaseUrl(). 'couriers/index/success';
        $arr['failure_callback_url'] = Mage::getBaseUrl(). 'couriers/index/fail';
        $arr['client_source'] = 'Magento';

        return $arr;

    }



}