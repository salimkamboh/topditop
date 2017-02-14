<?php

class Logeecom_Laraconnect_Block_Adminhtml_Productmanager_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        // Instantiate a new form to display our productmanager for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'logeecom_laraconnect_admin/productmanager/edit',
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
                'legend' => $this->__('Productmanager Details')
            )
        );

        $productmanager = Mage::registry('current_productmanager');

        if ($productmanager["id"]) {
            $selectedReferences = $this->_getHelper()->_getSelectedProducts($lara_url . "api/products/" . $productmanager["id"] . "/references");
            $selectedCategories = $this->_getHelper()->_getSelectedProducts($lara_url . "api/products/" . $productmanager["id"] . "/categories");
        } else {
            $selectedReferences = '';
            $selectedCategories = '';
        }

        $multiSelectBox = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "title"), $lara_url . "api/references/all");
        $multiSelectBoxCategories = $this->_getHelper()->_getMultiSelectBoxValues(array("id", "name"), $lara_url . "api/categories/all");
        $storeList = $this->_getHelper()->_getSelectBoxValues(array("id", "store_name"), $lara_url . "api/stores/all");
        $selectBoxManufacturers = $this->_getHelper()->_getSelectBoxValues(array("id", "name"), $lara_url . "api/manufacturers/all");

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
            'price' => array(
                'label' => $this->__('Price'),
                'input' => 'text',
                'required' => true,
            ),
            'store_id' => array(
                'label' => $this->__('Store'),
                'input' => 'select',
                'required' => true,
                'values' => $storeList
            ),
            'references' => array(
                'label' => $this->__('References'),
                'input' => 'multiselect',
                'required' => true,
                'values' => $multiSelectBox,
                'value' => $selectedReferences
            ),
            'categories' => array(
                'label' => $this->__('Categories'),
                'input' => 'multiselect',
                'required' => true,
                'values' => $multiSelectBoxCategories,
                'value' => $selectedCategories
            ),
            'manufacturer_id' => array(
                'label' => $this->__('Manufacturer'),
                'input' => 'select',
                'required' => true,
                'values' => $selectBoxManufacturers,
            ),
        ));

        $fieldset2 = $form->addFieldset(
            'general2',
            array(
                'legend' => $this->__('Product Images')
            )
        );

        $fieldset2->addField('product_id', 'hidden', array(
            'name' => 'new',
            'class' => 'holder_product_id',
            'value' => $productmanager->id
        ));

        $fieldset2->addField('addimage', 'label', array(
            'name' => 'addimage',
            'value' => 'Add Image +',
            'class' => 'addmore'
        ))->setAfterElementHtml('<div>
<input id="image_upload" name="image_upload[]" type="file" class="input-file" multiple></div>
<div class="products-holder-all"></div><script src="' . $lara_url . 'assets/js/lib/jquery.js"></script>
<script src="' . $lara_url . 'assets/js/edit-product-admin.js"></script>');

//        if ($productmanager->id == "") {
//            $fieldset2->addField('saveit', 'button', array(
//                'name' => 'saveit',
//                'value' => 'Save',
//                'class' => 'saveit'
//            ));
//        } else {
//            $fieldset2->addField('editPanel', 'button', array(
//                'name' => 'editPanel',
//                'value' => 'Edit Product',
//                'class' => 'editit'
//            ));
//        }

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('productmanagerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with productmanagerData group.
            $_data['name'] = "productmanagerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing productmanager data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getProductmanager()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }
        return $this;
    }

    /**
     * Retrieve the existing productmanager for pre-populating the form fields.
     * For a new productmanager entry, this will return an empty productmanager object.
     */
    protected function _getProductmanager()
    {
        if (!$this->hasData('productmanager')) {
            // This will have been set in the controller.
            $productmanager = Mage::registry('current_productmanager');

            $this->setData('productmanager', $productmanager);
        }

        return $this->getData('productmanager');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}