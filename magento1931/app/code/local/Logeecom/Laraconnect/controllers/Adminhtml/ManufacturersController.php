<?php

class Logeecom_Laraconnect_Adminhtml_ManufacturersController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {

        // instantiate the grid container
        $manufacturersBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/manufacturers');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($manufacturersBlock)
            ->renderLayout();
    }

    public function editAction()
    {

        $lara_url = $this->_getHelper()->getLaraUrl();
        if ($manufacturersId = $this->getRequest()->getParam('id', false)) {

            if (!$manufacturersId) {
                $this->_getSession()->addError(
                    $this->__('This manufacturers no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/manufacturers/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/manufacturers/" . $manufacturersId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('manufacturersData')) {

            try {

                $postData = $this->_getHelper()->handleImageUpload($postData);

                if ($manufacturersId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/manufacturers/" . $manufacturersId);
                    $this->_getSession()->addSuccess(
                        $this->__('The manufacturer has been edited.')
                    );
                } else {
                    if ($manufacturersObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/manufacturers/")) {
                        $manufacturersObject = json_decode($manufacturersObject);
                        $manufacturersId = $manufacturersObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The manufacturer has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/manufacturers/edit',
                    array('id' => $manufacturersId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current manufacturers object available to blocks.
        Mage::register('current_manufacturers', $rowObj);

        // Instantiate the form container.
        $manufacturersEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/manufacturers_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($manufacturersEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/manufacturers/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The manufacturer has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/manufacturers/index'
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
                    ->isAllowed('logeecom_laraconnect/manufacturers');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('manufacturers');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select manufacturers.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/manufacturers/delete/" . $entityId);
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