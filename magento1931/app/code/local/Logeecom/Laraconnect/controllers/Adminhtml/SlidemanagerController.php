<?php

class Logeecom_Laraconnect_Adminhtml_SlidemanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $slidemanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/slidemanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($slidemanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($slidemanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$slidemanagerId) {
                $this->_getSession()->addError(
                    $this->__('This slidemanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/slidemanager/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/slides/" . $slidemanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('slidemanagerData')) {

            try {

                $postData = $this->_getHelper()->handleImageUpload($postData);

                if ($slidemanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/slides/" . $slidemanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The slide has been edited.')
                    );
                } else {
                    if ($slidemanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/slides")) {
                        $slidemanagerObject = json_decode($slidemanagerObject);
                        $slidemanagerId = $slidemanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The slide has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/slidemanager/edit',
                    array('id' => $slidemanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current slidemanager object available to blocks.
        Mage::register('current_slidemanager', $rowObj);

        // Instantiate the form container.
        $slidemanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/slidemanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($slidemanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/slides/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The slide has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/slidemanager/index'
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
                    ->isAllowed('logeecom_laraconnect/slidemanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('slidemanager');
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

    /**
     * @return Logeecom_Laraconnect_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('logeecom_laraconnect');
    }
}