<?php

class Logeecom_Laraconnect_Block_Adminhtml_Fieldgroupmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        // Instantiate a new form to display our fieldgroupmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/fieldgroupmanager/edit',
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
                'legend' => $this->__('Fieldgroupmanager Details')
            )
        );
        $fieldgroupmanager = Mage::registry('current_fieldgroupmanager');

        $lang = $this->_getHelper()->getLang();

        if ($fieldgroupmanager["id"])
            $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "name"), $lara_url . $lang . "/api/fields/all/free/" . $fieldgroupmanager["id"]);
        else
            $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "name"), $lara_url . $lang . "/api/fields/all/free");

        $selectedFields = $this->_getHelper()->_getSelectedFields($lara_url . $lang . "/api/fieldgroups/" . $fieldgroupmanager["id"]);

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'cssclass' => array(
                'label' => $this->__('CSS Class'),
                'input' => 'text',
                'required' => true,
            ),
            'fields' => array(
                'label' => $this->__('Fields'),
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
        $requestData = new Varien_Object($this->getRequest()->getPost('fieldgroupmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with fieldgroupmanagerData group.
            $_data['name'] = "fieldgroupmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing fieldgroupmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getFieldgroupmanager()->getData($name);
            }

//            // If no new value exists, use the existing fieldgroupmanager data.
//            if (!array_key_exists('value', $_data)) {
//                $_data['value'] = $this->_getFieldgroupmanager()->getData($name);
//            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing fieldgroupmanager for pre-populating the form fields.
     * For a new fieldgroupmanager entry, this will return an empty fieldgroupmanager object.
     */
    protected function _getFieldgroupmanager()
    {
        if (!$this->hasData('fieldgroupmanager')) {
            // This will have been set in the controller.
            $fieldgroupmanager = Mage::registry('current_fieldgroupmanager');

            $this->setData('fieldgroupmanager', $fieldgroupmanager);
        }

        return $this->getData('fieldgroupmanager');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}