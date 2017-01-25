<?php
class Logeecom_Laraconnect_Block_Adminhtml_Referencemanager
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        /**
         * The $_blockGroup property tells Magento which alias to use to
         * locate the blocks to be displayed in this grid container.
         * In our example, this corresponds to Laraconnect/Block/Adminhtml.
         */
        $this->_blockGroup = 'logeecom_laraconnect_adminhtml';

        /**
         * $_controller is a slightly confusing name for this property.
         * This value, in fact, refers to the folder containing our
         * Grid.php and Edit.php
         */
        $this->_controller = 'referencemanager';

        /**
         * The title of the page in the admin reference.
         */
        $this->_headerText = Mage::helper('logeecom_laraconnect')->__('Reference Management');

    }

    public function getCreateUrl()
    {
        return $this->getUrl(
            'logeecom_laraconnect_admin/referencemanager/edit'
        );
    }
}