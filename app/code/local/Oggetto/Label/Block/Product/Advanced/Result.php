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
 * @subpackage Block
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Label_Block_Product_Advanced_Result extends Mage_CatalogSearch_Block_Advanced_Result
{

    /**
     * Extends advansed search result block to add label attribute
     */
    protected function _getProductCollection()
    {
        return $this->getSearchModel()->getProductCollection()
            ->addAttributeToSelect('is_label')
            ->addAttributeToSelect('is_enabled_label')
            ->addAttributeToSelect('label_display')
            ->addAttributeToSelect('label_position')
            ->addAttributeToSelect('label_image')
        ;
    }

}
