<?php

class Logeecom_Laraconnect_Adminhtml_StoreentityController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page, we will see a grid of all
     * storeentitys currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {

        // instantiate the grid container
        $storeentityBlock = $this->getLayout()
            ->createBlock('logeecom_laraconnect_adminhtml/storeentity');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($storeentityBlock)
            ->renderLayout();
    }

    /**
     * This action handles both viewing and editing existing storeentities.
     */
    public function editAction()
    {

        /**
         * Retrieve existing storeentity data if an ID was specified.
         * If not, we will have an empty storeentity entity ready to be populated.
         */
        $storeentity = Mage::getModel('logeecom_laraconnect/storeentity');

        if ($storeentityId = $this->getRequest()->getParam('id', false)) {
            $storeentity->load($storeentityId);


            if (!$storeentity->getId()) {
                $this->_getSession()->addError(
                    $this->__('This storeentity no longer exists.')
                );
                return $this->_redirect(
                    'logeecom_laraconnect_admin/storeentity/index'
                );
            }
        }

        $chosenStore = $storeentity->getData('chosenstore');

        $storeEntityModel = Mage::getModel('logeecom_laraconnect/storeentity');
        $collection = $storeEntityModel->getCollection();
        $takenStores = array();
        foreach ($collection as $item) {
            if ($item->getData("chosenstore") != $chosenStore)
                $takenStores[] = $item->getData("chosenstore");
        }

        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('storeentityData')) {

            if (in_array($postData["chosenstore"], $takenStores)) {
                $this->_getSession()->addError(
                    $this->__("This Store is already taken!")
                );
            }

            $editMode = $storeentity->getId();
            try {
                $storeentity->addData($postData);
                $storeentity->save();

                $this->_getSession()->addSuccess(
                    $this->__('The Store View has been saved internally.')
                );

                if (!$editMode) {
                    if ($this->registerStoreOwner($postData) == 200) {
                        $this->_getSession()->addSuccess(
                            $this->__('The Store View account has been created.')
                        );
                    } else if ($this->registerStoreOwner($postData) == 400) {
                        $this->_getSession()->addError(
                            $this->__('Duplicate store name entry for ' . $postData["name"])
                        );
                    }
                }

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'logeecom_laraconnect_admin/storeentity/edit',
                    array('id' => $storeentity->getId())
                );

            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }

        // Make the current storeentity object available to blocks.
        Mage::register('current_storeentity', $storeentity);

        // Instantiate the form container.
        $storeentityEditBlock = $this->getLayout()->createBlock(
            'logeecom_laraconnect_adminhtml/storeentity_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($storeentityEditBlock)
            ->renderLayout();

    }

    public function deleteAction()
    {
        $storeentity = Mage::getModel('logeecom_laraconnect/storeentity');

        if ($storeentityId = $this->getRequest()->getParam('id', false)) {
            $storeentity->load($storeentityId);
        }

        if (!$storeentity->getId()) {
            $this->_getSession()->addError(
                $this->__('This storeentity no longer exists.')
            );
            return $this->_redirect(
                'logeecom_laraconnect_admin/storeentity/index'
            );
        }

        try {
            $storeentity->delete();

            $this->_getSession()->addSuccess(
                $this->__('The storeentity has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'logeecom_laraconnect_admin/storeentity/index'
        );
    }

    public function registerStoreOwner($data)
    {

        $postData =
            array(
                "store_name" => $data["name"],
                "user_email" => $data["storeowner"],
                "mag_store_id" => $this->getGroupId($data["chosenstore"]),
                "mag_cat_id" => $this->getRootCategoryId($data["chosenstore"]),
                "package_id" => $data["chosenpackage"]
            );

        $handle = curl_init();
        $url = 'http://138.201.246.165/topditop3/stores';

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        return $code;
    }

    /**
     * @param $store_id
     * @return int
     */
    public function getGroupId($store_id)
    {
        $rootCatId = 0;

        foreach (Mage::app()->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {
                    if ($store_id == $store->getId()) {
                        $rootCatId = $group->getId();
                    }
                }
            }
        }
        return $rootCatId;
    }

    /**
     * @param $store_id
     * @return int
     */
    public function getRootCategoryId($store_id)
    {

        $rootCatId = 0;

        foreach (Mage::app()->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {
                    if ($store_id == $store->getId()) {
                        $rootCatId = $group->getRootCategoryId();
                    }
                }
            }
        }
        return $rootCatId;
    }

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - logeecom_laraconnect
         * - - - - - - children
         * - - - - - - - storeentity
         *
         * eg. you could add more rules inside storeentity for edit and delete.
         */
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('logeecom_laraconnect/storeentity');
                break;
        }

        return $isAllowed;
    }

    public function massDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('storeentity');
        if (!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select Store Entities.'));
        } else {
            try {
                $rateModel = Mage::getModel('logeecom_laraconnect/storeentity');
                foreach ($entityIds as $entityId) {
                    $rateModel->load($entityId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->_getHelper()->__(
                        'Total of %d record(s) were deleted.', count($entityIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}