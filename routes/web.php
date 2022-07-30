<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubCategoryController;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout',[AdminController::class, 'Logout'])->name('admin.logout');

// User management all the routes

Route::prefix('users')->group(function(){

    Route::get('/view',[UserController::class, 'UserView'])->name('user.view');

    Route::get('/add',[UserController::class, 'UserAdd'])->name('user.add');

    Route::post('/store',[UserController::class, 'UserStore'])->name('users.store');

    Route::get('/edit/{id}',[UserController::class, 'UserEdit'])->name('users.edit');

    Route::post('/update/{id}',[UserController::class, 'UserUpdate'])->name('users.update');
});

  // Admin Category all Routes  
  Route::prefix('category')->group(function(){

    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('category.view');
    
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    
    Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    
    // Admin Sub Category All Routes
    
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('subCategory.view');
    
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    
    Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    
    });


    Route::prefix('product')->group(function(){

        Route::get('/add', [ProductController::class, 'AddProduct'])->name('product.add');
        
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
        
        Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
        
        Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
        
        Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
        
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        
        Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
        
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
        
        Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
        
        Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
        
        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');


        // Order
        Route::get('/ship/{id}', [ProductController::class, 'ShipProduct'])->name('product.ship');

        Route::post('ship/store', [ProductController::class, 'ShipStoreProduct'])->name('product-ship-store');

        Route::get('shipped/order', [ProductController::class, 'Orders'])->name('shipped-product');

        Route::get('order/edit/{id}', [ProductController::class, 'EditOrder'])->name('order.edit');
         
        });

            // Admin Reports Routes 
    Route::prefix('reports')->group(function(){

        Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
    
        Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
    
        Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
    
        Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
    
        
        
        });




