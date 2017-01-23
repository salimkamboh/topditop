<?php

class Logeecom_Laraconnect_Block_Adminhtml_Fieldtypemanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our fieldtypemanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/fieldtypemanager/edit',
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
                'legend' => $this->__('Fieldtypemanager Details')
            )
        );

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('fieldtypemanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with fieldtypemanagerData group.
            $_data['name'] = "fieldtypemanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing fieldtypemanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getFieldtypemanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing fieldtypemanager for pre-populating the form fields.
     * For a new fieldtypemanager entry, this will return an empty fieldtypemanager object.
     */
    protected function _getFieldtypemanager()
    {
        if (!$this->hasData('fieldtypemanager')) {
            // This will have been set in the controller.
            $fieldtypemanager = Mage::registry('current_fieldtypemanager');

            $this->setData('fieldtypemanager', $fieldtypemanager);
        }

        return $this->getData('fieldtypemanager');
    }
}