<?php

class Logeecom_Laraconnect_Adminhtml_ReferencemanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $referencemanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/referencemanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($referencemanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {

        $lara_url = $this->_getHelper()->getLaraUrl();
        if ($referencemanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$referencemanagerId) {
                $this->_getSession()->addError(
                    $this->__('This referencemanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/referencemanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/references/" . $referencemanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('referencemanagerData')) {
            $postData = $this->_getHelper()->handleImagesUpload($_FILES, $postData);

            try {
                if ($referencemanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/references/update/" . $referencemanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The reference has been edited.')
                    );
                } else {
                    if ($referencemanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/references")) {
                        $referencemanagerObject = json_decode($referencemanagerObject);
                        $referencemanagerId = $referencemanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The reference has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/referencemanager/edit',
                    array('id' => $referencemanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        // Make the current referencemanager object available to blocks.
        Mage::register('current_referencemanager', $rowObj);

        // Instantiate the form container.
        $referencemanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/referencemanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($referencemanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/references/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The reference has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/referencemanager/index'
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
                    ->isAllowed('logeecom_laraconnect/referencemanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('referencemanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select references.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/references/delete/" . $entityId);
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