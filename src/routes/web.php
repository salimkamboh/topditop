<?php

Route::localizedGroup(function () {
    // ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP
    Route::get('/', ['as' => 'default', 'uses' => 'HomeController@homepage']);
    Route::post('/vision/search', ['as' => 'vision-search', 'uses' => 'VisionController@search']);
    Route::get('/vision/', ['as' => 'vision-index', 'uses' => 'VisionController@index']);

    Route::group(['prefix' => '/dashboard/', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => '/'], function () {
            Route::get('/', ['as' => 'dashboard_home', 'uses' => 'StoreController@dashboard']);
            Route::get('/settings', ['as' => 'dashboard_settings', 'uses' => 'StoreController@settings']);
            Route::post('/settings/{profile}', ['as' => 'dashboard_settings_save', 'uses' => 'ProfileController@saveProfile']);

            Route::get('/settings/image', ['as' => 'dashboard_settings_image', 'uses' => 'StoreController@settingsImage']);
            Route::get('/settings/profile', ['as' => 'dashboard_settings_profile', 'uses' => 'StoreController@settingsProfile']);
            Route::post('/settings/save/image', ['as' => 'dashboard_settings_image_save', 'uses' => 'StoreController@settingsImageSave']);
            Route::post('/settings/save/profile', ['as' => 'dashboard_settings_password_edit', 'uses' => 'StoreController@settingsEditPass']);

            Route::get('/upgrade/{entity}', ['as' => 'dashboard_upgrade', 'uses' => 'StoreController@upgradePackage']);

            Route::get('/references', ['as' => 'dashboard_references', 'uses' => 'ReferenceController@index']);
            Route::get('/references/new', ['as' => 'dashboard_reference_new', 'uses' => 'ReferenceController@create']);
            Route::get('/references/edit/{reference}', ['as' => 'dashboard_reference_edit', 'uses' => 'ReferenceController@edit']);
            Route::post('/references/product/delete/{reference}/{product}', ['as' => 'dashboard_product_delete_from_reference', 'uses' => 'ReferenceController@disconnectProduct']);
            Route::post('/save/references', ['as' => 'insertreference', 'uses' => 'AjaxController@insertReference']);
            Route::post('/update/references/{reference}', ['as' => 'updatereference', 'uses' => 'AjaxController@updateReference']);
            Route::get('/unpublish/references/{reference}', ['as' => 'dashboard_reference_unpublish', 'uses' => 'ReferenceController@unpublish']);
            Route::get('/publish/references/{reference}', ['as' => 'dashboard_reference_publish', 'uses' => 'ReferenceController@publish']);
            Route::get('/delete/references/{reference}', ['as' => 'dashboard_reference_delete', 'uses' => 'ReferenceController@delete']);
            Route::get('/delete/products/{product}', ['as' => 'dashboard_product_delete', 'uses' => 'ProductsController@delete']);

            Route::get('/products', ['as' => 'dashboard_products', 'uses' => 'ProductsController@index']);
            Route::get('/products/new', ['as' => 'dashboard_product_new', 'uses' => 'ProductsController@create']);
            Route::get('/products/edit/{product}', ['as' => 'dashboard_product_edit', 'uses' => 'ProductsController@edit']);
            Route::post('/save/products', ['as' => 'insertproduct', 'uses' => 'AjaxController@insertProduct']);
            Route::post('/update/products/{product}', ['as' => 'updateproduct', 'uses' => 'AjaxController@updateProduct']);
        });
    });

    Route::group(['prefix' => '/front/'], function () {
        Route::get('/', ['as' => 'show_store_front', 'uses' => 'StoreController@showFront']);
        Route::get('/stores/results/', ['as' => 'front_show_store_results', 'uses' => 'FrontController@frontShowResults']);
        Route::get('/stores/{store}', ['as' => 'front_show_store', 'uses' => 'FrontController@frontShowStore']);
        Route::get('/stores/ad/{advert}', ['as' => 'advert_page', 'uses' => 'FrontController@advertisementShow']);
        Route::get('/stores/location/{location}', ['as' => 'front_stores_by_location', 'uses' => 'FrontController@frontShowStoresLocation']);
        Route::get('/references/', ['as' => 'front_references', 'uses' => 'FrontController@showReferences']);
        Route::get('/references/gallery/store/{store}/', ['as' => 'front_references_gallery', 'uses' => 'FrontController@showReferenceGallery']);
        Route::get('/references/single/{reference}', ['as' => 'front_references_single', 'uses' => 'FrontController@showReferenceSingle']);
        Route::get('/brands/references', ['as' => 'front_brand_references_index', 'uses' => 'FrontController@brandReferencesIndex']);
        Route::get('/brand/{manufacturer}/stores', 'FrontController@redirectToPluralshowStoresForBrand');
        Route::get('/brands/{manufacturer}/references/{reference}', ['as' => 'front_brand_references_single', 'uses' => 'FrontController@showBrandReference']);
        Route::get('/brands/{manufacturer}/stores', ['as' => 'front_brand_stores', 'uses' => 'FrontController@showStoresForBrand']);
        Route::get('/products/', ['as' => 'front_products', 'uses' => 'FrontController@showProducts']);
        Route::get('/product/{product}', ['as' => 'front_show_product', 'uses' => 'FrontController@showProduct']);
        Route::get('/stores/', ['as' => 'front_stores', 'uses' => 'FrontController@showStores']);
        Route::get('/contact', ['as' => 'front_contact_page', 'uses' => 'HomeController@contactPage']);
        Route::get('/terms', ['as' => 'front_terms_page', 'uses' => 'HomeController@termsPage']);
        Route::get('/privacy', ['as' => 'front_privacy_page', 'uses' => 'HomeController@privacyPage']);
        Route::get('/impressum', ['as' => 'front_impressum_page', 'uses' => 'HomeController@impressumPage']);
        Route::get('/single-advertisement', ['as' => 'single_advertisement', 'uses' => 'HomeController@advertisementPage']);
    });

    Route::group(['prefix' => 'filter/'], function () {
        Route::post('/stores/multi/', ['as' => 'stores_multi_filter', 'uses' => 'FilterController@multiFilterStores']);
        Route::post('/brandreferences/multi/', ['as' => 'brandreferences_multi_filter', 'uses' => 'FilterController@multiFilterBrandreferences']);
        Route::post('/references/multi/', ['as' => 'references_multi_filter', 'uses' => 'FilterController@multiFilterReferences']);
        Route::post('/products/multi/', ['as' => 'products_multi_product', 'uses' => 'FilterController@multiFilterProducts']);
        Route::post('/products/front/multi/', ['as' => 'products_front_multi_filter', 'uses' => 'FilterController@multiFilterProductsFront']);
        Route::post('/references/gallery/multi/{store}', ['as' => 'references_multi_filter_gallery', 'uses' => 'FilterController@multiFilterReferencesGallery']);
    });
});

Route::get('/register/verify/{confirmation_code}', ['as' => 'registerverify', 'uses' => 'Auth\AuthController@verify']);
Route::post('/register/confirm/{user}', ['as' => 'confirm_registration', 'uses' => 'Auth\AuthController@confirm']);

Route::get('/product-pop-up', ['as' => 'procuct_popup', 'uses' => 'HomeController@productpopup']);

Route::get('/products-magento2', ['as' => 'productsmagento', 'uses' => 'ProductsController@productsList2']);
Route::get('/products-magento', ['as' => 'productsmagento', 'uses' => 'ProductsController@productsList']);
Route::get('/profiles/{store}', ['as' => 'save_association', 'uses' => 'ProfileController@association']);

/**********************************************************************************************
 * ****************************************************************************************
 * ************************************************************************************
 * ********************
 * ****************
 * POST routes *
 * TODO: arrange routes better with save/edit/delete prefixes
 */
Route::post('/products/sync/{store}', ['as' => 'sync_products', 'uses' => 'ProductsController@sync']);

Route::post('/store/save', ['as' => 'save_store_data', 'uses' => 'StoreController@saveStoreProfile']);
Route::post('/store/settings/edit', ['as' => 'editcontactperson', 'uses' => 'StoreController@editContactData']);

Route::post('/stores', ['as' => 'insertstore', 'uses' => 'StoreController@store']);

//Route::post('/checkboxes', ['as' => 'insertcheckbox', 'uses' => 'CheckboxController@store']);
//Route::post('/checkboxes/{checkbox}', ['as' => 'editcheckbox', 'uses' => 'CheckboxController@update']);
//Route::post('/checkboxes/{checkbox}', ['as' => 'deletecheckbox', 'uses' => 'CheckboxController@destroy']);

Route::auth();
// Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'ajax/', 'middleware' => 'auth'], function () {
    Route::post('/packages', ['as' => 'savepackage', 'uses' => 'AjaxController@savePackage']);
    Route::post('/packages/{package}', ['as' => 'updatepackage', 'uses' => 'AjaxController@editPackage']);
    Route::post('/references/images/upload/', ['as' => 'upload_multiple_images', 'uses' => 'AjaxController@uploadImages']);
    Route::post('/references/images/upload/edit/{reference}', ['as' => 'upload_multiple_images_edit', 'uses' => 'AjaxController@uploadImagesEdit']);
    Route::post('/images/delete/{image}', ['as' => 'delete_image', 'uses' => 'AjaxController@deleteImage']);
    Route::post('/images/product/delete/{image}', ['as' => 'delete_product_image', 'uses' => 'AjaxController@deleteProductImage']);
});

/**********************************************************************************************
 * ****************************************************************************************
 * ************************************************************************************
 * ********************
 * ****************
 * front routes *
 */

Route::post('/contact/send', ['as' => 'post_contact_page', 'uses' => 'AjaxController@contactPageSend']);

Route::get('access', ['as' => 'access.show', 'uses' => 'Auth\AuthController@showAccessPage']);
Route::get('access/clear', ['as' => 'access.clear', 'uses' => 'Auth\AuthController@clearAccess']);
Route::post('access', ['as' => 'access.attempt', 'uses' => 'Auth\AuthController@attemptAccess']);

Route::get('admin', function () {
    return redirect('admin/index.html');
});
