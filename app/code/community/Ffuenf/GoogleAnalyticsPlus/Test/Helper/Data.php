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
class Ffuenf_GoogleAnalyticsPlus_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Tests whether Convert Currency is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_GaConversion::isConvertCurrencyEnabled
     */
    public function testIsConvertCurrencyEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_GaConversion();
        $this->assertTrue(
            $block->isConvertCurrencyEnabled(),
            'Convert Currency is not enabled please check config'
        );
    }
    /**
     * Tests whether Adwords Conversion is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_GaConversion::isEnabled
     */
    public function testIsAdwordsConversionEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_GaConversion();
        $this->assertTrue(
            $block->isEnabled(),
            'Adwords Conversion is not enabled please check config'
        );
    }
    /**
     * Tests whether Universal Analytics is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_Universal::isUniversalEnabled
     */
    public function testIsUniversalEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_Universal();
        $this->assertTrue(
            $block->isUniversalEnabled(),
            'Universal Analytics is not enabled please check config'
        );
    }
    /**
     * Tests whether TagManager is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_TagManager::isTagManagerEnabled
     */
    public function testIsTagManagerEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_TagManager();
        $this->assertTrue(
            $block->isTagManagerEnabled(),
            'Universal Analytics is not enabled please check config'
        );
    }
    /**
     * Tests whether Dynamic Remarketing is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_Remarketing::isDynamicRemarketingEnabled
     */
    public function testIsDynamicRemarketingEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_Remarketing();
        $this->assertTrue(
            $block->isDynamicRemarketingEnabled(),
            'Dynamic Remarketing is not enabled please check config'
        );
    }
    /**
     * Tests whether Enhanced Commerce is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_Universal::getEnhancedEcommerce
     */
    public function testIsEnhancedCommerceEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_Universal();
        $this->assertTrue(
            $block->getEnhancedEcommerce(),
            'Enhanced Commerce is not enabled please check config'
        );
    }
    /**
     * Tests whether the OptOut Cookie is enabled.
     *
     * @test
     * @loadFixture
     * @covers Ffuenf_GoogleAnalyticsPlus_Block_OptOut::shouldIncludeOptOut
     */
    public function testIsOptOutEnabled()
    {
        $block = new Ffuenf_GoogleAnalyticsPlus_Block_OptOut();
        $this->assertTrue(
            $block->shouldIncludeOptOut(),
            'OptOut Cookie is not enabled please check config'
        );
    }
}
