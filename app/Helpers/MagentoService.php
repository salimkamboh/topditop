<?php

namespace app\Helpers;

use SoapClient;
use App\Helpers\Contracts\MagentoActionsContract;
use App\Store;

class MagentoService implements MagentoActionsContract
{
    private $soapConnection;

    public function __construct()
    {
        $this->soapConnection = $this->createSoapConnection();
    }

    /**
     * @return array
     */
    public function createSoapConnection()
    {
        $mage_url = config('services.soap.mage_url');
        $mage_user = config('services.soap.mage_user');
        $mage_api_key = config('services.soap.mage_api_key');

        // Initialize the SOAP client
        $soap = new SoapClient($mage_url);

        // Login to Magento
        //$session_id = $soap->login($mage_user, $mage_api_key);

        //return array("soapObject" => $soap, "session_id" => $session_id);
    }

    /**
     * @param Store $store
     * @return mixed
     */
    public function getProducts(Store $store)
    {
        $result = $this->soapConnection["soapObject"]->call($this->soapConnection["session_id"], 'catalog_category.assignedProducts', $store->mag_cat_id);
        $calls = array();
        foreach ($result as $productInList) {
            $calls[] = array('catalog_product.info', $productInList["product_id"]);
        }
        return $this->soapConnection["soapObject"]->multiCall($this->soapConnection["session_id"], $calls);
    }

    public function getProductsByCategory($category_id)
    {
    }

    public function getProductImage($product_id)
    {
        return $this->soapConnection["soapObject"]->call($this->soapConnection["session_id"], 'catalog_product_attribute_media.list', $product_id);
    }

    public function get_magento_products($store)
    {
        $soap = $this->createSoapConnection();

        $result = $soap["soapObject"]->call($soap["session_id"], 'catalog_category.assignedProducts', $store->mag_cat_id);
        $calls = array();
        foreach ($result as $productInList) {
            $calls[] = array('catalog_product.info', $productInList["product_id"]);
        }

        $magproducts = $soap["soapObject"]->multiCall($soap["session_id"], $calls);
        return $magproducts;
    }

    public function insertUser($userData)
    {
        $soap = $this->soapConnection["soapObject"];
        $session = $this->soapConnection["session_id"];

        $result = $soap->call($session, 'customer.create',
            array(
                $userData
            )
        );
    }

}