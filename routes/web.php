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
use App\Http\Controllers\CountryController;
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

// Country
    Route::get('/country', [CountryController::class, 'index'])->name('countries');
    Route::get('/country-create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('/country-store', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/country-edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
    Route::post('/country-update/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::get('/country-delete/{id}', [CountryController::class, 'delete'])->name('countries.delete');

  // state
    Route::get('/state', [StateController::class, 'index'])->name('states');
    Route::get('/state-create', [StateController::class, 'create'])->name('states.create');
    Route::post('/state-store', [StateController::class, 'store'])->name('states.store');
    Route::get('/state-edit/{id}', [StateController::class, 'edit'])->name('states.edit');
    Route::post('/state-update/{id}', [StateController::class, 'update'])->name('states.update');
    Route::get('/state-delete/{id}', [StateController::class, 'delete'])->name('states.delete');

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
            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/show/{id}', [EmployeeController::class, 'showDetails'])->name('show');

            // Route::post('/step2', 'WizardController@storeStep2')->name('wizard.storeStep2');



            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/store_personal/{id}', [EmployeeController::class, 'storePersonal'])->name('store.personal');
            Route::post('/store_finance/{id}', [EmployeeController::class, 'storeFinance'])->name('store.finance');

            //Family
            Route::post('/store_family/{id}', [EmployeeController::class, 'storeFamily'])->name('store.family');
            Route::get('/family-members', [EmployeeController::class, 'getFamilyMembers'])->name('family-members');
            Route::get('/family-members/edit/{id}', [EmployeeController::class, 'editFamilyMember'])->name('family-members.edit');
            Route::post('/family-members/update/{id}', [EmployeeController::class, 'updateFamilyMember'])->name('family-members.update');
            Route::delete('/family-members/delete/{id}', [EmployeeController::class, 'deleteFamilyMember'])->name('family-members.delete');

            // Nominee
            Route::post('/store_nominee/{id}', [EmployeeController::class, 'storeNominee'])->name('store.nominee');
            Route::get('/nominee', [EmployeeController::class, 'getNominee'])->name('nominee');
            Route::get('/nominee/edit/{id}', [EmployeeController::class, 'editNominee'])->name('nominee.edit');
            Route::post('/nominee/update/{id}', [EmployeeController::class, 'updateNominee'])->name('nominee.update');
            Route::delete('/nominee/delete/{id}', [EmployeeController::class, 'deleteNominee'])->name('nominee.delete');

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
