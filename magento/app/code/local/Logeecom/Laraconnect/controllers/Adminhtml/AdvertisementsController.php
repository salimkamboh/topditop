<?php

class Logeecom_Laraconnect_Adminhtml_AdvertisementsController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $advertisementsBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/advertisements');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($advertisementsBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $lara_url = $this->_getHelper()->getLaraUrl();
        if ($advertisementsId = $this->getRequest()->getParam('id', false)) {
            if (!$advertisementsId) {
                $this->_getSession()->addError(
                    $this->__('This advertisements no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/advertisements/index'
                );
            }
        }

        $data = $this->_getHelper()->getRestSingleEntity($lara_url . "api/adverts/" . $advertisementsId);

        $array = json_decode(json_encode($data), true);
        $rowObj = new Varien_Object();
        $rowObj->setData($array);

        if ($postData = $this->getRequest()->getPost('advertisementsData')) {

            try {
                $slugs = array(
                    'scanned_image_url' => 'filename_scanned_image_url',
                    'brand_logo_url' => 'filename_brand_logo_url',
                    'reference_image_url' => 'filename_reference_image_url'
                );

                $postData = $this->_getHelper()->handleImageUploads($slugs, $postData);

                if ($advertisementsId) {

                    $this->_getHelper()->postUpdateData($postData, $lara_url . "api/adverts/" . $advertisementsId);
                    $this->_getSession()->addSuccess(
                        $this->__('The advertisement has been edited.')
                    );
                } else {
                    if ($advertisementsObject = $this->_getHelper()->postInsertData($postData, $lara_url . "api/adverts/")) {
                        $advertisementsObject = json_decode($advertisementsObject);
                        $advertisementsId = $advertisementsObject->id;
                        $this->_getSession()->addSuccess(
                            $this->__('The advertisement has been saved.')
                        );
                    } else {
                        $this->_getSession()->addSuccess(
                            $this->__('There has been an error.')
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/advertisements/edit',
                    array('id' => $advertisementsId)
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current advertisements object available to blocks.
        Mage::register('current_advertisements', $rowObj);

        // Instantiate the form container.
        $advertisementsEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/advertisements_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($advertisementsEditBlock)
            ->renderLayout();

    }

    /**
     *
     */
    public function deleteAction()
    {
        try {
            $this->_getHelper()->entityDelete('api/adverts/delete/', $this->getRequest());
            $this->_getSession()->addSuccess(
                $this->__('The advert has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/advertisements/index'
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
                    ->isAllowed('logeecom_laraconnect/advertisements');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('advertisements');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select adverts.'));
        } else {
            try {
                $lara_url = $this->_getHelper()->getLaraUrl();
                foreach ($entityIds as $entityId) {
                    $this->_getHelper()->postDeleteData($lara_url . "api/adverts/delete/" . $entityId);
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