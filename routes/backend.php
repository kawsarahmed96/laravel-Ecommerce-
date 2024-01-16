<?php


use Faker\Guesser\Name;
use App\Models\Shipping;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Role_PermissionController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\InventoryController;

//Dashboard Route

Route::middleware('auth')->prefix('dashboard')->name('backend.')->group(function () {
    Route::get('/', [BackendController::class, 'index'])->name('backend.index');

    Route::controller(Role_PermissionController::class)->group(function () {

        // Permission route
        Route::get('/permission/list', 'permissionList')->name('permission');
        Route::post('/permission/store', 'permissionStore')->name('permission.store');

        // Role route
        Route::get('/role/list', 'rolelist')->name('role.list');
        Route::get('/role/create', 'roleCreate')->name('role.create');
        Route::post('/role/store', 'roleStore')->name('role.store');
        Route::get('/role/edit/{id}', 'roleEdit')->name('role.edit');
        Route::post('/role/update/{id}', 'roleUpdate')->name('role.update');
        Route::get('/role/destroy/{id}', 'roleDestroy')->name('role.destroy');

        //user route
        Route::get('/user/list', 'userList')->name('user.list');
        Route::get('/user/create', 'userCreate')->name('user.create');
        Route::post('/user/store', 'userStore')->name('user.store');
        Route::get('/user/edit/{id}', 'userEdit')->name('user.edit');
        Route::put('/user/update/{id}', 'userUpdate')->name('user.update');

        Route::get('/user/destroy/{id}', 'userDestroy')->name('user.destroy');

    });

    // // product Management

    Route::name('productmanagement.')->group(function () {

        // product route

        Route::resource('Product', ProductController::class);

        Route::get('/product/trash/list', [ProductController::class, 'productTrashList'])->name('product.trash.list');

        Route::get('/product/trash/restore/{id}', [ProductController::class, 'productTrashRestore'])->name('product.trash.restore');

        Route::delete('/product/trash/delete/{id}', [ProductController::class, 'productTrashDelete'])->name('product.trash.delete');

        // Category route

        Route::resource('Category', CategoryController::class);

        Route::resource('Size', SizeController::class);

        Route::resource('Inventory', InventoryController::class);

        //color data list

        Route::resource('Color', ColorController::class);

        Route::get('/color/list', [ColorController::class, 'colorDataList'])->name('color.data.list');


        // Coupon-----------------
        Route::resource('coupon', CouponController::class);

        // shipping __________________

        Route::resource('Shipping',ShippingController::class);

    });

});

Route::get('/email', [BackendController::class, 'ResetPass'])->name('reset.pass');
