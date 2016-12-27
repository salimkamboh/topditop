<?php
class Logeecom_Laraconnect_Block_Adminhtml_Advertisements_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
    protected function _construct()
    {
        $this->_blockGroup = 'logeecom_laraconnect_adminhtml';
        $this->_controller = 'advertisements';

        /**
         * The $_mode property tells Magento which folder to use
         * to locate the related form blocks to be displayed in
         * this form container. In our example, this corresponds
         * to Laraconnect/Block/Adminhtml/Advertisements/Edit/.
         */
        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Advertisement Entry');
    }
}