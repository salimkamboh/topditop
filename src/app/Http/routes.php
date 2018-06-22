<?php
Route::localizedGroup(function () {
    // ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP
    Route::get('/', ['as' => 'default', 'uses' => 'HomeController@homepage']);

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
        Route::get('/stores/{store}', ['as' => 'front_show_store', 'uses' => 'FrontController@frontShowStore']);
        Route::get('/stores/ad/{advert}', ['as' => 'advert_page', 'uses' => 'FrontController@advertisementShow']);
        Route::get('/stores/location/{location}', ['as' => 'front_stores_by_location', 'uses' => 'FrontController@frontShowStoresLocation']);
        Route::post('/stores/results/', ['as' => 'front_show_store_results', 'uses' => 'FrontController@frontShowResults']);
        Route::get('/references/', ['as' => 'front_references', 'uses' => 'FrontController@showReferences']);
        Route::get('/references/gallery/store/{store}/', ['as' => 'front_references_gallery', 'uses' => 'FrontController@showReferenceGallery']);
        Route::get('/references/single/{reference}', ['as' => 'front_references_single', 'uses' => 'FrontController@showReferenceSingle']);
        Route::get('/brand/{manufacturer}/stores', ['as' => 'front_brand_stores', 'uses' => 'FrontController@showStoresForBrand']);
        Route::get('/products/', ['as' => 'front_products', 'uses' => 'FrontController@showProducts']);
        Route::get('/product/{product}', ['as' => 'front_show_product', 'uses' => 'FrontController@showProduct']);
        Route::get('/stores/', ['as' => 'front_stores', 'uses' => 'FrontController@showStores']);
        Route::get('/contact', ['as' => 'front_contact_page', 'uses' => 'HomeController@contactPage']);
        Route::get('/terms', ['as' => 'front_terms_page', 'uses' => 'HomeController@termsPage']);
        Route::get('/privacy', ['as' => 'front_privacy_page', 'uses' => 'HomeController@privacyPage']);
        Route::get('/single-advertisement', ['as' => 'single_advertisement', 'uses' => 'HomeController@advertisementPage']);
    });

    Route::group(['prefix' => '/api/'], function () {
        Route::group(['prefix' => '/locations/'], function () {
            Route::get('all', ['as' => 'all_locations', 'uses' => 'LocationController@index']);
            Route::get('/', ['as' => 'locations.list', 'uses' => 'LocationController@list']);
            Route::get('all/rest', ['as' => 'all_locations_rest', 'uses' => 'LocationController@showAll']);
            Route::get('all/custom', ['as' => 'all_locations_custom', 'uses' => 'LocationController@listEnhancedLocations']);
            Route::get('{location}', ['as' => 'view_location', 'uses' => 'LocationController@view']);
            Route::group(['middleware' => 'jwt.admin'], function () {
                Route::post('{location}', ['as' => 'edit_location', 'uses' => 'LocationController@edit']);
                Route::post('/', ['as' => 'insert_location', 'uses' => 'LocationController@save']);
                Route::delete('/delete/{location}', ['as' => 'delete_location', 'uses' => 'LocationController@delete']);
            });
        });
        Route::group(['prefix' => 'products/'], function () {
            Route::get('{product}', ['as' => 'view_product', 'uses' => 'ProductsController@view']);
        });
        Route::group(['prefix' => 'fields/', 'middleware' => 'jwt.admin'], function () {
            Route::get('all', ['as' => 'all_fields', 'uses' => 'FieldController@viewAll']);
            Route::get('all/free', ['as' => 'all_fields_free', 'uses' => 'FieldController@viewAllFree']);
            Route::get('all/free/{fieldGroup}', ['as' => 'all_fields_free_or_taken', 'uses' => 'FieldController@viewAllFreeTaken']);
            Route::get('{field}', ['as' => 'view_field', 'uses' => 'FieldController@view']);
            Route::post('{field}', ['as' => 'edit_field', 'uses' => 'FieldController@edit']);
            Route::post('/', ['as' => 'insert_field', 'uses' => 'FieldController@save']);
        });
        Route::group(['prefix' => 'fieldgroups/', 'middleware' => 'jwt.admin'], function () {
            Route::get('all', ['as' => 'all_fieldgroups', 'uses' => 'FieldGroupController@viewAll']);
            Route::get('{fieldGroup}', ['as' => 'view_fieldgroup', 'uses' => 'FieldGroupController@view']);
            Route::post('{fieldGroup}', ['as' => 'edit_fieldgroup', 'uses' => 'FieldGroupController@edit']);
            Route::post('/', ['as' => 'insert_fieldgroup', 'uses' => 'FieldGroupController@save']);
            Route::delete('delete/{fieldGroup}', ['as' => 'delete_fieldgroup', 'uses' => 'FieldGroupController@delete']);
        });
        Route::group(['prefix' => 'panels/', 'middleware' => 'jwt.admin'], function () {
            Route::get('all', ['as' => 'all_panels', 'uses' => 'PanelController@viewAll']);
            Route::get('{panel}', ['as' => 'view_panel', 'uses' => 'PanelController@view']);
            Route::post('{panel}', ['as' => 'edit_panel', 'uses' => 'PanelController@edit']);
            Route::post('/', ['as' => 'insert_panel', 'uses' => 'PanelController@save']);
            Route::get('fieldgroups/{panel}', ['as' => 'panel_fieldgroups', 'uses' => 'PanelController@viewFieldGroups']);
            Route::get('package/{package}', ['as' => 'panels_in_package', 'uses' => 'PanelController@viewPanelsByPackage']);
            Route::delete('/delete/{panel}', ['as' => 'delete_panel', 'uses' => 'PanelController@delete']);
        });
    });

    Route::group(['prefix' => 'filter/'], function () {
        Route::post('/stores/multi/', ['as' => 'stores_multi_filter', 'uses' => 'FilterController@multiFilterStores']);
        Route::post('/references/multi/', ['as' => 'references_multi_filter', 'uses' => 'FilterController@multiFilterReferences']);
        Route::post('/products/multi/', ['as' => 'products_multi_product', 'uses' => 'FilterController@multiFilterProducts']);
        Route::post('/products/front/multi/', ['as' => 'products_front_multi_filter', 'uses' => 'FilterController@multiFilterProductsFront']);
        Route::post('/references/gallery/multi/{store}', ['as' => 'references_multi_filter_gallery', 'uses' => 'FilterController@multiFilterReferencesGallery']);
    });
});

Route::get('/register/verify/{confirmation_code}', ['as' => 'registerverify', 'uses' => 'Auth\AuthController@verify']);
Route::post('/register/confirm/{user}', ['as' => 'confirm_registration', 'uses' => 'Auth\AuthController@confirm']);

Route::get('/product-pop-up', ['as' => 'procuct_popup', 'uses' => 'HomeController@productpopup']);

Route::group(['prefix' => 'api/'], function () {

    Route::group(['prefix' => 'references/'], function () {
        Route::get('all', ['as' => 'all_references_view', 'uses' => 'ReferenceController@viewAll']);
        Route::get('{reference}', ['as' => 'view_reference', 'uses' => 'ReferenceController@view']);
        Route::get('{reference}/images', ['as' => 'view_reference_images', 'uses' => 'ReferenceController@viewImages']);
        Route::get('{reference}/products', ['as' => 'view_reference_products', 'uses' => 'ReferenceController@viewProducts']);
        Route::get('{reference}/manufacturers', ['as' => 'view_reference_manufacturers', 'uses' => 'ReferenceController@viewManufacturers']);
        Route::post('update/{reference}/', ['as' => 'update_reference_rest', 'uses' => 'ReferenceController@updateReferenceRest']);
        Route::post('/', ['as' => 'insert_reference_rest', 'uses' => 'ReferenceController@insertReferenceRest']);
        Route::post('/images/delete/{image}', ['as' => 'delete_image_api', 'uses' => 'AjaxController@deleteImage']);
        Route::delete('/delete/{reference}', ['as' => 'delete_reference_rest', 'uses' => 'ReferenceController@deleteRest']);
    });
    Route::group(['prefix' => 'products/'], function () {
        Route::get('/', ['as' => 'view_products_all', 'uses' => 'ProductsController@viewAll']);
        Route::get('{product}', ['as' => 'view_product', 'uses' => 'ProductsController@viewRest']);
        Route::get('/html/{product}', ['as' => 'view_product_dashboard', 'uses' => 'ProductsController@view']);
        Route::get('{product}/references', ['as' => 'view_product_references', 'uses' => 'ProductsController@viewReferences']);
        Route::get('{product}/categories', ['as' => 'view_product_categories', 'uses' => 'ProductsController@viewCategories']);
        Route::get('{product}/images', ['as' => 'view_product_images', 'uses' => 'ProductsController@viewImages']);
        Route::post('update/{product}/', ['as' => 'update_product_rest', 'uses' => 'ProductsController@updateProductRest']);
        Route::post('/', ['as' => 'insert_product_rest', 'uses' => 'ProductsController@insertProductRest']);
        Route::post('/images/delete/{image}', ['as' => 'delete_product_image_api', 'uses' => 'AjaxController@deleteProductImage']);
        Route::delete('/delete/{product}', ['as' => 'delete_product_rest', 'uses' => 'ProductsController@deleteRest']);
    });
    Route::group(['prefix' => 'categories/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_categories', 'uses' => 'CategoryController@viewAll']);
        Route::get('{category}', ['as' => 'view_category', 'uses' => 'CategoryController@view']);
        Route::post('{category}', ['as' => 'edit_category', 'uses' => 'CategoryController@edit']);
        Route::post('/', ['as' => 'insert_category', 'uses' => 'CategoryController@save']);
        Route::delete('/delete/{category}', ['as' => 'delete_category', 'uses' => 'CategoryController@delete']);
    });
    Route::group(['prefix' => 'slides/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_slides', 'uses' => 'SlideController@viewAll']);
        Route::get('{slide}', ['as' => 'view_slide', 'uses' => 'SlideController@view']);
        Route::post('{slide}', ['as' => 'edit_slide', 'uses' => 'SlideController@edit']);
        Route::post('/', ['as' => 'insert_slide', 'uses' => 'SlideController@save']);
        Route::delete('/delete/{slide}', ['as' => 'delete_slide', 'uses' => 'SlideController@delete']);
    });
    Route::group(['prefix' => 'adverts/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_adverts', 'uses' => 'AdvertController@viewAll']);
        Route::get('{advert}', ['as' => 'view_advert', 'uses' => 'AdvertController@view']);
        Route::post('{advert}', ['as' => 'edit_advert', 'uses' => 'AdvertController@edit']);
        Route::post('/', ['as' => 'insert_advert', 'uses' => 'AdvertController@save']);
        Route::delete('delete/{advert}', ['as' => 'delete_advert', 'uses' => 'AdvertController@delete']);

        Route::post('{advert}/images', ['as' => 'set_advert_image', 'uses' => 'AdvertController@setImage']);
    });
    Route::group(['prefix' => 'packages/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_packages', 'uses' => 'PackageController@viewAll']);
        Route::get('{package}', ['as' => 'view_package', 'uses' => 'PackageController@view']);
        Route::post('/', ['as' => 'insert_package', 'uses' => 'PackageController@save']);
        Route::delete('/delete/{package}', ['as' => 'delete_package', 'uses' => 'PackageController@delete']);
        Route::post('{package}', ['as' => 'edit_package', 'uses' => 'PackageController@editPackage']);
    });
    Route::group(['prefix' => 'fieldtypes/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_fieldtypes', 'uses' => 'FieldtypeController@viewAll']);
        Route::get('{fieldtype}', ['as' => 'view_fieldtype', 'uses' => 'FieldtypeController@view']);
        Route::post('{fieldtype}', ['as' => 'edit_fieldtype', 'uses' => 'FieldtypeController@edit']);
        Route::post('/', ['as' => 'insert_fieldtype', 'uses' => 'FieldtypeController@save']);
        Route::delete('/delete/{fieldtype}', ['as' => 'delete_fieldtype', 'uses' => 'FieldtypeController@delete']);
    });
    Route::group(['prefix' => 'fields/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_fields', 'uses' => 'FieldController@viewAll']);
        Route::get('all/free', ['as' => 'all_fields_free', 'uses' => 'FieldController@viewAllFree']);
        Route::get('all/free/{fieldGroup}', ['as' => 'all_fields_free_or_taken', 'uses' => 'FieldController@viewAllFreeTaken']);
        Route::get('{field}', ['as' => 'view_field', 'uses' => 'FieldController@view']);
        Route::post('{field}', ['as' => 'edit_field', 'uses' => 'FieldController@edit']);
        Route::post('/', ['as' => 'insert_field', 'uses' => 'FieldController@save']);
        Route::delete('/delete/{field}', ['as' => 'delete_field', 'uses' => 'FieldController@delete']);
    });
    Route::group(['prefix' => 'manufacturers/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_manufacturers', 'uses' => 'ManufacturerController@viewAll']);
        Route::get('{manufacturer}', ['as' => 'view_manufacturer', 'uses' => 'ManufacturerController@view']);
        Route::post('{manufacturer}', ['as' => 'edit_manufacturer', 'uses' => 'ManufacturerController@edit']);
        Route::post('/', ['as' => 'insert_manufacturer', 'uses' => 'ManufacturerController@save']);
        Route::delete('/delete/{manufacturer}', ['as' => 'delete_manufacturer', 'uses' => 'ManufacturerController@delete']);
    });
    Route::group(['prefix' => 'stores/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_stores_list', 'uses' => 'StoreController@viewAll']);
        Route::get('inactive', ['as' => 'inactive_stores', 'uses' => 'StoreController@inactiveStores']);
        Route::get('{store}', ['as' => 'get_single_store', 'uses' => 'StoreController@inactiveStoreSingle']);
        Route::post('/activate/{store}', ['as' => 'activate_single_store', 'uses' => 'StoreController@activateStore']);
        Route::get('list/active', ['as' => 'active_stores', 'uses' => 'StoreController@activeStores']);
        Route::delete('/delete/{store}', ['as' => 'delete_store', 'uses' => 'StoreController@delete']);
    });
    Route::group(['prefix' => 'registerfields/', 'middleware' => 'jwt.admin'], function () {
        Route::get('all', ['as' => 'all_registerfields', 'uses' => 'RegisterfieldController@viewAll']);
        Route::get('{registerfield}', ['as' => 'view_registerfield', 'uses' => 'RegisterfieldController@view']);
        Route::delete('delete/{registerfield}', ['as' => 'delete_registerfield', 'uses' => 'RegisterfieldController@delete']);
        Route::post('{registerfield}', ['as' => 'edit_registerfield', 'uses' => 'RegisterfieldController@edit']);
        Route::post('/', ['as' => 'insert_registerfield', 'uses' => 'RegisterfieldController@save']);
        Route::get('all/users', ['as' => 'all_registerfields_users', 'uses' => 'RegisterfieldController@viewAllUsers']);
    });
});

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
Route::get('/home', 'HomeController@index');

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