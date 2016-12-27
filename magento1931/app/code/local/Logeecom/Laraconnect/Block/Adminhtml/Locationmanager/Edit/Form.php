<?php

class Logeecom_Laraconnect_Block_Adminhtml_Locationmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our locationmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/locationmanager/edit',
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

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Locationmanager Details')
            )
        );

        $this->_addFieldsToFieldset($fieldset, array(
            'key' => array(
                'label' => $this->__('Key'),
                'input' => 'text',
                'required' => true,
            ),
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'latitude' => array(
                'label' => $this->__('Latitude'),
                'input' => 'text',
                'required' => true,
            ),
            'longitude' => array(
                'label' => $this->__('Longitude'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('locationmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with locationmanagerData group.
            $_data['name'] = "locationmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing locationmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getLocationmanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing locationmanager for pre-populating the form fields.
     * For a new locationmanager entry, this will return an empty locationmanager object.
     */
    protected function _getLocationmanager()
    {
        if (!$this->hasData('locationmanager')) {
            // This will have been set in the controller.
            $locationmanager = Mage::registry('current_locationmanager');

            $this->setData('locationmanager', $locationmanager);
        }

        return $this->getData('locationmanager');
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}