<?php

class Logeecom_Laraconnect_Adminhtml_ProductmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $productmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/productmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($productmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($productmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$productmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This productmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/productmanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/products/" . $productmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('productmanagerData')) {
            $postData = $this->_getHelper()->handleImagesUpload($_FILES, $postData);

            try {
                if ($productmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/products/update/" . $productmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The product has been edited.')
                    );
                } else {
                    if ($productmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/products")) {
                        $productmanagerObject = json_decode($productmanagerObject);
                        $productmanagerId = $productmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The product has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/productmanager/edit',
                    array('id' => $productmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        // Make the current productmanager object available to blocks.
        Mage::register('current_productmanager', $rowObj);

        // Instantiate the form container.
        $productmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/productmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($productmanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $fieldmanagerId = $this->getRequest()->getParam('id', false);
        $this->_getHelper()->postDeleteData($lara_url . "api/products/delete/" . $fieldmanagerId);

        try {
            $this->_getSession()->addSuccess(
                $this->__('The product has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/productmanager/index'
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
                    ->isAllowed('logeecom_laraconnect/productmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('productmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select product.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/products/delete/" . $entityId);
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