<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['guestOrVerified'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('home');
     Route::get('/product_list', [ProductController::class, 'allProducts'])->name('product.list');
    Route::get('/category/{category:slug}', [ProductController::class, 'byCategory'])->name('byCategory');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
     Route::group(['prefix'=>'pages'], function(){
      Route::name('page.')->group(function(){
       Route::controller(PageController::class)->group(function(){
       Route::get('contact', 'contact')->name('contact');
       Route::get('about', 'about')->name('about');
       Route::get('term', 'term')->name('term');
       Route::get('faq', 'faq')->name('faq');
       Route::get('privacy', 'privacy')->name('privacy');
   
       });
      });
    });

     Route::group(['prefix'=>'questions'], function(){
      Route::name('question.')->group(function(){
       Route::controller(QuestionController::class)->group(function(){
       Route::post('store_question/{id?}', 'store')->name('store');

   
       });
      });
    });
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.update');
    Route::post('/profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('profile_password.update');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/{order}', [CheckoutController::class, 'checkoutOrder'])->name('cart.checkout-order');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'view'])->name('order.view');
});

Route::group(['middleware' => 'auth', 'verified', 'admin'],function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::get('/categories/tree', [CategoryController::class, 'getAsTree']);
    Route::get('/index/products', [ProductAdminController::class, 'index'])->name('product.index');
     Route::post('/store_product', [ProductAdminController::class, 'store'])->name('product.storeProduct');
    Route::group(['prefix'=>'products'], function(){
      Route::name('product.')->group(function(){
       Route::controller(ProductController::class)->group(function(){
        Route::post('create/product_category', 'createProductCategory')->name('categoryStore');
        Route::get('product_category/{uuid}', 'readProductCategory');
        Route::put('update/product_category/{uuid}', 'updateProductCategory');
        Route::get('product_categories', 'readAllProductCategories')->name('categories');
        Route::get('product_categories', 'AllProductCategories')->name('viewCategories');
        Route::get('all/products', 'index')->name('products');
        Route::get('categories', 'category')->name('category');
        Route::get('products/{product_categories_uuid}', 'show');
        Route::post('create/product', 'store')->name('store');
        Route::post('add_item/cart', 'addCartItem')->name('addCartItem');
        Route::post('update_item//quantity', 'updateQuantity')->name('updateQuantity');
        Route::put('update/product/{uuid}', 'update');
        Route::delete('delete/product/{uuid}', 'destroy');
       });
      });
    });


    Route::group(['prefix'=>'banners'], function(){
      Route::name('banner.')->group(function(){
       Route::controller(BannerController::class)->group(function(){
       Route::get('index', 'index')->name('index');
       Route::post('store', 'store')->name('store');
       });
      });
    });

     

    //user
    // Route::get('user/info', [\App\Http\Controllers\UserController::class, 'userinfo']);
    // Route::put('user/info/update', [\App\Http\Controllers\UserController::class, 'updateUser']);
    // //business
    // Route::post('create/business_unit', [\App\Http\Controllers\BusinessController::class, 'createBusinessUnit']);
    // Route::get('business_units', [\App\Http\Controllers\BusinessController::class, 'businessUnits']);
    // Route::put('business/{uuid}', [\App\Http\Controllers\BusinessController::class, 'updateBusiness']);
    // Route::put('businessunit/{uuid}', [\App\Http\Controllers\BusinessController::class, 'updateBusinessUnit']);
    // Route::delete('delete/business/{uuid}', [\App\Http\Controllers\BusinessController::class, 'deleteBusiness']);
    // Route::delete('delete/businessunit/{uuid}', [\App\Http\Controllers\BusinessController::class, 'deleteBusinessUnit']);
    //products


    // // customers
    // Route::post('/customers', [CustomerController::class, 'create']);
    // Route::get('/customer/{uuid}', [CustomerController::class, 'read']);
    // Route::get('/customers/all', [CustomerController::class, 'readAllCustomers']);
    // Route::put('/customer/update/{uuid}', [CustomerController::class, 'update']);
    // Route::delete('/customer/delete/{uuid}', [CustomerController::class, 'delete']);

    // // supplier
    // Route::get('/suppliers', [SupplierController::class, 'index']);
    // Route::get('/supplier/{uuid}', [SupplierController::class, 'show']);
    // Route::post('/supplier', [SupplierController::class, 'store']);
    // Route::put('/supplier/{uuid}', [SupplierController::class, 'update']);
    // Route::delete('/supplier/delete/{uuid}', [SupplierController::class, 'destroy']);

    // //sales
    // Route::post('/store-sales', [OrdersController::class, 'store']);
    // Route::get('/sales-orders', [OrdersController::class, 'displaySalesAndOrders']);
    // Route::get('/single-sales-orders', [OrdersController::class, 'getSingleSalesAndOrders']);
    // Route::put('/sale-update/{id}', [OrdersController::class, 'update']);
    // Route::delete('/delete-sales-orders/{salesId}/{businessUnitId}', [OrdersController::class, 'deleteSalesWithOrders']);

    // Route::post('payments', [PaymentsController::class, 'processPayment']);
    // Route::put('payment/update/{uuid}', [PaymentsController::class, 'editPayment']);
    // Route::get('payment/{uuid}', [PaymentsController::class, 'viewPayment']);
    // Route::delete('payment/delete/{uuid}', [PaymentsController::class, 'deletePayment']);

});


require __DIR__.'/auth.php';
