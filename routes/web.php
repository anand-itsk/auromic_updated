<?php

use App\Http\Controllers\MasterSetting;
use App\Http\Controllers\PageControllers\MasterCompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
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
    // Roles
    // permission
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permission-create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission-store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission-edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission-update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permission-delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');

    //Role

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role-update/{id}', [RoleController::class, 'update'])->name('role.update');


    //Pages
    Route::get('/master-companies', [MasterCompanyController::class, 'index'])->name('master-companies');
});

    // master settings
