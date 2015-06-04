<?php

/**
 * Ffuenf_GoogleAnalyticsPlus extension.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category   Ffuenf
 *
 * @author     Achim Rosenhagen <a.rosenhagen@ffuenf.de>
 * @copyright  Copyright (c) 2015 ffuenf (http://www.ffuenf.de)
 * @license    http://opensource.org/licenses/mit-license.php MIT License
 */
class Ffuenf_GoogleAnalyticsPlus_Model_Observer
{
    public function addCheckoutStepTracking($observer)
    {
        $block = $observer->getEvent()->getBlock();
        $transport = $observer->getEvent()->getTransport();
        if ($block instanceof Mage_Checkout_Block_Onepage_Billing) {
            $origBlockContent = $transport->getHtml();
            $trackingJs = $block->getLayout()->createBlock('googleanalyticsplus/ajax')->toHtml();
            $transport->setHtml($trackingJs . $origBlockContent);
        }
    }

    public function setOrder($observer)
    {
        Mage::register('googleanalyticsplus_order_ids', $observer->getEvent()->getOrderIds(), true);
    }
}
