<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api/'], function () {

    Route::localizedGroup(function () {
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
