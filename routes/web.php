<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\AsigmentController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\WidgetsController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ProductController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
  return to_route('login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
  // Dashboards
  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard.index');
  // Locale
  Route::get('setlocale/{locale}', SetLocaleController::class)->name('setlocale');

  // User
  Route::resource('users', UserController::class);
  // Permission
  Route::resource('permissions', PermissionController::class)->except(['show']);
  // Roles
  Route::resource('roles', RoleController::class);
  // Profiles
  Route::resource('profiles', ProfileController::class)->only(['index', 'update'])->parameter('profiles', 'user');
  // Env
  Route::singleton('general-settings', GeneralSettingController::class);
  Route::post('general-settings-logo', [GeneralSettingController::class, 'logoUpdate'])->name('general-settings.logo');

  // Database Backup
  Route::resource('database-backups', DatabaseBackupController::class);
  // Areas 
  Route::resource('areas', AreaController::class);
  Route::controller(AreaController::class)->prefix('areas')->as('areas.')->group(function () {
    Route::get('asign/{area}', 'asign')->name('asign');
    Route::post('asign/{area}', 'asignProduct')->name('asignProduct');
  });


  // Product
  Route::resource('products', ProductController::class);
  Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {
    Route::post('asign-product/{product}', 'asignProduct')->name('asignProduct');
  });


  // Asigments
  Route::resource('area-products', AsigmentController::class);
  Route::post('area-products-update-amount', [AsigmentController::class, 'updateAmount']);
  Route::get('database-backups-download/{fileName}', [DatabaseBackupController::class, 'databaseBackupDownload'])->name('database-backups.download');
});
