<?php

class Logeecom_Laraconnect_Block_Adminhtml_Fieldmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        // Instantiate a new form to display our fieldmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/fieldmanager/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Fieldmanager Details')
            )
        );

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'key' => array(
                'label' => $this->__('Key'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'cssclass' => array(
                'label' => $this->__('CSS Class'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'fieldtype_id' => array(
                'label' => $this->__('Field Type'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "name"), $lara_url . "api/fieldtypes/all"),
            ),
        ));

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'values' => array(
                'label' => $this->__('Values (comma separated)'),
                'input' => 'text',
                'required' => false,
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('fieldmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with fieldmanagerData group.
            $_data['name'] = "fieldmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing fieldmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getFieldmanager()->getData($name);
            }
            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing fieldmanager for pre-populating the form fields.
     * For a new fieldmanager entry, this will return an empty fieldmanager object.
     */
    protected function _getFieldmanager()
    {
        if (!$this->hasData('fieldmanager')) {
            // This will have been set in the controller.
            $fieldmanager = Mage::registry('current_fieldmanager');

            //print_r($fieldmanager);exit;
            $this->setData('fieldmanager', $fieldmanager);
        }

        return $this->getData('fieldmanager');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}