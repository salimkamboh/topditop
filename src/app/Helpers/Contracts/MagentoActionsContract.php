<?php

namespace App\Helpers\Contracts;

use App\Store;

Interface MagentoActionsContract
{
    public function createSoapConnection();

    public function getProducts(Store $store);

    public function getProductsByCategory($category_id);

    public function getProductImage($product_id);

    public function insertUser($userData);
}