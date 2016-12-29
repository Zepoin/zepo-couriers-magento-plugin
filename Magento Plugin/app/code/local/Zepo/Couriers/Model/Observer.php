<?php

class Zepo_Couriers_Model_Observer extends Varien_Event_Observer {

    /**
     * Adds column to admin customers grid
     *
     * @param Varien_Event_Observer $observer
     */
    public function appendSalesGridColumn(Varien_Event_Observer $observer) {

        $block = $observer->getBlock();

        if (!isset($block)) {
            return $this;
        }

        if ($block->getType() == 'adminhtml/sales_order_grid') {

            $block->addColumnAfter('courier', array(
                'header'    => Mage::helper('sales')->__('Courier'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'renderer'  => 'Zepo_Couriers_Model_Rendor',
                'is_system' => true,
            ), 'action');

        }
    }

}

?>
