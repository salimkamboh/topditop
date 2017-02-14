<?php

class Logeecom_Laraconnect_Model_Storeentity extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        /**
         * This tells Magento where the related resource model can be found.
         *
         * For a resource model, Magento will use the standard model alias -
         * in this case 'logeecom_laraconnect' - and look in
         * config.xml for a child node <resourceModel/>. This will be the
         * location that Magento will look for a model when
         * Mage::getResourceModel() is called - in our case,
         * Logeecom_Laraconnect_Model_Resource.
         */
        $this->_init('logeecom_laraconnect/storeentity');
    }

    /**
     * This method is used in the grid and form for populating the dropdown with stores.
     */
    public function getAvailableStores($chosenStore)
    {
        $storeEntityModel = Mage::getModel('logeecom_laraconnect/storeentity');
        $collection = $storeEntityModel->getCollection();
        $takenStores = array();
        foreach ($collection as $item) {
            if ($item->getData("chosenstore") != $chosenStore)
                $takenStores[] = $item->getData("chosenstore");
        }

        $storesList = array();
        foreach (Mage::app()->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {
                    if (!in_array($store->getId(), $takenStores)) {
                        $storesList[$store->getId()] = $store->getName();
                    }
                }
            }
        }

        return $storesList;
    }

    /**
     *
     */
    public function getStorePackages()
    {
        $handle = curl_init();
        $url = 'http://138.201.246.165/topditop3/api/packages/all';

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_POST, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        curl_close($handle);

        $array = json_decode($response);

        $return = array();
        foreach ($array as $item) {
            $return[$item->id] = $item->name;
        }

        return $return;
    }

    /**
     * This method is used in the grid and form for populating the dropdown with users.
     */
    public function getAvailableUsers()
    {
        $usersList = array();
        $collection = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('email')
            ->addAttributeToSelect('firstname')
            ->addAttributeToSelect('lastname')
            ->addAttributeToSort('email', 'ASC');

        foreach ($collection as $user) {
            $usersList[$user->getData("email")] = $user->getData("email") . " (" . $user->getData("firstname") . " " . $user->getData("lastname") . ")";
        }

        return $usersList;
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        /**
         * Perform some actions just before a storeentity is saved.
         */
        $this->_updateTimestamps();
        $this->_prepareUrlKey();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = now();

        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);

        /**
         * If we have a storeentity new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }

    protected function _prepareUrlKey()
    {
        /**
         * In this method, you might consider ensuring
         * that the URL Key entered is unique and
         * contains only alphanumeric characters.
         */

        return $this;
    }
}