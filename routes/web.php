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


Auth::routes();



Route::get('/', function () {
    return redirect()->route('send.payment');
})->name('/');
Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/admin/users', function () {
        return view('admin.users.index');
    })->name('users');
    Route::post('/admin/users/all', 'AclUserController@getUsersWithSearch')->name('users.search');
    Route::get('/admin/users/roles/all', 'AclUserController@getAllRoles')->name('roles.all');
    Route::post('/admin/users/create', 'AclUserController@createUser')->name('users.create');
    Route::post('/admin/users/get', 'AclUserController@editUser')->name('users.first');
    Route::post('/admin/users/update', 'AclUserController@updateUser')->name('users.update');
    Route::post('/admin/users/delete', 'AclUserController@deleteUser')->name('users.delete');

    Route::get('/admin/categories', function () {
        return view('admin.categories.index');
    })->name('categories');

    Route::post('/admin/categories/all', 'CategoriesController@index')->name('categories.search');
    Route::post('/admin/categories/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/admin/categories/delete', 'CategoriesController@delete')->name('categories.delete');
    Route::post('/admin/categories/get', 'CategoriesController@edit')->name('categories.get');
    Route::post('/admin/categories/update', 'CategoriesController@update')->name('categories.update');

    Route::get('/admin/companies', function () {
        return view('admin.companies.index');
    })->name('admin.companies');

    Route::post('/admin/companies/all', 'CompanyController@index')->name('admin.companies.search');
    Route::post('/admin/companies/approve', 'CompanyController@approve')->name('admin.companies.approve');
    Route::post('/admin/companies/disapprove', 'CompanyController@disapprove')->name('admin.companies.disapprove');
    Route::post('/admin/companies/delete', 'CompanyController@delete')->name('admin.companies.delete');


    Route::get('/admin/email/template', function () {
        return view('admin.EmailTemplates.index');
    })->name('email.template');

    Route::post('/admin/email/template/all', 'EmailTemplateController@index')->name('email.template.search');
    Route::post('/admin/email/template/create', 'EmailTemplateController@create')->name('email.template.create');
    Route::post('/admin/email/template/delete', 'EmailTemplateController@delete')->name('email.template.delete');
    Route::post('/admin/email/template/get', 'EmailTemplateController@edit')->name('email.template.get');
    Route::post('/admin/email/template/update', 'EmailTemplateController@update')->name('email.template.update');


    Route::get('/admin/permissions', function () {
        return view('admin.permissions.index');
    })->name('admin.permissions');

    Route::post('/admin/permissions/all', 'PermissionController@index')->name('admin.permissions.search');
    Route::post('/admin/permissions/create', 'PermissionController@create')->name('admin.permissions.create');
    Route::post('/admin/permissions/delete', 'PermissionController@delete')->name('admin.permissions.delete');
    Route::post('/admin/permissions/get', 'PermissionController@edit')->name('admin.permissions.get');
    Route::post('/admin/permissions/update', 'PermissionController@update')->name('admin.permissions.update');

    Route::get('/admin/roles', function () {
        return view('admin.roles.index');
    })->name('admin.roles');
    Route::post('/admin/roles/all', 'RoleController@getRoles')->name('admin.roles.all');
    Route::get('/admin/roles/permissions/all', 'RoleController@getAllPermissions')->name('admin.roles.all');
    Route::post('/admin/roles/create', 'RoleController@createRole')->name('admin.roles.create');
    Route::post('/admin/roles/get', 'RoleController@editRole')->name('admin.roles.first');
    Route::post('/admin/roles/update', 'RoleController@updateRole')->name('admin.roles.update');
    Route::post('/admin/roles/delete', 'RoleController@deleteRole')->name('admin.roles.delete');


    Route::get('/transactions', function () {
        return view('admin.transactions.index');
    })->name('admin.transactions');

    Route::post('/transactions/all', function(){
        $request = request();
        $helper = new \App\Helpers\Helper();
        $transactions = new \App\Transaction;

        $transactions = $transactions->where(function($query) use ($request){
            $query->where('payer_name', 'LIKE', '%'.$request->SearchQuery.'%');
        });

        $transactions = $transactions->where('user_id', Auth::user()->id);

        $helper->response()->setHttpCode(200)->send($transactions->orderBy('id', request()->orderBy)->paginate());

    });

    Route::get('/send/payment', function(){
        $companies = new \App\Company;
//    $categories = new \App\Categories;
        $companies = $companies->where('status', 1)->get();
//    $categories = $categories->where('status', 'enabled')->get();
        return view('sendPayment', compact('companies'));
    })->name('send.payment');

    Route::post('/company/save', 'CompanyController@store')->name('company.add');

    Route::post('paypal', 'PaymentController@payWithpaypal')->name('paywithpaypal');

    Route::get('status', 'PaymentController@getPaymentStatus')->name('status');


});

//Route::get('/company', function () {
//    $companies = new \App\Company;
//    $categories = new \App\Categories;
//    $companies = $companies->where('status', 1)->get();
//    $categories = $categories->where('status', 'enabled')->get();
//    return view('company.add', compact('companies', 'categories'));
//})->name('company');

Route::get('/company/add', function(){
    $categories = new \App\Categories;
    $categories = $categories->where('status', 'enabled')->get();
    return view('company.add', compact('categories'));
})->name('company.form');
