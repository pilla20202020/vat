<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/birthday', [App\Http\Controllers\HomeController::class, 'birthdayNotification'])->name('birthday');

Route::group(['as' => 'user.','namespace' => 'App\Http\Controllers', 'prefix' => 'user',], function () {
    Route::get('forget-password', 'User\UserController@forgetPassword')->name('forgetPassword');
    Route::post('update-password', 'User\UserController@updatePassword')->name('updatePassword');

});



Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'user.', 'prefix' => 'user',], function () {
        Route::get('', 'User\UserController@index')->name('index')->middleware('permission:user-index');
        Route::get('user-data', 'User\UserController@getAllData')->name('data')->middleware('permission:user-data');
        Route::get('create', 'User\UserController@create')->name('create')->middleware('permission:user-create');
        Route::post('', 'User\UserController@store')->name('store')->middleware('permission:user-store');
        Route::get('{user}/edit', 'User\UserController@edit')->name('edit')->middleware('permission:user-edit');
        Route::put('{user}', 'User\UserController@update')->name('update')->middleware('permission:user-update');
        Route::get('user/{id}/destroy', 'User\UserController@destroy')->name('destroy')->middleware('permission:user-delete');
        Route::get('update-profile', 'User\UserController@profileUpdate')->name('profileUpdate');
        Route::post('update-profile/{id}', 'User\UserController@profileUpdateStore')->name('updateProfile');

    });

    /*
    |--------------------------------------------------------------------------
    | Role CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'role.', 'prefix' => 'role',], function () {
        Route::get('', 'Role\RoleController@index')->name('index')->middleware('permission:role-index');
        Route::get('role-data', 'Role\RoleController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Role\RoleController@create')->name('create')->middleware('permission:role-create');
        Route::post('', 'Role\RoleController@store')->name('store')->middleware('permission:role-store');
        Route::get('{role}/edit', 'Role\RoleController@edit')->name('edit')->middleware('permission:role-edit');
        Route::put('{role}', 'Role\RoleController@update')->name('update')->middleware('permission:role-update');
        Route::get('role/{id}/destroy', 'Role\RoleController@destroy')->name('destroy')->middleware('permission:role-delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Permission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'permission.', 'prefix' => 'permission',], function () {
        Route::get('', 'Permission\PermissionController@index')->name('index')->middleware('permission:role-index');
        Route::get('permission-data', 'Permission\PermissionController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Permission\PermissionController@create')->name('create')->middleware('permission:permission-create');
        Route::post('', 'Permission\PermissionController@store')->name('store')->middleware('permission:role-store');
        Route::get('{permission}/edit', 'Permission\PermissionController@edit')->name('edit')->middleware('permission:permission-edit');
        Route::put('{permission}', 'Permission\PermissionController@update')->name('update')->middleware('permission:role-update');
        Route::get('permission/{id}/destroy', 'Permission\PermissionController@destroy')->name('destroy')->middleware('permission:permission-delete');
    });


    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });

    Route::get('setting', 'Setting\SettingController@index')->name('setting.index');
    Route::put('setting/update', 'Setting\SettingController@update')->name('setting.update');



    /*
    |--------------------------------------------------------------------------
    | Vendor CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'vendors.', 'prefix' => 'vendors',], function () {
        Route::get('', 'Vendor\VendorController@index')->name('index');
        Route::get('create', 'Vendor\VendorController@create')->name('create');
        Route::post('', 'Vendor\VendorController@store')->name('store');
        Route::get('{vendors}/edit', 'Vendor\VendorController@edit')->name('edit');
        Route::put('{vendors}', 'Vendor\VendorController@update')->name('update');
        Route::get('vendors/{id}/destroy', 'Vendor\VendorController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Seller CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'seller.', 'prefix' => 'seller',], function () {
        Route::get('', 'Seller\SellerController@index')->name('index');
        Route::get('create', 'Seller\SellerController@create')->name('create');
        Route::post('', 'Seller\SellerController@store')->name('store');
        Route::get('{seller}/edit', 'Seller\SellerController@edit')->name('edit');
        Route::put('{seller}', 'Seller\SellerController@update')->name('update');
        Route::get('seller/{id}/destroy', 'Seller\SellerController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ProductCategory CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'product-category.', 'prefix' => 'product-category',], function () {
        Route::get('', 'ProductCategory\ProductCategoryController@index')->name('index');
        Route::get('create', 'ProductCategory\ProductCategoryController@create')->name('create');
        Route::post('', 'ProductCategory\ProductCategoryController@store')->name('store');
        Route::get('{productcategory}/edit', 'ProductCategory\ProductCategoryController@edit')->name('edit');
        Route::put('{productcategory}', 'ProductCategory\ProductCategoryController@update')->name('update');
        Route::get('productcategory/{id}/destroy', 'ProductCategory\ProductCategoryController@destroy')->name('destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Product CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'product.', 'prefix' => 'product',], function () {
        Route::get('', 'Product\ProductController@index')->name('index');
        Route::get('create', 'Product\ProductController@create')->name('create');
        Route::post('', 'Product\ProductController@store')->name('store');
        Route::get('{product}/edit', 'Product\ProductController@edit')->name('edit');
        Route::put('{product}', 'Product\ProductController@update')->name('update');
        Route::get('product/{id}/destroy', 'Product\ProductController@destroy')->name('destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | ServiceCategory CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'service-category.', 'prefix' => 'service-category',], function () {
        Route::get('', 'ServiceCategory\ServiceCategoryController@index')->name('index');
        Route::get('create', 'ServiceCategory\ServiceCategoryController@create')->name('create');
        Route::post('', 'ServiceCategory\ServiceCategoryController@store')->name('store');
        Route::get('{servicecategory}/edit', 'ServiceCategory\ServiceCategoryController@edit')->name('edit');
        Route::put('{servicecategory}', 'ServiceCategory\ServiceCategoryController@update')->name('update');
        Route::get('servicecategory/{id}/destroy', 'ServiceCategory\ServiceCategoryController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Service CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'service.', 'prefix' => 'service',], function () {
        Route::get('', 'Service\ServiceController@index')->name('index');
        Route::get('create', 'Service\ServiceController@create')->name('create');
        Route::post('', 'Service\ServiceController@store')->name('store');
        Route::get('{service}/edit', 'Service\ServiceController@edit')->name('edit');
        Route::put('{service}', 'Service\ServiceController@update')->name('update');
        Route::get('service/{id}/destroy', 'Service\ServiceController@destroy')->name('destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Company CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'company.', 'prefix' => 'company',], function () {
        Route::get('', 'Company\CompanyController@index')->name('index');
        Route::get('create', 'Company\CompanyController@create')->name('create');
        Route::post('', 'Company\CompanyController@store')->name('store');
        Route::get('{company}/edit', 'Company\CompanyController@edit')->name('edit');
        Route::put('{company}', 'Company\CompanyController@update')->name('update');
        Route::get('company/{id}/destroy', 'Company\CompanyController@destroy')->name('destroy');
        Route::post('company/storeBranches','Company\CompanyController@storeBranches')->name('store_branches');
        Route::get('getbranches', 'Company\CompanyController@getBranches')->name('getbranches');
    });

    /*
    |--------------------------------------------------------------------------
    | Client CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'customer.', 'prefix' => 'customer',], function () {
        Route::get('', 'Customer\CustomerController@index')->name('index');
        Route::get('create', 'Customer\CustomerController@create')->name('create');
        Route::post('', 'Customer\CustomerController@store')->name('store');
        Route::get('{customer}/edit', 'Customer\CustomerController@edit')->name('edit');
        Route::put('{customer}', 'Customer\CustomerController@update')->name('update');
        Route::get('customer/{id}/destroy', 'Customer\CustomerController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | JobOrder CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'joborder.', 'prefix' => 'joborder',], function () {
        Route::get('', 'JobOrder\JobOrderController@index')->name('index');
        Route::get('create', 'JobOrder\JobOrderController@create')->name('create');
        Route::post('', 'JobOrder\JobOrderController@store')->name('store');
        Route::get('{joborder}/edit', 'JobOrder\JobOrderController@edit')->name('edit');
        Route::put('{joborder}', 'JobOrder\JobOrderController@update')->name('update');
        Route::get('joborder/{id}/destroy', 'JobOrder\JobOrderController@destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Billing Advice CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'billingadvice.', 'prefix' => 'billingadvice',], function () {
        Route::get('', 'BillingAdvice\BillingAdviceController@index')->name('index');
        Route::get('create', 'BillingAdvice\BillingAdviceController@create')->name('create');
        Route::get('getjoborder', 'BillingAdvice\BillingAdviceController@getJoborder')->name('getjoborder');
        Route::post('', 'BillingAdvice\BillingAdviceController@store')->name('store');
        Route::get('{billingadvice}/edit', 'BillingAdvice\BillingAdviceController@edit')->name('edit');
        Route::put('{billingadvice}', 'BillingAdvice\BillingAdviceController@update')->name('update');
        Route::get('billingadvice/{id}/destroy', 'BillingAdvice\BillingAdviceController@destroy')->name('destroy');
        Route::get('getjoborder', 'BillingAdvice\BillingAdviceController@getJobOrder')->name('getjoborder');
    });

});
