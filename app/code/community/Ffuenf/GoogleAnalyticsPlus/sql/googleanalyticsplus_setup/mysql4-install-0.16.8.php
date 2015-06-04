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
$installer = $this;
$installer->startSetup();

//migrate old config values to new paths
$oldToNewMap = array(
    'domainname' => 'domainname',
    'accountnumber2' => 'accountnumber2',
    'domainname2' => 'domainname2',
    'anonymise' => 'anonymise',
    'remarketing' => 'remarketing',
    'conversionenabled' => 'conversionenabled',
    'conversionid' => 'conversionid',
    'conversionlanguage' => 'conversionlanguage',
    'conversionlabel' => 'conversionlabel',
);

foreach ($oldToNewMap as $old => $new) {
    $installer->run(
        "UPDATE IGNORE {$this->getTable('core_config_data')}
        SET `path`='google/analyticsplus_classic/{$new}' WHERE `path`='google/analyticsplus/{$old}';"
    );
}

$installer->endSetup();
