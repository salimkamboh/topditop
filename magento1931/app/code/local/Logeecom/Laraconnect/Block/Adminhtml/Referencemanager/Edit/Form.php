<?php

class Logeecom_Laraconnect_Block_Adminhtml_Referencemanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        // Instantiate a new form to display our referencemanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/referencemanager/edit',
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
                'legend' => $this->__('Referencemanager Details')
            )
        );
        $referencemanager = Mage::registry('current_referencemanager');

        if ($referencemanager["id"]) {
            $selectedManufacturers = $this->_getHelper()->_getSelectedProducts($lara_url . "api/references/" . $referencemanager["id"] . "/manufacturers");
            $selectedProducts = $this->_getHelper()->_getSelectedProducts($lara_url . "api/references/" . $referencemanager["id"] . "/products");
        } else {
            $selectedManufacturers = '';
            $selectedProducts = '';
        }

        $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "title"), $lara_url . "api/products");
        $storeList = $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all");
        $multiSelectBoxManufacturers = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "name"), $lara_url . "api/manufacturers/all");

        $this->_addFieldsToFieldset($fieldset, array(
            'title' => array(
                'label' => $this->__('Title'),
                'input' => 'text',
                'required' => true,
            ),
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),
            'video' => array(
                'label' => $this->__('Video'),
                'input' => 'text',
                'required' => true,
            ),
            'store_id' => array(
                'label' => $this->__('Store'),
                'input' => 'select',
                'required' => true,
                'values' => $storeList
            ),
            'products' => array(
                'label' => $this->__('Products'),
                'input' => 'multiselect',
                'required' => true,
                'values' => $multiSelectBox,
                'value' => $selectedProducts
            ),
            'manufacturers' => array(
                'label' => $this->__('Manufacturers'),
                'input' => 'multiselect',
                'required' => true,
                'values' => $multiSelectBoxManufacturers,
                'value' => $selectedManufacturers
            ),
        ));

        $fieldset2 = $form->addFieldset(
            'general2',
            array(
                'legend' => $this->__('Reference Images')
            )
        );

        $fieldset2->addField('reference_id', 'hidden', array(
            'name' => 'new',
            'class' => 'holder_reference_id',
            'value' => $referencemanager->id
        ));

        $fieldset2->addField('addimage', 'label', array(
            'name' => 'addimage',
            'value' => 'Add Image +',
            'class' => 'addmore'
        ))->setAfterElementHtml('<div><input id="image_upload" name="image_upload[]" type="file" class="input-file" multiple></div>
<div class="image-holder-all"></div><script src="' . $lara_url . 'assets/js/lib/jquery.js"></script>
<script src="' . $lara_url . 'assets/js/edit-ref-admin.js"></script>');
//
//        if ($referencemanager->id == "") {
//            $fieldset2->addField('saveit', 'button', array(
//                'name' => 'saveit',
//                'value' => 'Save',
//                'class' => 'saveit'
//            ));
//        } else {
//            $fieldset2->addField('editPanel', 'button', array(
//                'name' => 'editPanel',
//                'value' => 'Edit Reference',
//                'class' => 'editit'
//            ));
//        }

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('referencemanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with referencemanagerData group.
            $_data['name'] = "referencemanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing referencemanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getReferencemanager()->getData($name);
            }

//            // If no new value exists, use the existing referencemanager data.
//            if (!array_key_exists('value', $_data)) {
//                $_data['value'] = $this->_getReferencemanager()->getData($name);
//            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing referencemanager for pre-populating the form fields.
     * For a new referencemanager entry, this will return an empty referencemanager object.
     */
    protected function _getReferencemanager()
    {
        if (!$this->hasData('referencemanager')) {
            // This will have been set in the controller.
            $referencemanager = Mage::registry('current_referencemanager');

//            // Just in case the controller does not register the referencemanager.
//            if (!$referencemanager instanceof
//                Logeecom_Laraconnect_Model_Referencemanager
//            ) {
//                $referencemanager = Mage::getModel(
//                    'logeecom_laraconnect/referencemanager'
//                );
//            }

            $this->setData('referencemanager', $referencemanager);
        }

        return $this->getData('referencemanager');
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}