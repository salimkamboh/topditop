<?php

class Logeecom_Laraconnect_Adminhtml_FieldgroupmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $fieldgroupmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/fieldgroupmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($fieldgroupmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($fieldgroupmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$fieldgroupmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This fieldgroupmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldgroupmanager/index'
                );
            }
        }

        $lang = $this->_getHelper()->getLang();
        $data = $this->_getHelper()->getRestSingleEntity($lara_url . $lang . "/api/fieldgroups/" . $fieldgroupmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('fieldgroupmanagerData')) {

            try {

                if ($fieldgroupmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . $lang . "/api/fieldgroups/" . $fieldgroupmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The field group has been edited.')
                    );
                } else {
                    if ($fieldgroupmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . $lang . "/api/fieldgroups/")) {
                        $fieldgroupmanagerObject = json_decode($fieldgroupmanagerObject);
                        $fieldgroupmanagerId = $fieldgroupmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The field group has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldgroupmanager/edit',
                    array('id' => $fieldgroupmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current fieldgroupmanager object available to blocks.
        Mage::register('current_fieldgroupmanager', $rowObj);

        // Instantiate the form container.
        $fieldgroupmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/fieldgroupmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($fieldgroupmanagerEditBlock)
            ->renderLayout();

    }

    /**
     *
     */
    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/fieldgroups/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The fieldgroup has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/fieldgroupmanager/index'
        );
    }

    protected function _isAllowed()
    {
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('logeecom_laraconnect/fieldgroupmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('fieldgroupmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select fieldgroup.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/fieldgroups/delete/" . $entityId);
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}