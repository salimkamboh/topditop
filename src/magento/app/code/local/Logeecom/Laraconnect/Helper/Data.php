<?php

/**
 * Class Logeecom_Laraconnect_Helper_Data
 */
class Logeecom_Laraconnect_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @return string
     */
    public function getLaraUrl()
    {
        return Mage::getStoreConfig('larasection/laragroup/lara_url', Mage::app()->getStore());
    }

    public function getLang()
    {
        $locale = Mage::app()->getLocale()->getLocaleCode();
        $lang = substr($locale, 0, 2);
        if ($lang == 'de')
            $lang = '';

        return $lang;
    }

    /**
     * @param $uri
     * @return Varien_Data_Collection
     */
    public function getRestCollection($uri)
    {
        $collection = new Varien_Data_Collection();
        $client = new Zend_Http_Client($uri);
        $client->setMethod(Zend_Http_Client::GET);
        $data = json_decode($client->request()->getBody());

        foreach ($data as $row) {
            $array = json_decode(json_encode($row), true);
            $rowObj = new Varien_Object();
            $rowObj->setData($array);
            $collection->addItem($rowObj);
        }
        return $collection;
    }

    /**
     * @param $uri
     * @return mixed
     */
    public function getRestEntities($uri)
    {
        $client = new Zend_Http_Client($uri);
        $client->setMethod(Zend_Http_Client::GET);
        $data = json_decode($client->request()->getBody());
        return $data;
    }

    /**
     * @param $uri
     * @return mixed
     */
    public function getRestSingleEntity($uri)
    {
        $client = new Zend_Http_Client($uri);
        $client->setMethod(Zend_Http_Client::GET);
        //print_r($client->request()->getBody());exit;
        $data = json_decode($client->request()->getBody());
        return $data;
    }

    /**
     * @param $data
     * @param $url
     * @return string
     */
    public function postInsertData($data, $url)
    {

        $client = new Zend_Http_Client($url);
        $client->setMethod(Zend_Http_Client::POST);
        $client->setParameterPost($data);
        $json = $client->request()->getBody();
        //$request = $client->getLastRequest();
        //print_r($json);exit;
        return $json;
    }

    /**
     * @param $data
     * @param $url
     * @return string
     */
    public function postUpdateData($data, $url)
    {
        $client = new Zend_Http_Client($url);
        $client->setMethod(Zend_Http_Client::POST);
        $client->setParameterPost($data);
        //$req = $client->request();
        //$request = $client->getLastRequest();
        //   print_r($client->request()->getBody());exit;
        $json = $client->request()->getBody();

        return $json;
    }

    /**
     * @param $url
     * @return string
     */
    public function postDeleteData($url)
    {
        $client = new Zend_Http_Client($url);
        $client->setMethod(Zend_Http_Client::DELETE);

        //$req = $client->request();
        //$request = $client->getLastRequest();
        //print_r($client->request()->getBody());exit;
        $json = $client->request()->getBody();

        return $json;
    }

    /**
     * @param array $keys
     * @param $url
     * @return array
     */
    public function _getSelectBoxValues($keys = array(), $url)
    {
        $dataSTD = $this->getRestEntities($url);
        $selectBoxData = array();
        foreach ($dataSTD as $item) {
            $property_1 = $keys[0];
            $property_2 = $keys[1];
            $selectBoxData[$item->$property_1] = $item->$property_2;
        }
        return $selectBoxData;
    }

    /**
     * @param array $keys
     * @param $url
     * @return array
     */
    public function _getMultiSelectBoxValues($keys = array(), $url)
    {
        $dataSTD = $this->getRestEntities($url);

        $selectBoxData = array();
        foreach ($dataSTD as $item) {
            $property_1 = $keys[0];
            $property_2 = $keys[1];
            $selectBoxData[] = array(
                'value' => $item->$property_1,
                'label' => $item->$property_2
            );
        }
        return $selectBoxData;
    }

    /**
     * @param $uri
     * @return array
     */
    public function _getSelectedFields($uri)
    {
        $data = $this->getRestSingleEntity($uri);
        $selectBoxData = array();
        if (!empty($data->fields)) {
            foreach ($data->fields as $item) {
                $selectBoxData[] = $item->id;
            }
        }
        return $selectBoxData;
    }

    /**
     * @param $uri
     * @return array
     */
    public function _getSelectedProducts($uri)
    {
        $data = $this->getRestSingleEntity($uri);
        $selectBoxData = array();

        foreach ($data as $item) {
            $selectBoxData[] = $item->id;
        }

        return $selectBoxData;
    }

    /**
     * @param $uri
     * @return array
     */
    public function _getSelectedPanels($uri)
    {
        $data = $this->getRestSingleEntity($uri);

        $selectBoxData = array();
        if (!empty($data)) {
            foreach ($data as $item) {
                $selectBoxData[] = $item->id;
            }
        }
        return $selectBoxData;
    }

    public function getAllCategoriesArray()
    {
        $categoriesArray = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('is_active', array('eq' => '1'))
            ->load()
            ->toArray();

        $cats = array();
        foreach ($categoriesArray as $item) {
            $cats[$item["entity_id"]] = $item["name"];

        }
        return $cats;
    }

    /**
     * @param $imageSlugs
     * @param $postData
     * @return mixed
     */
    public function handleUploadImage($imageSlugs, $postData)
    {
        foreach ($imageSlugs as $slug => $value) {
            if (isset($_FILES[$value]['name']) && $_FILES[$value]['name'] != '') {

                $uploader = new Varien_File_Uploader($value);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media') . DS;

                $uploader->save($path, $_FILES[$value]['name']);

                $postData[$slug] = $path . $_FILES[$value]['name'];

            }
        }
        return $postData;
    }

    /**
     * @param $postData
     */
    public function handleImageUpload($postData)
    {
        if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {

            $uploader = new Varien_File_Uploader('filename');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);

            $path = Mage::getBaseDir('media') . DS;

            $uploader->save($path, str_replace(' ', '_', $_FILES['filename']['name']));
            $fullFilePath = $path . str_replace(' ', '_', $_FILES['filename']['name']);

            $data = file_get_contents($fullFilePath);
            $base64 = 'data:image/' . $uploader->getFileExtension() . ';base64,' . base64_encode($data);
            $postData['base64'] = $base64;
        }
        return $postData;
    }

    /**
     * @param $postData
     */
    public function handleImageUploads($slugs, $postData)
    {
        foreach ($slugs as $slug) {
            if (isset($_FILES[$slug]['name']) && $_FILES[$slug]['name'] != '') {

                $uploader = new Varien_File_Uploader($slug);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media') . DS;

                $uploader->save($path, $_FILES[$slug]['name']);
                $fullFilePath = $path . $_FILES[$slug]['name'];

                $data = file_get_contents($fullFilePath);
                $base64 = 'data:image/' . $uploader->getFileExtension() . ';base64,' . base64_encode($data);
                $postData[$slug . '_base64'] = $base64;
            }
        }

        return $postData;
    }

    /**
     * @param $files
     * @param $postData
     * @return mixed
     */
    public function handleImagesUpload($files, $postData)
    {
        if (isset($files['image_upload']['name'])) {
            $newImages = array();
            foreach ($files['image_upload']['name'] as $key => $image) {
                Mage::log('looping');
                if (empty($image)) {
                    Mage::log('continue');
                    continue;
                }
                try {
                    Mage::log('uploading');
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader(
                        array(
                            'name' => $files['image_upload']['name'][$key],
                            'type' => $files['image_upload']['type'][$key],
                            'tmp_name' => $files['image_upload']['tmp_name'][$key],
                            'error' => $files['image_upload']['error'][$key],
                            'size' => $files['image_upload']['size'][$key]
                        )
                    );

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);

                    // Set the file upload mode
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders
                    //  (file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS . 'references' . DS;
                    $uploader->save($path, $files['image_upload']['name'][$key]);

                    $fullFilePath = $path . $files['image_upload']['name'][$key];
                    $data = file_get_contents($fullFilePath);
                    $base64 = 'data:image/' . $uploader->getFileExtension() . ';base64,' . base64_encode($data);
                    $newImages[] = $base64;

                    $postData['newImages'] = $newImages;
                } catch (Exception $e) {

                }
            }
        }

        return $postData;
    }

    /**
     * @param $file_post
     * @return array
     */
    public function reArrayFiles(&$file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    /**
     * @param $apiUrl
     * @param $request
     */
    public function entityDelete($apiUrl, $request)
    {
        $lara_url = $this->getLaraUrl();
        $entityManagerId = $request->getParam('id', false);
        $this->postDeleteData($lara_url . $apiUrl . $entityManagerId);
    }
}