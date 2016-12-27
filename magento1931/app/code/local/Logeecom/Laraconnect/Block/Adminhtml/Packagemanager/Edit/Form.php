<?php

class Logeecom_Laraconnect_Block_Adminhtml_Packagemanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        // Instantiate a new form to display our packagemanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/packagemanager/edit',
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
                'legend' => $this->__('Packagemanager Details')
            )
        );

        $packagemanager = Mage::registry('current_packagemanager');

        if ($packagemanager["id"])
            $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "key"), $lara_url . "api/panels/all");
        else
            $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "key"), $lara_url . "api/panels/all");

        $selectedFields = $this->_getHelper()->_getSelectedPanels($lara_url . "api/panels/package/" . $packagemanager["id"]);

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'panels' => array(
                'label' => $this->__('Panels'),
                'input' => 'multiselect',
                'required' => true,
                'values' => $multiSelectBox,
                'value' => $selectedFields
            ),
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('packagemanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with packagemanagerData group.
            $_data['name'] = "packagemanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing packagemanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getPackagemanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing packagemanager for pre-populating the form fields.
     * For a new packagemanager entry, this will return an empty packagemanager object.
     */
    protected function _getPackagemanager()
    {
        if (!$this->hasData('packagemanager')) {
            // This will have been set in the controller.
            $packagemanager = Mage::registry('current_packagemanager');

            //print_r($packagemanager);exit;
            $this->setData('packagemanager', $packagemanager);
        }

        return $this->getData('packagemanager');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}