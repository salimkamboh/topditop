<?php
class Logeecom_Laraconnect_Block_Adminhtml_Fieldgroupmanager_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
    protected function _construct()
    {
        $this->_blockGroup = 'logeecom_laraconnect_adminhtml';
        $this->_controller = 'fieldgroupmanager';

        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Fieldgroup Entry');
    }
}