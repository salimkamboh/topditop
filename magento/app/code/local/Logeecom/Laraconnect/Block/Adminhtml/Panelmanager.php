<?php
class Logeecom_Laraconnect_Block_Adminhtml_Panelmanager
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
        $this->_controller = 'panelmanager';

        /**
         * The title of the page in the admin panel.
         */
        $this->_headerText = Mage::helper('logeecom_laraconnect')->__('Panel Management');

    }

    public function getCreateUrl()
    {
        return $this->getUrl(
            'logeecom_laraconnect_admin/panelmanager/edit'
        );
    }
}