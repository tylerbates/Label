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
 * Extend default Magento Grid Block
 * to add new mass-attribute to a grid
 * 
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage Block
 * @since      Class available since module release 2.0
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Label_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{

    /**
     * Add label selection to collection
     *
     * @return object
     */
    protected function _prepareCollection()
    {
        $store = $this->_getStore();
        $collection = Mage::getModel('catalog/product')->getCollection()
                        ->addAttributeToSelect('sku')
                        ->addAttributeToSelect('name')
                        ->addAttributeToSelect('attribute_set_id')
                        ->addAttributeToSelect('type_id')
                        ->addAttributeToSelect('is_label')
                        ->joinField('qty',
                                'cataloginventory/stock_item',
                                'qty',
                                'product_id=entity_id',
                                '{{table}}.stock_id=1',
                                'left');

        if ($store->getId()) {
            $collection->setStoreId($store->getId());
            $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
            $collection->addStoreFilter($store);
            $collection->joinAttribute('name', 'catalog_product/name', 'entity_id', null, 'inner', $adminStore);
            $collection->joinAttribute('custom_name', 'catalog_product/name', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('price', 'catalog_product/price', 'entity_id', null, 'left', $store->getId());
            $collection->joinAttribute('is_label', 'attribute/Product_Attribute_Label', 'entity_id', null, 'left', $store->getId());
        } else {
            $collection->addAttributeToSelect('price');
            $collection->addAttributeToSelect('status');
            $collection->addAttributeToSelect('visibility');
        }
        $this->setCollection($collection);

        Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
        $this->getCollection()->addWebsiteNamesToResult();
        return $this;
    }

    /**
     *  Add label change massaction
     *
     * @return object
     */
    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();

        $labels = Mage::getSingleton('attribute/Product_Attribute_Label')->toOptionArray();
        $this->getMassactionBlock()->addItem('label', array(
            'label' => Mage::helper('label')->__('Change label'),
            'url' => $this->getUrl('*/*/massLabel', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'label',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('label')->__('Label'),
                    'values' => $labels
                )
            )
        ));
        return $this;
    }

    /**
     * Add label column to product grid
     *
     * @return object
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumnAfter('label',
                array(
                    'header' => Mage::helper('label')->__('Label'),
                    'width' => '100px',
                    'sortable' => true,
                    'index' => 'is_label',
                    'type' => 'options',
                    'position' => '1',
                    'options' => Mage::getSingleton('attribute/Product_Attribute_Label')->getAllOptions(),
                ), 'status');
        return parent::_prepareColumns();
    }

}
