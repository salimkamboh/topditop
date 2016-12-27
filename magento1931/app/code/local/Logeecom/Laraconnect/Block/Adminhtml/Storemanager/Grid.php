<?php

class Logeecom_Laraconnect_Block_Adminhtml_Storemanager_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $collection = $this->_getHelper()->getRestCollection($lara_url . "api/stores/inactive");
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            'logeecom_laraconnect_admin/storemanager/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'id',
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

        $this->addColumn('user_email', array(
            'header' => $this->_getHelper()->__('User Email'),
            'type' => 'text',
            'index' => 'user_email',
        ));

        $this->addColumn('package_name', array(
            'header' => $this->_getHelper()->__('Package'),
            'type' => 'text',
            'index' => 'package_name',
        ));

        $this->addColumn('status', array(
            'header' => $this->_getHelper()->__('Status'),
            'type' => 'text',
            'index' => 'status',
        ));

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
                        'base' => 'logeecom_laraconnect_admin' . '/storemanager/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'id',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('storemanager');

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