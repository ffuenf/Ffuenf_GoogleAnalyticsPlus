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
class Ffuenf_GoogleAnalyticsPlus_Block_OptOut extends Ffuenf_GoogleAnalyticsPlus_Block_Common_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ffuenf/googleanalyticsplus/optout.phtml');
    }

    /**
     * should we include opt out code.
     *
     * @return bool
     */
    public function shouldIncludeOptOut()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus/enableoptoutcookie');
    }

    /**
     * get Google Analytics account id.
     *
     * @return mixed
     */
    public function getAccountId()
    {
        if ($id = Mage::getStoreConfig(Mage_GoogleAnalytics_Helper_Data::XML_PATH_ACCOUNT)) {
            return $id;
        }
        if ($id = Mage::getStoreConfig('google/analyticsplus_universal/accountnumber')) {
            return $id;
        }
    }
}
