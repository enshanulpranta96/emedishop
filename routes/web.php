<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ManageVendorsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\Emedishop\CartController;
use App\Http\Controllers\Emedishop\EmedishopController;
use App\Http\Controllers\Emedishop\HomeController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Vendor\ProductsController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\ManageOrderController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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



//emedishop
Route::get('/', [HomeController::class, 'home'])->name('index');

//emedishop pages
Route::get('/medicine-store', [EmedishopController::class, 'mediStore'])->name('medi_store');
Route::get('/codiv-19', [EmedishopController::class, 'covid'])->name('codiv_19');
Route::get('/baby-mom', [EmedishopController::class, 'babyAndMom'])->name('baby_mom');
Route::get('/female-hygiene', [EmedishopController::class, 'femaleHygiene'])->name('female_hygiene');
Route::get('/beauty-care', [EmedishopController::class, 'beautyCare'])->name('beauty_care');
Route::get('/diabetic', [EmedishopController::class, 'diabetic'])->name('diabetic');
Route::get('/personal-care', [EmedishopController::class, 'personalCare'])->name('personal_care');
Route::get('/sexual-wellbeing', [EmedishopController::class, 'sexualWellbeing'])->name('sexual_wellbeing');

Route::get('/contact', [EmedishopController::class, 'contact'])->name('contact');

Route::post('/product-details', [EmedishopController::class, 'productDetails'])->name('prodcut_details');
Route::post('/add-to-cart', [EmedishopController::class, 'addToCart'])->name('addToCart');

//search
Route::post('/search', [EmedishopController::class, 'search'])->name('search');

//get cart list to cart page by axios
Route::get('/getCartList', [CartController::class, 'getCartList']);

Route::get('/shopCartCount', [HomeController::class, 'shopCartCount']);

Route::post('/addQuantity', [CartController::class, 'addQuantity']);
Route::post('/reduceQuantity', [CartController::class, 'reduceQuantity']);
Route::post('/removeFromCart', [CartController::class, 'removeFromCart']);

//show all categories to sidebar
Route::get('/show-all-categories', [HomeController::class, 'showAllCategories']);

//dynamic category
Route::get('/category/{cat}', [HomeController::class, 'category']);

//checkout page
Route::post('/user/create-address', [OrderController::class, 'createAddress']);
Route::post('/user/create-order', [OrderController::class, 'createOrder']);
Route::get('/getOrders', [UserProfileController::class, 'getOrders']);
Route::post('/update-profile', [UserProfileController::class, 'updateProfile']);
Route::post('/upload/prescription', [OrderController::class, 'uploadPrescription']);

//Conversations
Route::post('/replay-message', [ConversationsController::class, 'replayMsg']);
Route::post('/get-conversation', [ConversationsController::class, 'getConversation']);

Route::post('/sendMsg', [ConversationsController::class, 'sendMsg']);
Route::post('/getChat', [ConversationsController::class, 'getChat']);
Route::post('/getMembers', [ConversationsController::class, 'getMembers']);

Route::post('/get-chat', [ConversationsController::class, 'getChat']);

//user only
Route::get('/chat/{ticket_id}', [ConversationsController::class, 'chatWithVendor'])->name('chatWithVendor');
Route::get('chat/{user2}/{user2_id}', [ConversationsController::class, 'vendorchat'])->name('vendor.chat');
Route::get('all/chat', [ConversationsController::class, 'allChat'])->name('all.chat');

//admin_chat
Route::get('admin_chat/chat', [ConversationsController::class, 'admin_chat'])->name('admin_chat');
//chat page admin
Route::get('admin/chat/{ticket_id}', [ConversationsController::class, 'adminChatPage'])->name('adminChatPage');


//vendor_chat
Route::get('vendor_chat/chat', [ConversationsController::class, 'vendor_chat'])->name('vendor_chat');
//chat page vendor
Route::get('vendor/chat/{ticket_id}', [ConversationsController::class, 'vendorChatPage'])->name('vendorChatPage');

// Route::post('/chatWithVendor', [ConversationsController::class, 'chatWithVendor'])->name('chatWithVendor');



//getOrderDetails
Route::post('/getOrderDetails', [ManageOrderController::class, 'getOrderDetails']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix('user')->name('user.').group(function(){

// });

//user prefix
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'emedishop.login')->name('login');
        Route::view('/register', 'emedishop.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
        Route::get('/', [HomeController::class, 'home'])->name('index');

        Route::get('/without_auth', [CartController::class, 'without_auth'])->name('withoutauth');
    });

    Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
        // Route::view('/home', 'dashboard.user.index')->name('index');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');

        //emedishop
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::get('/addToCart/{product_id}/{price}', [CartController::class, 'addToCart'])->name('addToCart');

        Route::get('/checkout', [checkoutController::class, 'checkout'])->name('checkout');
        Route::get('/profile', [UserProfileController::class, 'userProfile'])->name('profile');

        // Route::post('/chatWithVendor', [ConversationsController::class, 'chatWithVendor'])->name('chatWithVendor');

        // Route::post('/addToCart', [CartController::class, 'addToCart']);
    });
});


//admin prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::view('/register', 'dashboard.admin.register')->name('register');
        //admin login validation check
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        // Route::view('/home', 'dashboard.admin.home')->name('home');
        Route::get('/home', [AdminController::class, 'home'])->name('home');

        //users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users-request', [UserController::class, 'request'])->name('users.request');
        Route::get('/action/{id}/{acc_status}', [UserController::class, 'action'])->name('users.action');
        Route::get('/active_user/{id}', [UserController::class, 'active_user'])->name('users.action.active');

        //vendors
        Route::get('/manage_vendors', [ManageVendorsController::class, 'index'])->name('vendors');
        Route::get('/vendors-request', [ManageVendorsController::class, 'request'])->name('vendors.request');
        Route::get('/vendors_action/{id}/{acc_status}', [ManageVendorsController::class, 'action'])->name('vendors.action');
        Route::get('/active_vendor/{id}', [ManageVendorsController::class, 'active_user'])->name('vendor.action.active');

        //categories
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
        Route::post('/add_categories', [CategoriesController::class, 'add'])->name('categories.add');
        Route::post('/update_categories', [CategoriesController::class, 'update'])->name('categories.update');
        Route::get('/delete_categories/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');

        //chat
        


        // Route::view('/users', 'dashboard.admin.users.users')->name('users');

        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

//vendor prefix
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::middleware(['guest:vendor'])->group(function () {
        Route::view('/login', 'dashboard.vendor.login')->name('login');
        Route::view('/register', 'dashboard.vendor.register')->name('register');
        Route::post('/create', [VendorController::class, 'create'])->name('create');
        Route::post('/check', [VendorController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:vendor', 'PreventBackHistory'])->group(function () {
        // Route::view('/home', 'dashboard.vendor.home')->name('home');
        Route::get('/home', [VendorController::class, 'home'])->name('home');
        Route::get('/products', [ProductsController::class, 'getProducts'])->name('products');
        Route::get('/create-product', [ProductsController::class, 'createProductPage'])->name('product.create');
        Route::post('/create_new_product', [ProductsController::class, 'createProduct'])->name('product.create.new');

        Route::post('/edit_product', [ProductsController::class, 'editProduct'])->name('product.editproduct');

        Route::post('/update', [ProductsController::class, 'update'])->name('product.update');
        Route::get('/delete_product/{id}', [ProductsController::class, 'deleteProduct'])->name('product.delete');
        // Route::view('/home', 'dashboard.vendor.home')->name('home');

         // Manage Orders
         Route::get('/orders', [ManageOrderController::class, 'ManageOrders'])->name('manage.orders');
         Route::post('/order_status', [ManageOrderController::class, 'orderStatus'])->name('order.status');
         Route::get('/new-orders', [ManageOrderController::class, 'newOrders'])->name('new.orders');

        


        Route::post('/logout', [VendorController::class, 'logout'])->name('logout');
    });
});
