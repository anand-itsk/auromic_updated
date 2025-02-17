<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\MasterSetting;
use App\Http\Controllers\PageControllers\ClientCompanyController;
use App\Http\Controllers\PageControllers\CompanyBankDetailController;
use App\Http\Controllers\PageControllers\MasterCompanyController;
use App\Http\Controllers\PageControllers\MasterControllers\CustomerController;
use App\Http\Controllers\PageControllers\MasterControllers\EmployeeController;
use App\Http\Controllers\PageControllers\MasterControllers\ProductModelController;
use App\Http\Controllers\PageControllers\MasterControllers\OrderDetailController;
use App\Http\Controllers\PageControllers\MasterControllers\IncentiveController;
use App\Http\Controllers\PageControllers\MasterControllers\FinishingProductController;
use App\Http\Controllers\PageControllers\JobAllocationController\DirectJobGivingController;
use App\Http\Controllers\PageControllers\JobAllocationController\DirectJobReceivedController;
use App\Http\Controllers\PageControllers\Report\EmployeeReportController;
use App\Http\Controllers\PageControllers\Report\DailyGivenReportCompanyWiseController;
use App\Http\Controllers\PageControllers\Report\JobReceivedReportController;
use App\Http\Controllers\PageControllers\Report\DirectJobGivingReportController;
use App\Http\Controllers\PageControllers\Report\DirectJobReceivedReportController;
use App\Http\Controllers\PageControllers\SubClientCompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionControlController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\CompanyTypeController;
use App\Http\Controllers\ResigningReasonsController;
use App\Http\Controllers\LocalOfficeController;
use App\Http\Controllers\EsiDispensaryController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\RawMaterialTypeController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PageControllers\JobAllocation\DeliveryChallanController;
use App\Http\Controllers\PageControllers\JobAllocation\JobGivingController;
use App\Http\Controllers\PageControllers\JobAllocation\JobReallocationController;
use App\Http\Controllers\PageControllers\JobAllocation\JobReceivedController;
use App\Http\Controllers\PageControllers\Report\JobReallocationController as ReportJobReallocationController;
use App\Http\Controllers\PageControllers\Report\JobReallocationReportController;
use App\Http\Controllers\PageControllers\Report\OutStandingReport;
use App\Http\Controllers\PageControllers\Report\TotalWagesReport;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
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

    // My Profile

    Route::get('/my-profile', [MyProfileController::class, 'index'])->name('my-profile');
    Route::get('/my-profile/edit', [MyProfileController::class, 'edit'])->name('my-profile.edit');
    Route::post('/my-profile/update', [MyProfileController::class, 'update'])->name('my-profile.update');

    Route::get('/master-setting', [MasterSetting::class, 'setting'])->name('master.settings');

    Route::prefix('user-management')->name('user-management.')->group(function () {
        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/data', [UserController::class, 'usersData'])->name('users.data');

        Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/delete/{id}',  [UserController::class, 'destroy'])->name('user.delete');
        Route::delete('/user/show/{id}',  [UserController::class, 'show'])->name('user.show');
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

     // permissionControl
        Route::get('/permission_control', [PermissionControlController::class, 'index'])->name('permission_control');
        Route::get('permission_control/data', [PermissionControlController::class, 'indexData'])->name('permission_control.data');
        Route::get('/permission_control-create', [PermissionControlController::class, 'create'])->name('permission_control.create');
        Route::post('/permission_control-store', [PermissionControlController::class, 'store'])->name('permission_control.store');
        Route::get('/permission_control-edit/{id}', [PermissionControlController::class, 'edit'])->name('permission_control.edit');
        Route::post('/permission_control-update/{id}', [PermissionControlController::class, 'update'])->name('permission_control.update');
        Route::delete('/permission_control-delete/{id}', [PermissionControlController::class, 'delete'])->name('permission_control.delete');


        // permissionGroup
        Route::get('/permission_group', [PermissionGroupController::class, 'index'])->name('permission_group');
         Route::get('permission_group/data', [PermissionGroupController::class, 'indexData'])->name('permission_group.data');
        Route::get('/permission_group-create', [PermissionGroupController::class, 'create'])->name('permission_group.create');
        Route::post('/permission_group-store', [PermissionGroupController::class, 'store'])->name('permission_group.store');
        Route::get('/permission_group-edit/{id}', [PermissionGroupController::class, 'edit'])->name('permission_group.edit');
        Route::post('/permission_group-update/{id}', [PermissionGroupController::class, 'update'])->name('permission_group.update');
        Route::delete('/permission_group-delete/{id}', [PermissionGroupController::class, 'delete'])->name('permission_group.delete');
    });

    Route::prefix('common')->name('common.')->group(function () {

        // Country
        Route::get('/country', [CountryController::class, 'index'])->name('countries');
        Route::get('country/data', [CountryController::class, 'indexData'])->name('country.data');
        Route::get('/country/create', [CountryController::class, 'create'])->name('country.create');
        Route::post('/country/store', [CountryController::class, 'store'])->name('country.store');
        Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
        Route::post('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');
        Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
        Route::post('/country/select-country-delete', [CountryController::class, 'deleteSelected']);

        // state
        Route::get('/state', [StateController::class, 'index'])->name('states');
        Route::get('state/data', [StateController::class, 'indexData'])->name('states.data');
        Route::get('/state-create', [StateController::class, 'create'])->name('states.create');
        Route::post('/state-store', [StateController::class, 'store'])->name('states.store');
        Route::get('/state-edit/{id}', [StateController::class, 'edit'])->name('states.edit');
        Route::post('/state-update/{id}', [StateController::class, 'update'])->name('states.update');
        Route::get('/state-delete/{id}', [StateController::class, 'delete'])->name('states.delete');
        Route::post('state/select-state-delete', [StateController::class, 'deleteSelected']);

        // Districts
        Route::get('/district', [DistrictController::class, 'index'])->name('districts');
        Route::get('district/data', [DistrictController::class, 'indexData'])->name('districts.data');
        Route::get('/district-create', [DistrictController::class, 'create'])->name('districts.create');
        Route::post('/district-store', [DistrictController::class, 'store'])->name('districts.store');
        Route::get('/district-edit/{id}', [DistrictController::class, 'edit'])->name('districts.edit');
        Route::post('/district-update/{id}', [DistrictController::class, 'update'])->name('districts.update');
        Route::get('/district-delete/{id}', [DistrictController::class, 'delete'])->name('districts.delete');
        Route::post('district/select-district-delete', [DistrictController::class, 'deleteSelected']);

        // Caste
        Route::get('/caste', [CasteController::class, 'index'])->name('castes');
        Route::get('caste/data', [CasteController::class, 'indexData'])->name('castes.data');
        Route::get('/caste-create', [CasteController::class, 'create'])->name('castes.create');
        Route::post('/caste-store', [CasteController::class, 'store'])->name('castes.store');
        Route::get('/caste-edit/{id}', [CasteController::class, 'edit'])->name('castes.edit');
        Route::post('/caste-update/{id}', [CasteController::class, 'update'])->name('castes.update');
        Route::get('/caste-delete/{id}', [CasteController::class, 'delete'])->name('castes.delete');
        Route::post('caste/select-caste-delete', [CasteController::class, 'deleteSelected']);

        //Religion
        Route::get('/religion', [ReligionController::class, 'index'])->name('religions');
        Route::get('religion/data', [ReligionController::class, 'indexData'])->name('religions.data');
        Route::get('/religion-create', [ReligionController::class, 'create'])->name('religions.create');
        Route::post('/religion-store', [ReligionController::class, 'store'])->name('religions.store');
        Route::get('/religion-edit/{id}', [ReligionController::class, 'edit'])->name('religions.edit');
        Route::post('/religion-update/{id}', [ReligionController::class, 'update'])->name('religions.update');
        Route::get('/religion-delete/{id}', [ReligionController::class, 'delete'])->name('religions.delete');
        Route::post('religion/select-religion-delete', [ReligionController::class, 'deleteSelected']);

        //Nationality
        Route::get('/nationality', [NationalityController::class, 'index'])->name('nationalities');
        Route::get('nationality/data', [NationalityController::class, 'indexData'])->name('nationalities.data');
        Route::get('/nationality-create', [NationalityController::class, 'create'])->name('nationalities.create');
        Route::post('/nationality-store', [NationalityController::class, 'store'])->name('nationalities.store');
        Route::get('/nationality-edit/{id}', [NationalityController::class, 'edit'])->name('nationalities.edit');
        Route::post('/nationality-update/{id}', [NationalityController::class, 'update'])->name('nationalities.update');
        Route::get('/nationality-delete/{id}', [NationalityController::class, 'delete'])->name('nationalities.delete');
        Route::post('nationality/select-nationality-delete', [NationalityController::class, 'deleteSelected']);
    });

    Route::prefix('specified')->name('specified.')->group(function () {

        //Company Type
        Route::get('/company_type', [CompanytypeController::class, 'index'])->name('company_types');
        Route::get('company_type/data', [CompanytypeController::class, 'indexData'])->name('company_types.data');
        Route::get('/company_type/create', [CompanytypeController::class, 'create'])->name('company_types.create');
        Route::post('/company_type/store', [CompanytypeController::class, 'store'])->name('company_types.store');
        Route::get('/company_type/edit/{id}', [CompanytypeController::class, 'edit'])->name('company_types.edit');
        Route::post('/company_type/update/{id}', [CompanytypeController::class, 'update'])->name('company_types.update');
        Route::get('/company_type/delete/{id}', [CompanytypeController::class, 'delete'])->name('company_types.delete');
        Route::post('company_type/select-company_type-delete', [CompanytypeController::class, 'deleteSelected']);
        //Resigning Reason
        Route::get('/resigning_reason', [ResigningReasonsController::class, 'index'])->name('resigning_reasons');
        Route::get('resigning_reason/data', [ResigningReasonsController::class, 'indexData'])->name('resigning_reasons.data');
        Route::get('/resigning_reason-create', [ResigningReasonsController::class, 'create'])->name('resigning_reasons.create');
        Route::post('/resigning_reason-store', [ResigningReasonsController::class, 'store'])->name('resigning_reasons.store');
        Route::get('/resigning_reason-edit/{id}', [ResigningReasonsController::class, 'edit'])->name('resigning_reasons.edit');
        Route::post('/resigning_reason-update/{id}', [ResigningReasonsController::class, 'update'])->name('resigning_reasons.update');
        Route::get('/resigning_reason-delete/{id}', [ResigningReasonsController::class, 'delete'])->name('resigning_reasons.delete');
        Route::post('resigning_reason/select-resigning_reason-delete', [ResigningReasonsController::class, 'deleteSelected']);

        //Local Offices
        Route::get('/local_office', [LocalOfficeController::class, 'index'])->name('local_offices');
        Route::get('local_office/data', [LocalOfficeController::class, 'indexData'])->name('local_offices.data');
        Route::get('/local_office-create', [LocalOfficeController::class, 'create'])->name('local_offices.create');
        Route::post('/local_office-store', [LocalOfficeController::class, 'store'])->name('local_offices.store');
        Route::get('/local_office-edit/{id}', [LocalOfficeController::class, 'edit'])->name('local_offices.edit');
        Route::post('/local_office-update/{id}', [LocalOfficeController::class, 'update'])->name('local_offices.update');
        Route::get('/local_office-delete/{id}', [LocalOfficeController::class, 'delete'])->name('local_offices.delete');
        Route::post('local_office/select-local_office-delete', [LocalOfficeController::class, 'deleteSelected']);


        //ESI Dispensary
        Route::get('/esi_dispensary', [EsiDispensaryController::class, 'index'])->name('esi_dispensaries');
        Route::get('esi_dispensary/data', [EsiDispensaryController::class, 'indexData'])->name('esi_dispensaries.data');
        Route::get('/esi_dispensary-create', [EsiDispensaryController::class, 'create'])->name('esi_dispensaries.create');
        Route::post('/esi_dispensary-store', [EsiDispensaryController::class, 'store'])->name('esi_dispensaries.store');
        Route::get('/esi_dispensary-edit/{id}', [EsiDispensaryController::class, 'edit'])->name('esi_dispensaries.edit');
        Route::post('/esi_dispensary-update/{id}', [EsiDispensaryController::class, 'update'])->name('esi_dispensaries.update');
        Route::get('/esi_dispensary-delete/{id}', [EsiDispensaryController::class, 'delete'])->name('esi_dispensaries.delete');
        Route::post('esi_dispensary/select-esi_dispensary-delete', [EsiDispensaryController::class, 'deleteSelected']);

        //Payment Mode
        Route::get('/payment_mode', [PaymentModeController::class, 'index'])->name('payment_modes');
        Route::get('payment_mode/data', [PaymentModeController::class, 'indexData'])->name('payment_modes.data');
        Route::get('/payment_mode-create', [PaymentModeController::class, 'create'])->name('payment_modes.create');
        Route::post('/payment_mode-store', [PaymentModeController::class, 'store'])->name('payment_modes.store');
        Route::get('/payment_mode-edit/{id}', [PaymentModeController::class, 'edit'])->name('payment_modes.edit');
        Route::post('/payment_mode-update/{id}', [PaymentModeController::class, 'update'])->name('payment_modes.update');
        Route::get('/payment_mode-delete/{id}', [PaymentModeController::class, 'delete'])->name('payment_modes.delete');
        Route::post('payment_mode/select-payment_mode-delete', [PaymentModeController::class, 'deleteSelected']);

    });


    Route::prefix('product-models')->name('product-models.')->group(function () {

        //Raw Material Type

        Route::get('/raw_material_type', [RawMaterialTypeController::class, 'index'])->name('raw_material_types');
        Route::get('raw_material_type/data', [RawMaterialTypeController::class, 'indexData'])->name('raw_material_types.data');
        Route::get('/raw_material_type/create', [RawMaterialTypeController::class, 'create'])->name('raw_material_types.create');
        Route::post('/raw_material_type/store', [RawMaterialTypeController::class, 'store'])->name('raw_material_types.store');
        Route::get('/raw_material_type/edit/{id}', [RawMaterialTypeController::class, 'edit'])->name('raw_material_types.edit');
        Route::post('/raw_material_type/update/{id}', [RawMaterialTypeController::class, 'update'])->name('raw_material_types.update');
        Route::get('/raw_material_type/delete/{id}', [RawMaterialTypeController::class, 'delete'])->name('raw_material_types.delete');
        Route::post('raw_material_type/select-raw_material_type-delete', [RawMaterialTypeController::class, 'deleteSelected']);

        //Raw Material
        Route::get('/raw_materials', [RawMaterialController::class, 'index'])->name('raw_materials');
        Route::get('raw_materials/data', [RawMaterialController::class, 'indexData'])->name('raw_materials.data');
        Route::get('/raw_materials/create', [RawMaterialController::class, 'create'])->name('raw_materials.create');
        Route::post('/raw_materials/store', [RawMaterialController::class, 'store'])->name('raw_materials.store');
        Route::get('/raw_materials/edit/{id}', [RawMaterialController::class, 'edit'])->name('raw_materials.edit');
        Route::post('/raw_materials/update/{id}', [RawMaterialController::class, 'update'])->name('raw_materials.update');
        Route::get('/raw_materials/delete/{id}', [RawMaterialController::class, 'delete'])->name('raw_materials.delete');
        Route::post('raw_materials/select-raw_materials-delete', [RawMaterialController::class, 'deleteSelected']);

        //Product
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('product/data', [ProductController::class, 'indexData'])->name('products.data');
        Route::get('/product-create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/product-store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/product-update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/product-delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::post('product/select-product-delete', [ProductController::class, 'deleteSelected']);
        //Product Size
        Route::get('/product_sizes', [ProductSizeController::class, 'index'])->name('product_sizes');
        Route::get('product_sizes/data', [ProductSizeController::class, 'indexData'])->name('product_sizes.data');
        Route::get('/product_size/create', [ProductSizeController::class, 'create'])->name('product_sizes.create');
        Route::post('/product_size-store', [ProductSizeController::class, 'store'])->name('product_sizes.store');
        Route::get('/product_sizes/edit/{id}', [ProductSizeController::class, 'edit'])->name('product_sizes.edit');
        Route::post('/product_sizes/update/{id}', [ProductSizeController::class, 'update'])->name('product_sizes.update');
        Route::get('/product_sizes/delete/{id}', [ProductSizeController::class, 'delete'])->name('product_sizes.delete');
        Route::post('product_sizes/select-product_sizes-delete', [ProductSizeController::class, 'deleteSelected']);

        //Product Color
        Route::get('/product_color', [ProductColorController::class, 'index'])->name('product_colors');
        Route::get('product_color/data', [ProductColorController::class, 'indexData'])->name('product_colors.data');
        Route::get('/product_color/create', [ProductColorController::class, 'create'])->name('product_colors.create');
        Route::post('/product_color/store', [ProductColorController::class, 'store'])->name('product_colors.store');
        Route::get('/product_color/edit/{id}', [ProductColorController::class, 'edit'])->name('product_colors.edit');
        Route::post('/product_color/update/{id}', [ProductColorController::class, 'update'])->name('product_colors.update');
        Route::get('/product_color/delete/{id}', [ProductColorController::class, 'delete'])->name('product_colors.delete');
        Route::post('product_color/select-product_color-delete', [ProductColorController::class, 'deleteSelected']);

        //Order Status
        Route::get('/order_status', [OrderStatusController::class, 'index'])->name('order_statuses');
        Route::get('order_status/data', [OrderStatusController::class, 'indexData'])->name('order_statuses.data');
        Route::get('/order_status-create', [OrderStatusController::class, 'create'])->name('order_statuses.create');
        Route::post('/order_status-store', [OrderStatusController::class, 'store'])->name('order_statuses.store');
        Route::get('/order_status-edit/{id}', [OrderStatusController::class, 'edit'])->name('order_statuses.edit');
        Route::post('/order_status-update/{id}', [OrderStatusController::class, 'update'])->name('order_statuses.update');
        Route::get('/order_status-delete/{id}', [OrderStatusController::class, 'delete'])->name('order_statuses.delete');
        Route::post('order_status/select-order_status-delete', [OrderStatusController::class, 'deleteSelected']);
    });

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
            Route::post('/get-ifsc-code', [CompanyBankDetailController::class, 'getIFSC'])->name('get-ifsc-code');
            Route::delete('/company-bank-detail/{id}', [CompanyBankDetailController::class, 'deleteBankDetail'])->name('company.bank.delete');
            Route::get('/check-bank-account', [CompanyBankDetailController::class, 'checkBankAccount'])->name('check.bank.account');
            Route::get('/bank_details/{id}/edit', [CompanyBankDetailController::class, 'editBank'])->name('bank.edit');
            Route::post('/bank_details/{id}/update', [CompanyBankDetailController::class, 'updateBank'])->name('bank.update');

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

        Route::prefix('/product_model')->name('product_model.')->group(function () {

            Route::get('/', [ProductModelController::class, 'index'])->name('index');
            Route::get('/data', [ProductModelController::class, 'indexData'])->name('data');

            Route::get('/create', [ProductModelController::class, 'create'])->name('create');

            Route::post('/store', [ProductModelController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductModelController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ProductModelController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',  [ProductModelController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [ProductModelController::class, 'showDetails']);
            Route::post('/delete/selected', [ProductModelController::class, 'deleteSelected']);
            Route::post('/import', [ProductModelController::class, 'import'])->name('import');
            Route::get('/export', [ProductModelController::class, 'export']);
            Route::post('/check-name', [ProductModelController::class, 'checkName'])->name('checkName');
            Route::get('/product-model/{id}', [ProductModelController::class, 'getProductModel']);
            Route::post('/product-model/update', [ProductModelController::class, 'priceUpdate'])->name('product-model.update');
            Route::get('/product-model-history/{id}', [ProductModelController::class, 'getProductModelHistory']);

        });

        Route::prefix('/incentives')->name('incentives.')->group(function () {

            Route::get('/', [IncentiveController::class, 'index'])->name('index');
            Route::get('/data', [IncentiveController::class, 'indexData'])->name('data');

            Route::get('/create', [IncentiveController::class, 'create'])->name('create');
            Route::get('/get-models/{product_id}', [IncentiveController::class, 'getModels'])->name('get.models');

            Route::post('/store', [IncentiveController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [IncentiveController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [IncentiveController::class, 'update'])->name('update');
            Route::get('/delete/{id}',  [IncentiveController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [IncentiveController::class, 'showDetails']);
            Route::post('/delete/selected', [IncentiveController::class, 'deleteSelected']);
            Route::post('/import', [IncentiveController::class, 'import'])->name('import');
            Route::get('/export', [IncentiveController::class, 'export']);
            Route::get('/get-finishing-product-details/{id}', [IncentiveController::class, 'getFinishingProductDetails']);
        });

        Route::prefix('/finishing_product')->name('finishing_product.')->group(function () {

            Route::get('/', [FinishingProductController::class, 'index'])->name('index');
            Route::get('/data', [FinishingProductController::class, 'indexData'])->name('data');

            Route::get('/create', [FinishingProductController::class, 'create'])->name('create');
            Route::get('/get-models/{product_id}', [FinishingProductController::class, 'getModels'])->name('get.models');

            Route::post('/store', [FinishingProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FinishingProductController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [FinishingProductController::class, 'update'])->name('update');
            Route::get('/delete/{id}',  [FinishingProductController::class, 'delete'])->name('delete');
            Route::get('/show/{id}', [FinishingProductController::class, 'showDetails']);
            Route::post('/delete/selected', [FinishingProductController::class, 'deleteSelected']);
            Route::post('/import', [FinishingProductController::class, 'import'])->name('import');
            Route::get('/export', [FinishingProductController::class, 'export']);
        });

        Route::prefix('/order_detail')->name('order_detail.')->group(function () {

            Route::get('/', [OrderDetailController::class, 'index'])->name('index');
            Route::get('/data', [OrderDetailController::class, 'indexData'])->name('data');

            Route::get('/create', [OrderDetailController::class, 'create'])->name('create');

            Route::post('/store', [OrderDetailController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [OrderDetailController::class, 'edit'])->name('edit');
            Route::get('/add_order/{id}', [OrderDetailController::class, 'addOrder'])->name('add_order');
            Route::post('/update/{id}', [OrderDetailController::class, 'update'])->name('update');
            Route::post('/store_New_order/{id}', [OrderDetailController::class, 'storeNewOrder'])->name('store_New_order');
            Route::get('/delete/{id}',  [OrderDetailController::class, 'delete'])->name('delete');
            Route::get('/show/{id}', [OrderDetailController::class, 'showDetails']);
            Route::post('/delete/selected', [OrderDetailController::class, 'deleteSelected']);
            Route::post('/import', [OrderDetailController::class, 'import'])->name('import');
            Route::get('/export', [OrderDetailController::class, 'export']);
            Route::post('/check-name', [OrderDetailController::class, 'checkName'])->name('checkName');
            Route::get('/get-product-details', [OrderDetailController::class, 'getProductDetails']);
            Route::get('/getProductModels/{productId}', [OrderDetailController::class, 'getProductModels']);
        });

        Route::prefix('/employees')->name('employees.')->group(function () {

            Route::get('/', [EmployeeController::class, 'index'])->name('index');
            Route::get('/data', [EmployeeController::class, 'indexData'])->name('data');
    
            Route::post('/check-employee-code', [EmployeeController::class, 'checkEmployeeCode'])->name('check.employee.code');

            Route::get('/create', [EmployeeController::class, 'create'])->name('create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/show/{id}', [EmployeeController::class, 'showDetails'])->name('show');

            // Route::post('/step2', 'WizardController@storeStep2')->name('wizard.storeStep2');



            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/store_personal/{id}', [EmployeeController::class, 'storePersonal'])->name('store.personal');
            Route::post('/store_resign', [EmployeeController::class, 'storeResign'])->name('store.resign');
            Route::post('/store_rejoining', [EmployeeController::class, 'storeRejoining'])->name('store.rejoining');
            Route::post('/cancel_relieving', [EmployeeController::class, 'storeCancel'])->name('store.cancel_relieving');
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
            Route::get('/nominee/family/{id}', [EmployeeController::class, 'employeeFamily'])->name('nominee.family');
            Route::post('/nominee/update/{id}', [EmployeeController::class, 'updateNominee'])->name('nominee.update');
            Route::get('/nominee/delete/{id}', [EmployeeController::class, 'deleteNominee'])->name('nominee.delete');

            Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::get('/delete/{id}',  [EmployeeController::class, 'destroy'])->name('delete');
            // Route::get('/show/{id}', [EmployeeController::class, 'showDetails']);
            Route::post('/delete/selected', [EmployeeController::class, 'deleteSelected']);
            Route::post('/import', [EmployeeController::class, 'import'])->name('import');
            Route::get('/export', [EmployeeController::class, 'export']);
            Route::get('/printview/{id}', [EmployeeController::class, 'printView'])->name('printview');
            // routes/web.php
Route::get('/employee/{id}/family-members', [EmployeeController::class,'getFamilyMember'])->name('employee.family.members');

            Route::get('/get-client-companies', [EmployeeController::class, 'getClientCompanies'])->name('getClientCompanies');
            Route::get('/get-sub-client-companies', [EmployeeController::class, 'getSubClientCompanies'])->name('getSubClientCompanies');
            




        });
    });
    // Job Allocation
    // Master > Customer
    Route::prefix('job_allocation')->name('job_allocation.')->group(function () {
        Route::prefix('/direct_job_giving')->name('direct_job_giving.')->group(function () {
            Route::get('/', [DirectJobGivingController::class, 'index'])->name('index');
            Route::get('/data', [DirectJobGivingController::class, 'indexData'])->name('data');
            Route::get('/create', [DirectJobGivingController::class, 'create'])->name('create');
            Route::post('/store', [DirectJobGivingController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DirectJobGivingController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DirectJobGivingController::class, 'update'])->name('update');
            Route::get('/delete/{id}',  [DirectJobGivingController::class, 'destroy'])->name('delete');
            Route::post('/delete/selected', [DirectJobGivingController::class, 'deleteSelected']);
            Route::get('/get-model-details/{id}', [DirectJobGivingController::class, 'getModelDetails'])->name('get-models');
            Route::post('/import', [DirectJobGivingController::class, 'import'])->name('import');
            Route::get('/export', [DirectJobGivingController::class, 'export']);
            Route::get('/get-finishing-product-details/{id}', [DirectJobGivingController::class, 'getFinishingProductDetails']);
            Route::get('/getProductSize', [DirectJobGivingController::class, 'getProductSize']);
        });
        Route::prefix('/direct_job_received')->name('direct_job_received.')->group(function () {
            Route::get('/', [DirectJobReceivedController::class, 'index'])->name('index');
            Route::get('/data', [DirectJobReceivedController::class, 'indexData'])->name('data');
            Route::get('/create', [DirectJobReceivedController::class, 'create'])->name('create');
            Route::post('/store', [DirectJobReceivedController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DirectJobReceivedController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DirectJobReceivedController::class, 'update'])->name('update');
            Route::post('/delete/selected', [DirectJobReceivedController::class, 'deleteSelected']);
            Route::get('/get-model-details/{id}', [DirectJobReceivedController::class, 'getModelDetails'])->name('get-models');
            Route::get('/get-finishing-product-details/{id}', [DirectJobReceivedController::class, 'getFinishingProductDetails']);
             Route::get('/export', [DirectJobReceivedController::class, 'export']);
        });
    });


    // Job Allocation
    // Master > Customer
    Route::prefix('job_allocation')->name('job_allocation.')->group(function () {
        Route::prefix('/delivery_challan')->name('delivery_challan.')->group(function () {
            Route::get('/', [DeliveryChallanController::class, 'index'])->name('index');
            Route::get('/data', [DeliveryChallanController::class, 'indexData'])->name('data');
            Route::get('/create', [DeliveryChallanController::class, 'create'])->name('create');
            Route::post('/store', [DeliveryChallanController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DeliveryChallanController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DeliveryChallanController::class, 'update'])->name('update');
            Route::post('/delete/selected', [DeliveryChallanController::class, 'deleteSelected']);
            Route::get('/delete/{id}', [DeliveryChallanController::class, 'delete'])->name('delete');
            Route::get('/get-companies/{companyTypeId}', [DeliveryChallanController::class, 'getCompanies'])->name('get-companies');
            Route::get('/get-model-details/{id}', [DeliveryChallanController::class, 'getModelDetails'])->name('get-models');
            Route::get('/get-orders/{customerId}', [DeliveryChallanController::class, 'getOrders'])->name('get-orders');
            Route::get('/get-order-details/{orderId}', [DeliveryChallanController::class, 'getOrderDetails']);
            Route::post('/import', [DeliveryChallanController::class, 'import'])->name('import');
            Route::get('/export', [DeliveryChallanController::class, 'export']);
            Route::get('/get-product-model/{orderId}', [DeliveryChallanController::class, 'getProductModel']);
            Route::get('get-models-by-order-id', [DeliveryChallanController::class, 'getModelsByOrderId'])->name('getModelsByOrderId');
            Route::get('/get-product-details', [DeliveryChallanController::class, 'getProductDetails']);
            Route::get('/get-order-details', [DeliveryChallanController::class, 'getOrderDetails']);
            // routes/web.php
Route::get('/getSubCompanies/{companyId}', [DeliveryChallanController::class, 'getSubCompanies']);

        });

        Route::prefix('/job_giving')->name('job_giving.')->group(function () {
            Route::get('/', [JobGivingController::class, 'index'])->name('index');
            Route::get('/data', [JobGivingController::class, 'indexData'])->name('data');
            Route::get('/create', [JobGivingController::class, 'create'])->name('create');
            Route::post('/store', [JobGivingController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [JobGivingController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [JobGivingController::class, 'update'])->name('update');
            Route::post('/delete/selected', [JobGivingController::class, 'deleteSelected']);
            Route::get('/delete/{id}', [JobGivingController::class, 'delete'])->name('delete');
            Route::get('/get-order-details/{orderId}', [JobGivingController::class, 'getOrderDetails']);
            Route::get('/get-dc-details/{orderId}', [JobGivingController::class, 'getDcDetails']);
            Route::post('/import', [JobGivingController::class, 'import'])->name('import');
            Route::get('/export', [JobGivingController::class, 'export']);
            Route::get('/getQuantities/{id}', [JobGivingController::class, 'getQuantities']);
            Route::get('/get-model-details/{id}', [JobGivingController::class, 'getModelDetails'])->name('get-models');
            Route::get('/get-product-model/{orderId}', [JobGivingController::class, 'getProductModel']);
            Route::get('/get-company-name/{orderId}', [JobGivingController::class, 'getCompanyName']);
            Route::get('/fetch-order-ids', [JobGivingController::class, 'fetchOrderIds'])->name('fetch-order-ids');
        });

        Route::prefix('/job_received')->name('job_received.')->group(function () {
            Route::get('/', [JobReceivedController::class, 'index'])->name('index');
            Route::get('/data', [JobReceivedController::class, 'indexData'])->name('data');
            Route::post('/store', [JobReceivedController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [JobReceivedController::class, 'edit'])->name('edit');
            Route::get('/show/{id}', [JobReceivedController::class, 'showDetails']);
            Route::get('/export', [JobReceivedController::class, 'export']);
        });
        Route::prefix('/job_reallocation')->name('job_reallocation.')->group(function () {
            Route::get('/', [JobReallocationController::class, 'index'])->name('index');
            Route::get('/data', [JobReallocationController::class, 'indexData'])->name('data');
            Route::post('/store', [JobReallocationController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [JobReallocationController::class, 'edit'])->name('edit');
            Route::get('/cancel-job-giving/{id}', [JobReallocationController::class, 'cancelJobGiving'])->name('cancel_job_giving');
            Route::get('/export', [JobReallocationController::class, 'export']);
        });
    });

    // Report
    Route::prefix('report')->name('report.')->group(function () {
        Route::prefix('/employee_report')->name('employee_report.')->group(function () {
            Route::get('/', [EmployeeReportController::class, 'index'])->name('index');
            Route::get('/data', [EmployeeReportController::class, 'indexData'])->name('data');
            Route::get('/export', [EmployeeReportController::class, 'export']);
        });
        Route::prefix('/daily_given_report_cw')->name('daily_given_report_cw.')->group(function () {
            Route::get('/', [DailyGivenReportCompanyWiseController::class, 'index'])->name('index');
            Route::get('/data', [DailyGivenReportCompanyWiseController::class, 'indexData'])->name('data');
            Route::get('/export', [DailyGivenReportCompanyWiseController::class, 'export']);
        });

        Route::prefix('/job_received_report')->name('job_received_report.')->group(function () {
            Route::get('/', [JobReceivedReportController::class, 'index'])->name('index');
            Route::get('/data', [JobReceivedReportController::class, 'indexData'])->name('data');
            Route::get('/export', [JobReceivedReportController::class, 'export']);
        });

        Route::prefix('/job_allocation_report')->name('job_allocation_report.')->group(function () {
            Route::get('/', [JobReallocationReportController::class, 'index'])->name('index');
            Route::get('/data', [JobReallocationReportController::class, 'indexData'])->name('data');
            Route::get('/export', [JobReallocationReportController::class, 'export']);
        });

        Route::prefix('/outstanding_report')->name('outstanding_report.')->group(function () {
            Route::get('/', [OutStandingReport::class, 'index'])->name('index');
            Route::get('/data', [OutStandingReport::class, 'indexData'])->name('data');
            Route::get('/export', [OutStandingReport::class, 'export']);
        });

        Route::prefix('/total_wages')->name('total_wages.')->group(function () {
            Route::get('/', [TotalWagesReport::class, 'index'])->name('index');
            Route::get('/data', [TotalWagesReport::class, 'indexData'])->name('data');
            Route::get('/export', [TotalWagesReport::class, 'export']);
        });


        Route::prefix('/order_report')->name('order_report.')->group(function () {
            Route::get('/', [OrderReportController::class, 'index'])->name('index');
            Route::get('/data', [OrderReportController::class, 'indexData'])->name('data');
            Route::get('/export', [OrderReportController::class, 'export']);
        });
        Route::prefix('/direct_job_giving_report')->name('direct_job_giving_report.')->group(function () {
            Route::get('/', [DirectJobGivingReportController::class, 'index'])->name('index');
            Route::get('/data', [DirectJobGivingReportController::class, 'indexData'])->name('data');
            Route::get('/export', [DirectJobGivingReportController::class, 'export']);
        });
        Route::prefix('/direct_job_received_report')->name('direct_job_received_report.')->group(function () {
            Route::get('/', [DirectJobReceivedReportController::class, 'index'])->name('index');
            Route::get('/data', [DirectJobReceivedReportController::class, 'indexData'])->name('data');
            Route::get('/export', [DirectJobReceivedReportController::class, 'export']);
           
        });
    });




    //Data Fetch
    Route::get('/get-states/{countryId}', [AddressController::class, 'getStates'])->name('get-states');
    Route::get('/get-districts/{stateId}', [AddressController::class, 'getDistricts'])->name('get-districts');
    Route::get('/get-companies/{companyTypeId}', [EmployeeController::class, 'getCompanies'])->name('get-companies');
    Route::get('/get-sub-clients', [EmployeeController::class, 'getSubClients'])->name('get.sub.clients');
    Route::get('/get-authorised-person/{company}', [EmployeeController::class, 'getAuthorisedPerson']);


    

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
