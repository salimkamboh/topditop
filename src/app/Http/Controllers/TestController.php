<?php

namespace App\Http\Controllers;

use App\Helpers\Contracts\MagentoActionsContract;
use App\Package;
use App\Profile;
use App\Store;
use App\User;
use DB;
use Exception;
use Mail;
use Response;

class TestController extends BaseController
{

    public function index(RocketShipContract $rocketship)
    {
        $store = $this->current_store;

        $boom = $rocketship->blastOff();

        return view('demo.index', compact('store'))->with('boom', $boom);
    }

    public function productsAll(MagentoActionsContract $magentoActionsContract)
    {
        $store = $this->current_store;

        $products = $magentoActionsContract->getProducts($store);

        return view('demo.soap', compact('store'))->with('products', $products);
    }

    //
    public function onetoone()
    {
        $store = $this->current_store;

        $profile = new \App\Profile();
        $profile->description = "test desc " . uniqid();

        $store->profile()->save($profile);
        $profile->store()->associate($store);

        $storeNew = \App\Store::find($store->id);
        return $storeNew->profile;
    }

    public function testEmail()
    {

        $user = \App\User::find(1)->toArray();

        Mail::send('emails.mailtest', $user, function ($message) use ($user) {
            $message->to($user["email"]);
            $message->subject('Mailgun Testing');
        });
        dd('Mail Send Successfully');
    }

    public function productsList()
    {
        $mage_url = 'http://78.46.218.38/mag/api/soap/?wsdl';
        $mage_user = 'slavisatest';
        $mage_api_key = 'logeecom2016';

        // Initialize the SOAP client
        $soap = new \SoapClient($mage_url);

        // Login to Magento
        $session_id = $soap->login($mage_user, $mage_api_key);

        $result = $soap->call($session_id, 'catalog_category.assignedProducts', '5');
        $calls = array();
        foreach ($result as $productInList) {
            $calls[] = array('catalog_product.info', $productInList["product_id"]);
        }

        $results = $soap->multiCall($session_id, $calls);

        print_r($results);
    }

    /**
     * @param Package $package
     * @param Profile $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPackageToProfile(Package $package, Profile $profile)
    {
        $profile->package()->associate($package);
        $profile->save();

        return back();
    }

    /**
     * @param $pass
     * @return $this|string
     */
    public function postTestStoreCreate($pass)
    {
        #TODO refactor this, simplify and protect fillables
        $store = new Store();
        $store->createNew("Novi Store", 5, 5, "sl.avishaofficial@gmail.com");

        $user = new User();
        $user->email = "sl.avishaofficial@gmail.com";
        $user->name = "Slavisa Perisic";
        $user->password = bcrypt($pass);

        try {
            $statusCode = 200;
            $store->save();
            $store->user()->save($user);
            $user->store()->associate($store);
            $response = "Success!";
        } catch (Exception $e) {
            $statusCode = 400;
            $response = $e->getMessage();
        } finally {
            return Response::json($response, $statusCode);
        }
    }

    public function truncateDB()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement("truncate table users");
        DB::statement("truncate table stores");
        DB::statement("truncate table profiles");
        DB::statement("truncate table checkbox_profile");
        DB::statement("truncate table `references`");
        DB::statement("truncate table products");
        DB::statement("truncate table fields");
        DB::statement("truncate table packages");
        DB::statement("truncate table field_groups");
        DB::statement("truncate table field_group_package");
    }
}
