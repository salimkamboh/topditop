<?php

class Logeecom_Laraconnect_Adminhtml_CategorymanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $categorymanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/categorymanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($categorymanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($categorymanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$categorymanagerId) {
                $this->_getSession()->addError(
                    $this->__('This categorymanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/categorymanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/categories/" . $categorymanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('categorymanagerData')) {

            try {

                if ($categorymanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/categories/" . $categorymanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The category has been edited.')
                    );
                } else {
                    if ($categorymanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/categories")) {
                        $categorymanagerObject = json_decode($categorymanagerObject);
                        $categorymanagerId = $categorymanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The category has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/categorymanager/edit',
                    array('id' => $categorymanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current categorymanager object available to blocks.
        Mage::register('current_categorymanager', $rowObj);

        // Instantiate the form container.
        $categorymanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/categorymanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($categorymanagerEditBlock)
            ->renderLayout();

    }

    /**
     *
     */
    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/categories/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The category has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/categorymanager/index'
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
                    ->isAllowed('logeecom_laraconnect/categorymanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('categorymanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select categories.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/categories/delete/" . $entityId);
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