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
class Ffuenf_GoogleAnalyticsPlus_Block_Universal extends Ffuenf_GoogleAnalyticsPlus_Block_GaConversion
{
    const TRACKER_TWO_NAME = 'tracker2';
    const URL_ANALYTICS = '//www.google-analytics.com/analytics.js';
    const URL_ANALYTICS_DEBUG = '//www.google-analytics.com/analytics_debug.js';

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ffuenf/googleanalyticsplus/universal.phtml');
    }

    /**
     * should we include the universal snippet
     *
     * @return bool
     */
    public function shouldInclude()
    {
        if (parent::shouldInclude()) {
            return $this->isUniversalEnabled() && (bool) $this->getUniversalAccount();
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function getUniversalAnonymise()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/anonymise');
    }

    /**
     * @return bool
     */
    public function getEnhancedEcommerce()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/enhancedecommerce');
    }

    /**
     * Build any params that is passed on create of analytics object
     *
     * @param bool $createTrackerTwo
     *
     * @return string
     */
    public function getUniversalParams($createTrackerTwo = false)
    {
        $params = array();
        if (Mage::getStoreConfig('google/analyticsplus_universal/domainname')) {
            $params['cookieDomain'] = Mage::getStoreConfig('google/analyticsplus_universal/domainname');
        }
        if ($this->canUseUniversalUserTracking()) {
            $params['userId'] = $this->getCustomerId();
        }
        if ($createTrackerTwo) {
            $params['name'] = self::TRACKER_TWO_NAME;
        }
        if ($this->canIncludeHash()) {
            $params['allowAnchor'] = true;
        }
        if (count($params) == 0) {
            return "'auto'";
        }
        return json_encode($params);
    }

    /**
     * Enable the Display Advertising Features.
     *
     * @return bool
     */
    public function getUniversalDisplayAdvertising()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/display_advertising');
    }

    /**
     * Return cookiename for Display Advertising
     *
     * @return String
     */
    public function getUniversalDisplayAdvertisingCookieName()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/display_advertising_cookiename');
    }

    /**
     * Is universal user tracking available.
     * Must be enabled in admin and a user must be logged in
     * TODO: Use persistent login data!
     *
     * @return bool
     */
    public function canUseUniversalUserTracking()
    {
        return (Mage::getStoreConfigFlag('google/analyticsplus_universal/userid_tracking')
            && Mage::getSingleton(
                'customer/session'
            )->isLoggedIn()) ? true : false;
    }

    /**
     * Get the current logged in customer id
     *
     * @return mixed bool | integer
     */
    public function getCustomerId()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()
            && is_object(
                Mage::getSingleton('customer/session')->getCustomer()
            )
        ) {
            return Mage::getSingleton('customer/session')->getCustomer()->getId();
        }
        return false;
    }

    /**
     * Get the right analytics.js
     *
     * @return string
     */
    public function getAnalyticsLocation()
    {
        $debug = Mage::getStoreConfigFlag('google/analyticsplus_universal/debug');

        if ($debug) {
            return self::URL_ANALYTICS_DEBUG;
        }

        return self::URL_ANALYTICS;
    }

    /**
     * Get the exclude shipping settings
     *
     * @return bool
     */
    public function shouldExcludeShipping()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/exclude_shipping');
    }

    /**
     * Get the exclude Tax Settings....
     *
     * @return bool
     */
    public function shouldExcludeTax()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/exclude_tax');
    }

    /**
     * Is product tracking available.
     *
     * @return bool
     */
    public function isProductTrackingEnabled()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/product_tracking');
    }

    /**
     * Is cart tracking available.
     *
     * @return bool
     */
    public function isCartTrackingEnabled()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/cart_tracking');
    }

    /**
     * get attribute code for brand.
     *
     * @return string
     */
    public function getBrandAttributeCode()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/brand');
    }

    /**
     * get category product data.
     *
     * @param $product
     *
     * @return Varien_Object
     */
    public function getProductCategoryData($product)
    {
        $categoryData = new Varien_Object();
        if ($catIds = $product->getCategoryIds()) {
            foreach ($catIds as $catId) {
                $category = Mage::getModel('catalog/category')->load($catId);
                if ($category) {
                    //we use the first category
                    $positions = $category->getProductsPosition();
                    $position = isset($positions[$product->getId()]) ? $positions[$product->getId()] : 1;
                    $categoryData->setName($category->getName());
                    $categoryData->setPosition($position);

                    return $categoryData;
                }
            }
        }

        return $categoryData;
    }

    /**
     * get cart items count.
     *
     *
     * @return int
     */
    public function getCartItemsCount()
    {
        $quote = Mage::getModel('checkout/cart')->getQuote();
        $count = $quote->getItemsCount();

        return $count;
    }

    /**
     * get all cart items.
     *
     *
     * @return object
     */
    public function getCartItems()
    {
        $quote = Mage::getModel('checkout/cart')->getQuote();
        $items = $quote->getAllItems();

        return $items;
    }
}
