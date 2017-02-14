<?php

class Logeecom_Laraconnect_Block_Adminhtml_Registerfieldmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our registerfieldmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/registerfieldmanager/edit',
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
                'legend' => $this->__('Registerfieldmanager Details')
            )
        );

        $registerfieldmanager = Mage::registry('current_registerfieldmanager');

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
        ));

        $this->_addFieldsToFieldset($fieldset, array(
            'fieldlocation' => array(
                'label' => $this->__('Location'),
                'input' => 'select',
                'required' => true,
                'options' => array(
                    'Firma' => 'Firma',
                    'Ansprechpartner' => 'Ansprechpartner',
                    'Service' => 'Service'
                ),
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('registerfieldmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with registerfieldmanagerData group.
            $_data['name'] = "registerfieldmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing registerfieldmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getRegisterfieldmanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing registerfieldmanager for pre-populating the form fields.
     * For a new registerfieldmanager entry, this will return an empty registerfieldmanager object.
     */
    protected function _getRegisterfieldmanager()
    {
        if (!$this->hasData('registerfieldmanager')) {
            // This will have been set in the controller.
            $registerfieldmanager = Mage::registry('current_registerfieldmanager');

            $this->setData('registerfieldmanager', $registerfieldmanager);
        }

        return $this->getData('registerfieldmanager');
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}