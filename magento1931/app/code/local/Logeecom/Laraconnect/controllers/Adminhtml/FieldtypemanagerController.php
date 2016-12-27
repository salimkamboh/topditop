<?php

class Logeecom_Laraconnect_Adminhtml_FieldtypemanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {

        // instantiate the grid container
        $fieldtypemanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/fieldtypemanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($fieldtypemanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($fieldtypemanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$fieldtypemanagerId) {
                $this->_getSession()->addError(
                    $this->__('This fieldtypemanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldtypemanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url."api/fieldtypes/" . $fieldtypemanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('fieldtypemanagerData')) {

            try {

                if ($fieldtypemanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url."api/fieldtypes/" . $fieldtypemanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The fieldtype has been edited.')
                    );
                } else {
                    if ($fieldtypemanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url."api/fieldtypes/")) {
                        $fieldtypemanagerObject = json_decode($fieldtypemanagerObject);
                        $fieldtypemanagerId = $fieldtypemanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The fieldtype has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldtypemanager/edit',
                    array('id' => $fieldtypemanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current fieldtypemanager object available to blocks.
        Mage::register('current_fieldtypemanager', $rowObj);

        // Instantiate the form container.
        $fieldtypemanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/fieldtypemanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($fieldtypemanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/fieldtypes/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The fieldtype has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/fieldtypemanager/index'
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
                    ->isAllowed('logeecom_laraconnect/fieldtypemanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('fieldtypemanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select fieldtypes.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/fieldtypes/delete/" . $entityId);
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}