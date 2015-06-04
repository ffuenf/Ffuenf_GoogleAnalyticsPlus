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
class Ffuenf_GoogleAnalyticsPlus_Block_Ajax extends Ffuenf_GoogleAnalyticsPlus_Block_Common_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ffuenf/googleanalyticsplus/ajax-tracking.phtml');
    }
}
