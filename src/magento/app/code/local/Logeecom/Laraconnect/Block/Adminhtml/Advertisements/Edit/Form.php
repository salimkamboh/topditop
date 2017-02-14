<?php

class Logeecom_Laraconnect_Block_Adminhtml_Advertisements_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $lang = $this->_getHelper()->getLang();
        // Instantiate a new form to display our advertisements for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/advertisements/edit',
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
                'legend' => $this->__('Advertisements Details')
            )
        );

        $panelmanager = Mage::registry('current_advertisements');

        $fieldset->addField('name', 'text', array(
            'label' => $this->__('Name'),
            'required' => false,
            'name' => 'name',
        ))->setAfterElementHtml('<a href="' . $lara_url . $lang . '/front/stores/ad/' . $panelmanager->id . '" target="_blank">Ad Preview</a>');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'manufacturer_id' => array(
                'label' => $this->__('Brand'),
                'input' => 'select',
                'required' => true,
                'options' => $this->_getHelper()->_getSelectBoxValues(array("id", "name"), $lara_url . "api/manufacturers/all"),
            ),
        ));

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'scanned_image_url' => array(
                'label' => $this->__('Product Image URL'),
                'input' => 'text',
                'required' => false,
                'name' => 'scanned_image_url'
            )
        ));

        $fieldset->addField('filename_scanned_image_url', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename_scanned_image_url',
        ))->setAfterElementHtml('<br><img style="max-width:300px;height:auto" src="' . $panelmanager->scanned_image_url . '" />');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'brand_logo_url' => array(
                'label' => $this->__('Brand Logo URL'),
                'input' => 'text',
                'required' => false,
                'name' => 'brand_logo_url'
            )
        ));

        $fieldset->addField('filename_brand_logo_url', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename_brand_logo_url',
        ))->setAfterElementHtml('<br><img style="max-width:300px;height:auto" src="' . $panelmanager->brand_logo_url . '" />');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'reference_image_url' => array(
                'label' => $this->__('Reference Image URL'),
                'input' => 'text',
                'required' => false,
                'name' => 'reference_image_url'
            )
        ));

        $fieldset->addField('filename_reference_image_url', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename_reference_image_url',
        ))->setAfterElementHtml('<br><img style="max-width:300px;height:auto" src="' . $panelmanager->reference_image_url . '" />');

        return $this;
    }

    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('advertisementsData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with advertisementsData group.
            $_data['name'] = "advertisementsData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing advertisements data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getAdvertisements()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing advertisements for pre-populating the form fields.
     * For a new advertisements entry, this will return an empty advertisements object.
     */
    protected function _getAdvertisements()
    {
        if (!$this->hasData('advertisements')) {
            // This will have been set in the controller.
            $advertisements = Mage::registry('current_advertisements');

            //print_r($advertisements);exit;
            $this->setData('advertisements', $advertisements);
        }

        return $this->getData('advertisements');
    }


    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}