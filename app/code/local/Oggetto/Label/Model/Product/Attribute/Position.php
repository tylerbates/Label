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
 * Position select model
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage Model
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Label_Model_Product_Attribute_Position extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * Get all options in array
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => 'topleft',
                    'label' => Mage::helper('label')->__('Top left'),
                ),
                array(
                    'value' => 'topright',
                    'label' => Mage::helper('label')->__('Top right'),
                ),
                array(
                    'value' => 'center',
                    'label' => Mage::helper('label')->__('Center'),
                ),
                array(
                    'value' => 'bottomleft',
                    'label' => Mage::helper('label')->__('Bottom left'),
                ),
                array(
                    'value' => 'bottomright',
                    'label' => Mage::helper('label')->__('Bottom right'),
                )
            );
        }
        return $this->_options;
    }

    /**
     * Get all options in array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'topleft',
                'label' => Mage::helper('label')->__('Top left'),
            ),
            array(
                'value' => 'topright',
                'label' => Mage::helper('label')->__('Top right'),
            ),
            array(
                'value' => 'center',
                'label' => Mage::helper('label')->__('Center'),
            ),
            array(
                'value' => 'bottomleft',
                'label' => Mage::helper('label')->__('Bottom left'),
            ),
            array(
                'value' => 'bottomright',
                'label' => Mage::helper('label')->__('Bottom right'),
            )
        );
    }

}