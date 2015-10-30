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
class Ffuenf_GoogleAnalyticsPlus_Model_Source_Productattribute
{
    public function toOptionArray()
    {
        $options = array();
        $collection = Mage::getResourceModel('catalog/product_attribute_collection');
        $options[] = array(
            'value' => '',
            'label' => ''
        );
        $options[] = array(
                'value' => 'entity_id',
                'label' => 'Entity Id'
        );
        foreach ($collection as $attribute) {
            $options[] = array(
                'value' => $attribute->getAttributeCode(),
                'label' => ($attribute->getFrontendLabel() ? $attribute->getFrontendLabel()
                        : $attribute->getAttributeCode())
            );
        }

        return $options;
    }
}
