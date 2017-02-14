<?php

class Logeecom_Laraconnect_Adminhtml_LocationmanagerController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $locationmanagerBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/locationmanager');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($locationmanagerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();

        if ($locationmanagerId = $this->getRequest()->getParam('id', false)) {

            if (!$locationmanagerId) {
                $this->_getSession()->addError(
                    $this->__('This locationmanager no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/locationmanager/index'
                );
            }
        }

        $lang = $this->_getHelper()->getLang();
        $data = $this->_getHelper()->getRestSingleEntity($lara_url . $lang . "/api/locations/" . $locationmanagerId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('locationmanagerData')) {

            try {

                if ($locationmanagerId) {
                    $this->_getHelper()->postUpdateData($postData, $lara_url . $lang . "/api/locations/" . $locationmanagerId);
                    $this->_getSession()->addSuccess(
                        $this->__('The location has been edited.')
                    );
                } else {
                    if ($locationmanagerObject = $this->_getHelper()->postInsertData($postData, $lara_url . $lang . "/api/locations")) {
                        $locationmanagerObject = json_decode($locationmanagerObject);
                        $locationmanagerId = $locationmanagerObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The location has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/locationmanager/edit',
                    array('id' => $locationmanagerId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current locationmanager object available to blocks.
        Mage::register('current_locationmanager', $rowObj);

        // Instantiate the form container.
        $locationmanagerEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/locationmanager_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($locationmanagerEditBlock)
            ->renderLayout();

    }

    /**
     *
     */
    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/locations/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The location has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/locationmanager/index'
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
                    ->isAllowed('logeecom_laraconnect/locationmanager');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        $entityIds = $this->getRequest()->getParam('locationmanager');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select Locations.'));
        } else {
            try {
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/locations/delete/" . $entityId);
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