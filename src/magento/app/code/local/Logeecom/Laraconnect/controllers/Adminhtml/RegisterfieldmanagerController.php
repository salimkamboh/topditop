<?php

class Logeecom_Laraconnect_Adminhtml_RegisterfieldmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $registerfieldmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/registerfieldmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($registerfieldmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($registerfieldmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$registerfieldmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This registerfieldmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/registerfieldmanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/registerfields/" . $registerfieldmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('registerfieldmanagerData')) {

            try {

                if ($registerfieldmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/registerfields/" . $registerfieldmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The registerfield has been edited.')
                    );
                } else {
                    if ($registerfieldmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/registerfields")) {
                        $registerfieldmanagerObject = json_decode($registerfieldmanagerObject);
                        $registerfieldmanagerId = $registerfieldmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The registerfield has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/registerfieldmanager/edit',
                    array('id' => $registerfieldmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current registerfieldmanager object available to blocks.
        Mage::register('current_registerfieldmanager', $rowObj);

        // Instantiate the form container.
        $registerfieldmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/registerfieldmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($registerfieldmanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/registerfields/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The register field has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/registerfieldmanager/index'
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
                    ->isAllowed('logeecom_laraconnect/registerfieldmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('registerfieldmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select register fields.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/registerfields/delete/" . $entityId);
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