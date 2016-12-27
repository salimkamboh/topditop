<?php

class Logeecom_Laraconnect_Block_Adminhtml_Storeentity_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {

        /**
         * Tell Magento which collection to use to display in the grid.
         */
        $collection = Mage::getResourceModel('logeecom_laraconnect/storeentity_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * StoreentityController.php in StoreentityDirectory module.
         */
        return $this->getUrl(
            'logeecom_laraconnect_admin/storeentity/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {

        $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
        ));

        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));

        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name',
        ));

        $this->addColumn('storeowner', array(
            'header' => $this->_getHelper()->__('Store Owner Email'),
            'type' => 'text',
            'index' => 'storeowner',
        ));

        $this->addColumn('chosenstore', array(
            'header' => $this->_getHelper()->__('Store ID'),
            'type' => 'number',
            'index' => 'chosenstore',
        ));

        $storeentitySingleton = Mage::getSingleton(
            'logeecom_laraconnect/storeentity'
        );

        /**
         * Finally, we'll add an action column with an edit link.
         */
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'logeecom_laraconnect_admin'
                            . '/storeentity/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'entity_id',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('storeentity');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->_getHelper()->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => $this->_getHelper()->__('Are you sure?')
        ));

        return $this;
    }

    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}