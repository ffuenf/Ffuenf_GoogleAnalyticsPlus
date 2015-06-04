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
class Ffuenf_GoogleAnalyticsPlus_Model_Backend_Accountnumber extends Mage_Core_Model_Config_Data
{
    protected function _beforeSave()
    {
        $data = $this->getData();
        $analyticsAccount = $data['groups']['analytics']['fields']['account']['value'];
        $analyticsPlusAccount = $data['groups']['analyticsplus_classic']['fields']['accountnumber2']['value'];
        if (!empty($analyticsPlusAccount) && !empty($analyticsAccount) && $analyticsAccount == $analyticsPlusAccount) {
            throw Mage::exception(
                'Mage_Core', Mage::helper('adminhtml')->__(
                    'Your alternative account number needs to be different to your existing account number.'
                )
            );
        }

        return true;
    }
}
