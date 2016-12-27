<?php

class Logeecom_Laraconnect_Block_Adminhtml_Storemanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {

        $lara_url = $this->_getHelper()->getLaraUrl();
        $lang = $this->_getHelper()->getLang();

        // Instantiate a new form to display our storemanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/storemanager/edit',
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
                'legend' => $this->__('Storemanager Details')
            )
        );

        $storemanager = Mage::registry('current_storemanager');
        $userData = $storemanager->registerfields;

        $selectMultiple = array();
        if (is_array($userData)) {
            foreach ($userData as $key => $value) {
                $selectMultiple[] = array(
                    'value' => $key,
                    'label' => $key . ' = ' . $value
                );
            }
        }

        $this->_addFieldsToFieldset($fieldset, array(
            'user_id' => array(
                'label' => $this->__('User ID'),
                'input' => 'text',
                'required' => true,
                'disabled' => true
            ),
            'user_email' => array(
                'label' => $this->__('User Email'),
                'input' => 'text',
                'required' => true,
            ),
            'package_name' => array(
                'label' => $this->__('Package'),
                'input' => 'text',
                'required' => true,
                'disabled' => true
            ),
            'store_name' => array(
                'label' => $this->__('Store Name'),
                'input' => 'text',
                'required' => true,
            ),
            'status' => array(
                'label' => $this->__('Status'),
                'input' => 'select',
                'required' => true,
                'values' => array('-1' => 'Please Select..', '1' => 'Yes', '0' => 'No')
            ),
            'mag_cat_id' => array(
                'label' => $this->__('Select Category'),
                'input' => 'select',
                'required' => true,
                'values' => $this->_getHelper()->getAllCategoriesArray()
            ),
            'location_id' => array(
                'label' => $this->__('Select Location'),
                'input' => 'select',
                'required' => true,
                'values' => $this->_getHelper()->_getSelectBoxValues(array("id", "name"), $lara_url . $lang . "/api/locations/all/rest"),
            ),
            'register_fields' => array(
                'label' => $this->__('Fields and values'),
                'input' => 'multiselect',
                'required' => false,
                'values' => $selectMultiple,
                'editable' => false
            ),
        ));

        $fieldset->addField('filename', 'file', array(
            'label' => $this->__('Select Image'),
            'required' => false,
            'name' => 'filename',
        ))->setAfterElementHtml('<br><img style="width:300px; height:auto; padding:20px 0 0;" src="' . $storemanager->cover_url . '" />');

        return $this;
    }

    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('storemanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with storemanagerData group.
            $_data['name'] = "storemanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing storemanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getStoremanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing storemanager for pre-populating the form fields.
     * For a new storemanager entry, this will return an empty storemanager object.
     */
    protected function _getStoremanager()
    {
        if (!$this->hasData('storemanager')) {
            // This will have been set in the controller.
            $storemanager = Mage::registry('current_storemanager');

            //print_r($storemanager);exit;
            $this->setData('storemanager', $storemanager);
        }

        return $this->getData('storemanager');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}