<?php

class Logeecom_Laraconnect_Adminhtml_StoremanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $storemanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/storemanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($storemanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($storemanagerId = $this->getRequest()->getParam('id', false)) {
            if (!$storemanagerId) {
                $this->_getSession()->addError(
                    $this->__('This storemanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/storemanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/stores/" . $storemanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('storemanagerData')) {

            try {

                $postData = $this->_getHelper()->handleImageUpload($postData);

                if ($storemanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/stores/activate/" . $storemanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The store has been edited.')
                    );
                } else {
                    if ($storemanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/stores")) {
                        $storemanagerObject = json_decode($storemanagerObject);
                        $storemanagerId = $storemanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The store has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/storemanager/edit',
                    array('id' => $storemanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current storemanager object available to blocks.
        Mage::register('current_storemanager', $rowObj);

        // Instantiate the form container.
        $storemanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/storemanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($storemanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/stores/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The store has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/storemanager/index'
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
                    ->isAllowed('logeecom_laraconnect/storemanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('storemanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select Store Entities.'));
        } else {
            try {

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