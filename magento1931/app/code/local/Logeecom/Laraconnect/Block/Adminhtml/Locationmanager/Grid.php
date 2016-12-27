<?php

class Logeecom_Laraconnect_Block_Adminhtml_Locationmanager_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        $locale = Mage::app()->getLocale()->getLocaleCode();
        $lang = substr($locale, 0, 2);
        $collection = $this->_getHelper()->getRestCollection($lara_url . $lang . "/api/locations/all/rest");
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * LocationmanagerController.php in LocationmanagerDirectory module.
         */
        return $this->getUrl(
            'logeecom_laraconnect_admin/locationmanager/edit',
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

        $this->addColumn('latitude', array(
            'header' => $this->_getHelper()->__('Latitude'),
            'type' => 'text',
            'index' => 'latitude',
        ));

        $this->addColumn('longitude', array(
            'header' => $this->_getHelper()->__('Longitude'),
            'type' => 'text',
            'index' => 'longitude',
        ));

        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Location Name'),
            'type' => 'text',
            'index' => 'name',
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
                        'base' => 'logeecom_laraconnect_admin' . '/locationmanager/edit',
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
        $this->getMassactionBlock()->setFormFieldName('locationmanager');

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