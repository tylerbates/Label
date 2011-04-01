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
 * Extends advansed search result block to add label attribute
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage Helper
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Label_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Label position
     *
     * @var string
     */
    protected $_position;

    /**
     * Product entity
     *
     * @var Mage_Eav_Model_Entity_Product
     */
    protected $_product;

    /**
     * Lable image size
     *
     * @var int
     */
    protected $_size;

    /**
     * Label image
     *
     * @var string
     */
    protected $_image;

    /**
     * Current page type
     *
     * @var string
     */
    protected $_page;

    /**
     * Label type
     *
     * @var int
     */
    protected $_labeltype;

    /**
     * Is label displayed
     *
     * @var bool
     */
    protected $_display;

    /**
     * Label html
     *
     * @var string
     */
    protected $_label;

    /**
     * Is label need to be shown
     * 
     * @var int
     */
    protected $_show = 0;

    /**
     * Returns label if it is
     *
     * @param object $product product we working with
     * @param text $page category/product
     * @param int $size
     * @return text
     */
    public function getLabel($product, $page, $size)
    {
        $this->_labeltype = $product->getIsLabel();
        $this->_product = $product;
        $this->_page = $page;
        $this->_size = $size;
        switch ($this->_labeltype) {
            case 0:
                return;
                break;
            case 5:
                $this->getCustomLabel();
                break;
            default :
                $this->getDefaultLabel();
                break;
        }
        $this->toShow();
        $this->returnLabel();
        return $this->_label;
    }

    /**
     *  Get custom label
     */
    public function getCustomLabel()
    {
        $this->_display = $this->_product->getLabelDisplay();
        $this->setPosition($this->_product->getLabelPosition());

        //check did admin set the custom image
        if ($this->_product->getLabelImage())
            $this->getImage($this->_product->getLabelImage());
        else
            $this->_image = 0;
    }

    /**
     * Get one of default labels
     */
    public function getDefaultLabel()
    {
        $this->_display = Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_display' . $this->_labeltype);
        $this->setPosition(Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_position' . $this->_labeltype));
        $this->getImage(Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_image' . $this->_labeltype));
    }

    /**
     * Set label position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        switch ($position) {
            case 'topleft':
                $this->_position = "top left";
                break;
            case 'topright':
                $this->_position = "top right";
                break;
            case 'center':
                $this->_position = "center center";
                break;
            case 'bottomleft':
                $this->_position = "bottom left";
                break;
            case 'bottomright':
                $this->_position = "bottom right";
                break;
        }
    }

    /**
     * Return label image
     *
     * @param string $image
     */
    public function getImage($image)
    {
        if ($this->_page == 'category')
            $this->_image = Mage::helper('catalog/image')->init($this->_product, 'thumbnail', $image)
                            ->constrainOnly(TRUE)
                            ->keepAspectRatio(TRUE)
                            ->keepFrame(FALSE)
                            ->resize(60);
        else
            $this->_image = Mage::helper('catalog/image')->init($this->_product, 'thumbnail', $image);
    }

    /**
     * Return full label code
     */
    public function returnLabel()
    {
        if ($this->_show && $this->_image)
            $this->_label = '<div class="product-img-label" style="position:absolute; height:' .
                    $this->_size . 'px; width: ' .
                    $this->_size . 'px; top:12px; left:10px; z-index: 70; pointer-events: none;background: url(\'' .
                    $this->_image . '\') ' . $this->_position . ' no-repeat"></div>';
        else
            $this->_label = null;
    }

    /**
     * Check should we show label or not
     */

    public function toShow()
    {
        if ($this->_display == 1 || $this->_display == 3 && $this->_page == 'category')
            $this->_show = 1;
        elseif ($this->_display == 1 || $this->_display == 2 && $this->_page == 'product')
            $this->_show = 1;
        else
            $this->_show = 0;
    }

}
