<?php

class Logeecom_Laraconnect_Block_Adminhtml_Slidemanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        // Instantiate a new form to display our slidemanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/slidemanager/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        $slidemanager = Mage::registry('current_slidemanager');

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Slidemanager Details')
            )
        );

        $this->_addFieldsToFieldset($fieldset, array(
            'title' => array(
                'label' => $this->__('Title'),
                'input' => 'text',
                'required' => true,
            ),
            'image_url' => array(
                'label' => $this->__('Image URL'),
                'input' => 'text',
                'required' => false,
                'disabled' => true
            ),

            'slot1_store_id' => array(
                'label' => $this->__('Slot 1 Store ID'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all"),
            ),
            'slot1_width' => array(
                'label' => $this->__('Slot 1 Width (%)'),
                'input' => 'text',
                'required' => false,
            ),
            'slot1_valid_until' => array(
                'label' => $this->__('Slot 1 Expiration Date'),
                'input' => 'datetime',
                'type' => 'datetime',
                'time' => true,
                'required' => true,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ),

            'slot2_store_id' => array(
                'label' => $this->__('Slot 2 Store ID'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all"),
            ),
            'slot2_width' => array(
                'label' => $this->__('Slot 2 Width (%)'),
                'input' => 'text',
                'required' => false,
            ),
            'slot2_valid_until' => array(
                'label' => $this->__('Slot 2 Expiration Date'),
                'input' => 'datetime',
                'type' => 'datetime',
                'time' => true,
                'required' => true,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ),

            'slot3_store_id' => array(
                'label' => $this->__('Slot 3 Store ID'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all"),
            ),
            'slot3_width' => array(
                'label' => $this->__('Slot 3 Width (%)'),
                'input' => 'text',
                'required' => false,
            ),
            'slot3_valid_until' => array(
                'label' => $this->__('Slot 3 Expiration Date'),
                'input' => 'datetime',
                'type' => 'datetime',
                'time' => true,
                'required' => true,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ),

            'slot4_store_id' => array(
                'label' => $this->__('Slot 4 Store ID'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all"),
            ),
            'slot4_width' => array(
                'label' => $this->__('Slot 4 Width (%)'),
                'input' => 'text',
                'required' => false,
            ),
            'slot4_valid_until' => array(
                'label' => $this->__('Slot 4 Expiration Date'),
                'input' => 'datetime',
                'type' => 'datetime',
                'time' => true,
                'required' => true,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ),

            'slot5_store_id' => array(
                'label' => $this->__('Slot 5 Store ID'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all"),
            ),
            'slot5_width' => array(
                'label' => $this->__('Slot 5 Width (%)'),
                'input' => 'text',
                'required' => false,
            ),
            'slot5_valid_until' => array(
                'label' => $this->__('Slot 5 Expiration Date'),
                'input' => 'datetime',
                'type' => 'datetime',
                'time' => true,
                'required' => true,
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ),
        ));

        $fieldset->addField('filename', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename',
        ))->setAfterElementHtml('<br><img src="' . $slidemanager->image_url . '" />');

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('slidemanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with slidemanagerData group.
            $_data['name'] = "slidemanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing slidemanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getSlidemanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing slidemanager for pre-populating the form fields.
     * For a new slidemanager entry, this will return an empty slidemanager object.
     */
    protected function _getSlidemanager()
    {
        if (!$this->hasData('slidemanager')) {
            // This will have been set in the controller.
            $slidemanager = Mage::registry('current_slidemanager');

            $this->setData('slidemanager', $slidemanager);
        }

        return $this->getData('slidemanager');
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}