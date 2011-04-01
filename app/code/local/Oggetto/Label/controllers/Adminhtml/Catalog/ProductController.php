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
 * Mass action controller
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage controllers
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';

class Oggetto_Label_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{

    /**
     * Mass Label Update
     */
    public function massLabelAction()
    {
        $productIds = (array) $this->getRequest()->getParam('product');
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        $label = (int) $this->getRequest()->getParam('label');
        try {
            Mage::getSingleton('catalog/product_action')
                ->updateAttributes($productIds, array('is_label' => $label), $storeId);

            $this->_getSession()->addSuccess(
                $this->__('Total of %d label(s) have been updated.', count($productIds))
            );
        } catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->__('An error occurred while updating the product(s) label.'));
        }

        $this->_redirect('*/*/', array('store' => $storeId));
    }

}
