<?php

/**
 * Fooman GoogleAnalyticsPlus
 *
 * @package   Fooman_GoogleAnalyticsPlus
 * @author    Kristof Ringleff <kristof@fooman.co.nz>
 * @copyright Copyright (c) 2010 Fooman Limited (http://www.fooman.co.nz)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Fooman_GoogleAnalyticsPlus_Block_Universal extends Fooman_GoogleAnalyticsPlus_Block_GaConversion
{
    const TRACKER_TWO_NAME = 'tracker2';

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('fooman/googleanalyticsplus/universal.phtml');
    }

    /**
     * should we include the universal snippet
     *
     * @return bool
     */
    public function shouldInclude()
    {
        if (parent::shouldInclude()) {
            return $this->isUniversalEnabled() && (bool)$this->getUniversalAccount();
        } else {
            return false;
        }
    }

    /**
     * get universal snippet from settings
     *
     * @deprecated since 0.14.0
     * @return string
     */
    public function getUniversalSnippet()
    {
        return '';
    }


    /**
     * @return bool
     */
    public function getUniversalAnonymise()
    {
        return Mage::getStoreConfigFlag('google/analyticsplus_universal/anonymise');
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

    public function canIncludeHash()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/includehash');
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
     * Is product tracking available
     *
     * @return boolean
     */
    public function isProductTrackingEnabled()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/product_tracking');
    }

    /**
     * Is cart tracking available
     *
     * @return boolean
     */
    public function isCartTrackingEnabled()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/cart_tracking');
    }

    /**
     * get attribute code for brand
     *
     * @return string
     */
    public function getBrandAttributeCode()
    {
        return Mage::getStoreConfig('google/analyticsplus_universal/brand');
    }

    /**
     * get category product data
     *
     * @param $product
     *
     * @return array
     */
    public function getProductCategoryData($product)
    {
        $categoryData = new Varien_Object();
        if ( $catIds = $product->getCategoryIds() ) {
            foreach($catIds as $catId) {
                $category = Mage::getModel('catalog/category')->load($catId);
                if ( $category ) {
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
     * get cart items count
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
     * get all cart items
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
