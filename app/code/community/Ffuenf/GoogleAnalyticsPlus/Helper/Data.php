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

class Ffuenf_GoogleAnalyticsPlus_Helper_Data extends Ffuenf_Common_Helper_Core
{
    /**
     * retrieve requested value from order or item
     * convert from base currency if configured
     * else return order currency
     *
     * @param $object
     * @param $field
     *
     * @param $currentCurrency
     *
     * @return string
     */
    public function convert($object, $field, $currentCurrency = null)
    {
        $baseCur = Mage::app()->getStore($object->getStoreId())->getBaseCurrency();
        //getPrice and getFinalPrice do not have base equivalents
        if ($field != 'price' && $field != 'final_price') {
            $field = 'base_' . $field;
            $baseValue = $object->getDataUsingMethod($field);
        } else {
            if (null === $currentCurrency) {
                Mage::throwException('Currency needs to be defined');
            }
            $value = $object->getDataUsingMethod($field);
            if ($currentCurrency == $baseCur->getCode()) {
                $baseValue = $value;
            } else {
                $rate = Mage::getModel('directory/currency')
                    ->load($baseCur->getCode())
                    ->getRate($currentCurrency);
                $baseValue = Mage::app()->getStore()->roundPrice($value / $rate);
            }
        }
        if (!Mage::getStoreConfig('google/analyticsplus/convertcurrencyenabled')) {
            return $baseValue;
        }
        return sprintf(
            '%01.4f', Mage::app()->getStore()->roundPrice(
                $baseCur->convert(
                    $baseValue,
                    Mage::getStoreConfig('google/analyticsplus/convertcurrency')
                )
            )
        );
    }

    /**
     * currency for tracking
     *
     * @param $object
     *
     * @return string
     */
    public function getTrackingCurrency($object)
    {
        if (!Mage::getStoreConfig('google/analyticsplus/convertcurrencyenabled')) {
            return $object->getBaseCurrencyCode();
        } else {
            return Mage::getStoreConfig('google/analyticsplus/convertcurrency');
        }
    }
}
