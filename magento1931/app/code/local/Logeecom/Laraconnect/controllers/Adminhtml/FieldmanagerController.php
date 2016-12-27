<?php

class Logeecom_Laraconnect_Adminhtml_FieldmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $fieldmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/fieldmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($fieldmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($fieldmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$fieldmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This fieldmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldmanager/index'
                );
            }
        }

        $lang = $this->_getHelper()->getLang();
        $data = $this->_getHelper()->getRestSingleEntity($lara_url . $lang . "/api/fields/" . $fieldmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('fieldmanagerData')) {

            try {

                if ($fieldmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . $lang . "/api/fields/" . $fieldmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The field has been edited.')
                    );
                    return $this->_redirect(
                        'logeecom_laraconnect_admin/fieldmanager/index'
                    );
                } else {
                    if ($fieldmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . $lang . "/api/fields/")) {
                        $fieldmanagerObject = json_decode($fieldmanagerObject);
                        $fieldmanagerId = $fieldmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The field has been saved.')
                        );
                        return $this->_redirect(
                            'logeecom_laraconnect_admin/fieldmanager/index'
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/fieldmanager/edit',
                    array('id' => $fieldmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current fieldmanager object available to blocks.
        Mage::register('current_fieldmanager', $rowObj);

        // Instantiate the form container.
        $fieldmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/fieldmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($fieldmanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/fields/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The field has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/fieldmanager/index'
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
                    ->isAllowed('logeecom_laraconnect/fieldmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('fieldmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select fields.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/fields/delete/" . $entityId);
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