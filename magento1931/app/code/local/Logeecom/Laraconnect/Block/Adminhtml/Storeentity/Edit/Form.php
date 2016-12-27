<?php

class Logeecom_Laraconnect_Block_Adminhtml_Storeentity_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our storeentity for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/storeentity/edit',
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
                'legend' => $this->__('Storeentity Details')
            )
        );

        $storeentitySingleton = Mage::getSingleton(
            'logeecom_laraconnect/storeentity'
        );

        $chosenStore = $this->_getStoreentity()->getData('chosenstore');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'chosenstore' => array(
                'label' => $this->__('Select Store'),
                'input' => 'select',
                'required' => true,
                'options' => $storeentitySingleton->getAvailableStores($chosenStore),
            ),
            'storeowner' => array(
                'label' => $this->__('Store Owner'),
                'input' => 'select',
                'required' => true,
                'options' => $storeentitySingleton->getAvailableUsers()
            ),
            'chosenpackage' => array(
                'label' => $this->__('Package'),
                'input' => 'select',
                'required' => true,
                'options' => $storeentitySingleton->getStorePackages(),
            ),
        ));

        return $this;
    }

    /**
     * @param Varien_Data_Form_Element_Fieldset $fieldset
     * @param $fields
     * @return $this
     */
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('storeentityData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with storeentityData group.
            $_data['name'] = "storeentityData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing storeentity data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getStoreentity()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing storeentity for pre-populating the form fields.
     * For a new storeentity entry, this will return an empty storeentity object.
     */
    protected function _getStoreentity()
    {
        if (!$this->hasData('storeentity')) {
            // This will have been set in the controller.
            $storeentity = Mage::registry('current_storeentity');

            // Just in case the controller does not register the storeentity.
            if (!$storeentity instanceof
                Logeecom_Laraconnect_Model_Storeentity
            ) {
                $storeentity = Mage::getModel(
                    'logeecom_laraconnect/storeentity'
                );
            }

            $this->setData('storeentity', $storeentity);
        }

        return $this->getData('storeentity');
    }
}