<?php

class Logeecom_Laraconnect_Block_Adminhtml_Manufacturers_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our manufacturers for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/manufacturers/edit',
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
                'legend' => $this->__('Manufacturers Details')
            )
        );
        $manufacturer = Mage::registry('current_manufacturers');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'image_url' => array(
                'label' => $this->__('Image URL'),
                'input' => 'text',
                'required' => false,
                'disabled' => true
            ),
            'featured' => array(
                'label' => $this->__('Featured'),
                'input' => 'checkbox',
                'required' => false,
                'checked' => $manufacturer['featured'],
                'onclick' => 'this.value = this.checked ? 1 : 0;',
            ),
        ));

        $fieldset->addField('filename', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename',
        ))->setAfterElementHtml('<br><img src="' . $manufacturer->image_url . '" />');

        return $this;
    }

    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('manufacturersData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with manufacturersData group.
            $_data['name'] = "manufacturersData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing manufacturers data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getManufacturers()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing manufacturers for pre-populating the form fields.
     * For a new manufacturers entry, this will return an empty manufacturers object.
     */
    protected function _getManufacturers()
    {
        if (!$this->hasData('manufacturers')) {
            // This will have been set in the controller.
            $manufacturers = Mage::registry('current_manufacturers');

            //print_r($manufacturers);exit;
            $this->setData('manufacturers', $manufacturers);
        }

        return $this->getData('manufacturers');
    }
}