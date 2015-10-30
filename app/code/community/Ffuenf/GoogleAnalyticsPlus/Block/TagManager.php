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
class Ffuenf_GoogleAnalyticsPlus_Block_TagManager extends Ffuenf_GoogleAnalyticsPlus_Block_Common_Abstract
{
    protected  $_order;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ffuenf/googleanalyticsplus/tagmanager.phtml');
    }

    /**
     * should we include the tag manager snippet
     *
     * @return bool
     */
    public function shouldInclude()
    {
        if (parent::shouldInclude()) {
            return $this->isTagManagerEnabled() && (bool)$this->getTagManagerSnippet();
        } else {
            return false;
        }
    }

    /**
     * get tag manager snippet from settings
     *
     * @return string
     */
    public function getTagManagerSnippet()
    {
        return Mage::getStoreConfig('google/analyticsplus_tagmanager/snippet');
    }

    /**
     * get order from the last quote id
     *
     * @return mixed
     */
    protected function _getOrder()
    {
        $quoteId = Mage::getSingleton('checkout/session')->getLastQuoteId();
        if ($quoteId) {
            $this->_order = Mage::getModel('sales/order')->loadByAttribute('quote_id', $quoteId);
        } else {
            $this->_order = false;
        }
        return $this->_order;
    }
}
