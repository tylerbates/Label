<?php

/**
 * Oggetto products labels extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Label module to newer versions in the future.
 * If you wish to customize the Oggetto Label module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Label type select model
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage Model
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Label_Model_Product_Attribute_Label extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * Get all options in array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $labels = array();
        $labels[] = array('value' => '0', 'label' => Mage::helper('label')->__('No'));


        if (Mage::getStoreConfig('label/label_group1/label_name1'))
            $labels[] = array('value' => '1', 'label' => Mage::getStoreConfig('label/label_group1/label_name1'));

        if (Mage::getStoreConfig('label/label_group2/label_name2'))
            $labels[] = array('value' => '2', 'label' => Mage::getStoreConfig('label/label_group2/label_name2'));

        if (Mage::getStoreConfig('label/label_group3/label_name3'))
            $labels[] = array('value' => '3', 'label' => Mage::getStoreConfig('label/label_group3/label_name3'));

        if (Mage::getStoreConfig('label/label_group4/label_name4'))
            $labels[] = array('value' => '4', 'label' => Mage::getStoreConfig('label/label_group4/label_name4'));
        $labels[] = array('value' => '5', 'label' => Mage::helper('label')->__('Custom'));
        return $labels;
    }

    /**
     * Get all options in array
     *
     * @return array
     */
    public function getOptionArray()
    {
        $labels = array();
        $labels['0'] = Mage::helper('label')->__('No');


        if (Mage::getStoreConfig('label/label_group1/label_name1'))
            $labels['1'] = Mage::getStoreConfig('label/label_group1/label_name1');

        if (Mage::getStoreConfig('label/label_group2/label_name2'))
            $labels['2'] = Mage::getStoreConfig('label/label_group2/label_name2');

        if (Mage::getStoreConfig('label/label_group3/label_name3'))
            $labels['3'] = Mage::getStoreConfig('label/label_group3/label_name3');

        if (Mage::getStoreConfig('label/label_group4/label_name4'))
            $labels['4'] = Mage::getStoreConfig('label/label_group4/label_name4');

        $labels['5'] = Mage::helper('label')->__('Custom');
        return $labels;
    }

    /**
     * Retrieve option array with empty value
     *
     * @return array
     */
    public function getAllOption()
    {
        $options = self::getOptionArray();
        array_unshift($options, array('value' => '', 'label' => ''));
        return $options;
    }

    public function getAllOptions()
    {
//        $res = array(
//            array(
//                'value' => '',
//                'label' => Mage::helper('catalog')->__('-- Please Select --')
//            )
//        );
        foreach (self::getOptionArray() as $index => $value) {
            $res[$index] = $value;
        }
        return $res;
    }

}