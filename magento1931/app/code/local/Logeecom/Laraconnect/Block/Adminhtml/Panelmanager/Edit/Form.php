<?php

class Logeecom_Laraconnect_Block_Adminhtml_Panelmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        // Instantiate a new form to display our panelmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/panelmanager/edit',
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
                'legend' => $this->__('Panelmanager Details')
            )
        );
        $panelmanager = Mage::registry('current_panelmanager');
        $lang = $this->_getHelper()->getLang();

        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'current_lang' => array(
                'label' => $this->__('Name'),
                'class' => 'current_lang',
                'input' => 'hidden',
                'required' => true,
                'value' => $lang
            ),

            'key' => array(
                'label' => $this->__('Key'),
                'input' => 'text',
                'required' => true,
            ),
        ));

        $fieldset2 = $form->addFieldset(
            'general2',
            array(
                'legend' => $this->__('Panel Fieldgroups')
            )
        );

        $fieldset2->addField('panel_id', 'hidden', array(
            'name' => 'new',
            'class' => 'holder_panel_id',
            'value' => $panelmanager->id
        ));

        $fieldset2->addField('addfieldgroup', 'button', array(
            'name' => 'addfieldgroup',
            'value' => 'Add + ',
            'class' => 'addmore form-button'
        ))->setAfterElementHtml('<script src="' . $lara_url . 'assets/js/lib/jquery.js"></script><script src="' . $lara_url . 'assets/js/configurator.js"></script>');

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('panelmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with panelmanagerData group.
            $_data['name'] = "panelmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing panelmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getPanelmanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing panelmanager for pre-populating the form fields.
     * For a new panelmanager entry, this will return an empty panelmanager object.
     */
    protected function _getPanelmanager()
    {
        if (!$this->hasData('panelmanager')) {
            // This will have been set in the controller.
            $panelmanager = Mage::registry('current_panelmanager');
            $this->setData('panelmanager', $panelmanager);
        }

        return $this->getData('panelmanager');
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}