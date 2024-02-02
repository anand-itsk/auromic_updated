<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\MasterSetting;
use App\Http\Controllers\PageControllers\ClientCompanyController;
use App\Http\Controllers\PageControllers\CompanyBankDetailController;
use App\Http\Controllers\PageControllers\MasterCompanyController;
use App\Http\Controllers\PageControllers\MasterControllers\CustomerController;
use App\Http\Controllers\PageControllers\MasterControllers\EmployeeController;
use App\Http\Controllers\PageControllers\SubClientCompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/master-setting', [MasterSetting::class, 'setting'])->name('master.settings');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/data', [UserController::class, 'usersData'])->name('users.data');

    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}',  [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/select-user-delete', [UserController::class, 'deleteSelected']);
    Route::get('/import-users-page', [UserController::class, 'importUserPage'])->name('import.users.page');
    Route::post('/import-users', [UserController::class, 'importUsers'])->name('import.users');

    // permission
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permission-create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission-store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission-edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission-update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permission-delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');

    //Pages
    Route::get('/master-companies', [MasterCompanyController::class, 'index'])->name('master-companies');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::prefix('/masters')->name('masters.')->group(function () {
            Route::get('/', [MasterCompanyController::class, 'index'])->name('index');
            Route::get('/data', [MasterCompanyController::class, 'indexData'])->name('data');

            Route::get('/create', [MasterCompanyController::class, 'create'])->name('create');
            Route::post('/store', [MasterCompanyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [MasterCompanyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [MasterCompanyController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [MasterCompanyController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [MasterCompanyController::class, 'showDetails']);
            Route::post('/delete/selected', [MasterCompanyController::class, 'deleteSelected']);
            Route::post('/import', [MasterCompanyController::class, 'import'])->name('import');
            Route::get('/export', [MasterCompanyController::class, 'export']);
        });
        // Client Company
        Route::prefix('/clients')->name('clients.')->group(function () {
            Route::get('/', [ClientCompanyController::class, 'index'])->name('index');
            Route::get('/data', [ClientCompanyController::class, 'indexData'])->name('data');

            Route::get('/create', [ClientCompanyController::class, 'create'])->name('create');
            Route::post('/store', [ClientCompanyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ClientCompanyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ClientCompanyController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [ClientCompanyController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [ClientCompanyController::class, 'showDetails']);
            Route::post('/delete/selected', [ClientCompanyController::class, 'deleteSelected']);
            Route::post('/import', [ClientCompanyController::class, 'import'])->name('import');
            Route::get('/export', [ClientCompanyController::class, 'export']);
        });
        // Sub-Client Company
        Route::prefix('/sub_clients')->name('sub_clients.')->group(function () {
            Route::get('/', [SubClientCompanyController::class, 'index'])->name('index');
            Route::get('/data', [SubClientCompanyController::class, 'indexData'])->name('data');

            Route::get('/create', [SubClientCompanyController::class, 'create'])->name('create');
            Route::post('/store', [SubClientCompanyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SubClientCompanyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SubClientCompanyController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [SubClientCompanyController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [SubClientCompanyController::class, 'showDetails']);
            Route::post('/delete/selected', [SubClientCompanyController::class, 'deleteSelected']);
            Route::post('/import', [SubClientCompanyController::class, 'import'])->name('import');
            Route::get('/export', [SubClientCompanyController::class, 'export']);
        });

        // Company Bank Details
        Route::prefix('/bank_details')->name('bank_details.')->group(function () {
            Route::get('/', [CompanyBankDetailController::class, 'index'])->name('index');
            Route::get('/data', [CompanyBankDetailController::class, 'indexData'])->name('data');

            Route::get('/create', [CompanyBankDetailController::class, 'create'])->name('create');
            Route::post('/store', [CompanyBankDetailController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CompanyBankDetailController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CompanyBankDetailController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [CompanyBankDetailController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [CompanyBankDetailController::class, 'showDetails']);
            Route::post('/delete/selected', [CompanyBankDetailController::class, 'deleteSelected']);
            Route::post('/import', [CompanyBankDetailController::class, 'import'])->name('import');
            Route::get('/export', [CompanyBankDetailController::class, 'export']);
        });
    });

    // Master > Customer
    Route::prefix('master')->name('master.')->group(function () {
        Route::prefix('/customers')->name('customers.')->group(function () {

            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/data', [CustomerController::class, 'indexData'])->name('data');

            Route::get('/create', [CustomerController::class, 'create'])->name('create');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [CustomerController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [CustomerController::class, 'showDetails']);
            Route::post('/delete/selected', [CustomerController::class, 'deleteSelected']);
            Route::post('/import', [CustomerController::class, 'import'])->name('import');
            Route::get('/export', [CustomerController::class, 'export']);
        });

        Route::prefix('/employees')->name('employees.')->group(function () {

            Route::get('/', [EmployeeController::class, 'index'])->name('index');
            Route::get('/data', [EmployeeController::class, 'indexData'])->name('data');

            Route::get('/create', [EmployeeController::class, 'create'])->name('create');
            Route::post('/store_personal', [EmployeeController::class, 'storePersonal'])->name('store.personal');
            Route::post('/store_finance', [EmployeeController::class, 'storefinance'])->name('store.finance');
            // Route::post('/step2', 'WizardController@storeStep2')->name('wizard.storeStep2');



            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [EmployeeController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [EmployeeController::class, 'showDetails']);
            Route::post('/delete/selected', [EmployeeController::class, 'deleteSelected']);
            Route::post('/import', [EmployeeController::class, 'import'])->name('import');
            Route::get('/export', [EmployeeController::class, 'export']);
        });
    });

    //Data Fetch
    Route::get('/get-states/{countryId}', [AddressController::class, 'getStates'])->name('get-states');
    Route::get('/get-districts/{stateId}', [AddressController::class, 'getDistricts'])->name('get-districts');
    Route::get('/get-companies/{companyTypeId}', [EmployeeController::class, 'getCompanies'])->name('get-companies');
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Config cache:
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Storage linked</h1>';
});

//Schedule List:
Route::get('/schedule-list', function () {
    $exitCode = Artisan::call('schedule:list');
    return $exitCode;
});

    // master settings
