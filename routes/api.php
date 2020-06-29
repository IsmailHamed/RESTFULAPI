<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * Buyers
 */
Route::resource("buyers", "Buyer\BuyerController", ['only' => ['index', 'show']]);

Route::resource("buyers.transactions", "Buyer\BuyerTransactionController", ['only' => ['index']]);

Route::resource("buyers.products", "Buyer\BuyerProductController", ['only' => ['index']]);

Route::resource("buyers.sellers", "Buyer\BuyerSellerController", ['only' => ['index']]);

Route::resource("buyers.categories", "Buyer\BuyerCategoryController", ['only' => ['index']]);

/**
 * Categories
 */
Route::resource("categories", "Category\CategoryController", ['except' => ['create', 'edit']]);

Route::resource("categories.products", "Category\CategoryProductController", ['only' => ['index']]);

Route::resource("categories.sellers", "Category\CategorySellerController", ['only' => ['index']]);

Route::resource("categories.transactions", "Category\CategoryTransactionController", ['only' => ['index']]);

Route::resource("categories.buyers", "Category\CategoryBuyerController", ['only' => ['index']]);

/**
 * Products
 */
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);

Route::resource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);

Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update', 'destroy']]);

Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);

Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);
/**
 * Sellers
 */
Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);

Route::resource('sellers.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);

Route::resource('sellers.products', 'Seller\SellerProductController', ['except' => ['create', 'show', 'edit']]);

Route::resource('sellers.categories', 'Seller\SellerCategoryController', ['only' => ['index']]);

Route::resource('sellers.transactions', 'Seller\SellerTransactionController', ['only' => ['index']]);
/**
 * Transactions
 */
Route::resource("transactions", "Transaction\TransactionController", ['only' => ['index', 'show']]);

Route::resource("transactions.categories", "Transaction\TransactionCategoryController", ['only' => ['index']]);

Route::resource("transactions.sellers", "Transaction\TransactionSellerController", ['only' => ['index']]);

/**
 * Users
 */
Route::name('me')->get('users/me', 'User\UserController@me');


Route::get("users/logout", "User\UserController@logout")->name('logout');

Route::resource("users", "User\UserController", ['except' => ['create', 'edit', 'logout']]);

Route::get("users/verify/{token}", "User\UserController@verify")->name('verify');

Route::get("users/{user}/resend", "User\UserController@resend")->name('resend');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::post("users/login", "User\UserController@login")->name('login');

/**
 * Roles
 */
Route::get("roles/checkRoleName", "Role\RoleController@checkRoleName")->name('checkRoleName');
Route::resource('roles', 'Role\RoleController');
Route::resource("roles.permissions", "Role\RolePermissionController", ['only' => ['index']]);


/**
 * Permission
 */
Route::resource('permissions', 'Permission\PermissionController');
