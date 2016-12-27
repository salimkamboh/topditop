<?php

/**
 * Class Logeecom_Laraconnect_Model_Observer
 */
class Logeecom_Laraconnect_Model_Observer
{

    public function storeSaveAfter(Varien_Event_Observer $observer)
    {
        $obj = $observer->getEvent()->getObject();

        if ($obj instanceof Mage_Core_Model_Store_Group) {
            $data = array("name" => $obj->getData("name"), "root_category_id" => $obj->getData("root_category_id"));
            $handle = curl_init();
            $url = 'http://138.201.246.165/mag/topditop/public/stores';

            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_POST, true);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($handle);
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            curl_close($handle);
        }

    }

}
