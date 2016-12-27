<?php

class Logeecom_Laraconnect_Adminhtml_PackagemanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $packagemanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/packagemanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($packagemanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($packagemanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$packagemanagerId) {
                $this->_getSession()->addError(
                    $this->__('This packagemanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/packagemanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/packages/" . $packagemanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('packagemanagerData')) {

            try {

                if ($packagemanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/packages/" . $packagemanagerId);

                    $this->_getSession()->addSuccess(
                        $this->__('The package has been edited.')
                    );
                } else {
                    if ($packagemanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/packages")) {
                        $packagemanagerObject = json_decode($packagemanagerObject);
                        $packagemanagerId = $packagemanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The package has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/packagemanager/edit',
                    array('id' => $packagemanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current packagemanager object available to blocks.
        Mage::register('current_packagemanager', $rowObj);

        // Instantiate the form container.
        $packagemanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/packagemanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($packagemanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/packages/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The package has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/packagemanager/index'
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
                    ->isAllowed('logeecom_laraconnect/packagemanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('packagemanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select packages.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/packages/delete/" . $entityId);
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