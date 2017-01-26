<?php

class Logeecom_Laraconnect_Adminhtml_PanelmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $panelmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/panelmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($panelmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($panelmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$panelmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This panelmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/panelmanager/index'
                );
            }
        }

        $lang = $this->_getHelper()->getLang();
        $data = $this->_getHelper()->getRestSingleEntity($lara_url . $lang . "/api/panels/" . $panelmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('panelmanagerData')) {

            try {

                if ($panelmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . $lang . "/api/panels/" . $panelmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The panel has been edited.')
                    );
                } else {
                    if ($panelmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . $lang . "/api/panels")) {
                        $panelmanagerObject = json_decode($panelmanagerObject);
                        $panelmanagerId = $panelmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The panel has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/panelmanager/edit',
                    array('id' => $panelmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current panelmanager object available to blocks.
        Mage::register('current_panelmanager', $rowObj);

        // Instantiate the form container.
        $panelmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/panelmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($panelmanagerEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/panels/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The panel has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/panelmanager/index'
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
                    ->isAllowed('logeecom_laraconnect/panelmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('panelmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select panels.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/panels/delete/" . $entityId);
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