<?php

use App\Http\Controllers\backend\AttributeController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\OptionController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\SalesDataController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\BraintreeController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\CategoryFrontController;
use App\Http\Controllers\frontend\CustomerFrontController;
use App\Http\Controllers\frontend\DashboardFrontController;
use App\Http\Controllers\frontend\ProductFrontController;
use App\Http\Controllers\frontend\SubCategoryFrontController;
use App\Http\Controllers\StripeController;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\ValidateRole;

// Route::get('/', function () {
//     return view('frontend\index');
// });

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [DashboardFrontController::class, 'dashboard']);
// Route::get('/', function () {
//     return redirect('/dashboard');
// });


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(ValidateRole::class)->group(function () {

        Route::get('category_list', [CategoryController::class, 'category_list']);
        Route::match(['get', 'post'], 'add_category', [CategoryController::class, 'add_category']);
        Route::get('edit_category/{id}', [CategoryController::class, 'edit_category']);
        Route::post('edit_category/{id}', [CategoryController::class, 'edit_category']);
        Route::get('delete/{id}', [CategoryController::class, 'delete']);

        Route::get('subcategory_list', [SubCategoryController::class, 'subcategory_list']);
        Route::match(['get', 'post'], 'add_subcategory', [SubCategoryController::class, 'add_subcategory']);
        Route::match(['get', 'post'], 'edit_subcategory/{id}', [SubCategoryController::class, 'edit_subcategory']);
        Route::get('delete_subcategory/{id}', [SubCategoryController::class, 'delete_subcategory']);

        Route::get('product_list', [ProductController::class, 'product_list']);
        Route::match(['get', 'post'], 'add_product', [ProductController::class, 'add_product']);
        Route::match(['get', 'post'], 'edit_product/{id}', [ProductController::class, 'edit_product']);
        Route::get('delete_product/{id}', [ProductController::class, 'delete_product']);
        Route::post('delete_image/', [ProductController::class, 'delete_image']);
        Route::post('delete_option/', [ProductController::class, 'delete_option']);

        Route::post('get_option_values', [ProductController::class, 'get_option_values']);

        Route::post('save_new_attribute', [ProductController::class, 'save_new_attribute']);

        Route::get('attribute_list', [AttributeController::class, 'attribute_list']);
        Route::match(['get', 'post'], 'add_attribute', [AttributeController::class, 'add_attribute']);
        Route::match(['get', 'post'], 'edit_attribute/{id}', [AttributeController::class, 'edit_attribute']);
        Route::get('delete_attribute/{id}', [AttributeController::class, 'delete_attribute']);

        Route::get('option_list', [OptionController::class, 'option_list']);
        Route::match(['get', 'post'], 'add_option', [OptionController::class, 'add_option']);
        Route::match(['get', 'post'], 'edit_option/{id}', [OptionController::class, 'edit_option']);
        Route::get('delete_option/{id}', [OptionController::class, 'delete_option']);

        Route::get('orders', [OrderController::class, 'order_list']);
        Route::get('order_details/{id}', [OrderController::class, 'order_details']);
        Route::post('change_order_status', [OrderController::class, 'change_order_status']);

        Route::get('/coupons', [CouponController::class, 'coupon_list']);
        Route::any('/create_coupon', [CouponController::class, 'create_coupons']);

        Route::get('/sales', [SalesDataController::class, 'barChart']);

        Route::any('/roles', [RolesController::class, 'get_role']);
        Route::any('/set_role', [RolesController::class, 'set_role']);
        Route::get('delete_role/{id}', [RolesController::class, 'delete_role']);

        Route::any('/permission', [PermissionController::class, 'get_permission']);
        Route::any('/set_permission', [PermissionController::class, 'set_permission']);

        Route::get('/users', [UserController::class, 'get_user']);
        Route::post('/change_role', [UserController::class, 'change_role']);
        Route::get('/user_permissions/{id}',[UserController::class,'user_permissions']);
        Route::post('/remove_permission',[UserController::class,'remove_permission']);
    });
});

//==================== front end =======================

//home
Route::get('frontend/category/{id}', [CategoryFrontController::class, 'get_category_info']);
Route::get('frontend/subcategory/{id}', [SubCategoryFrontController::class, 'get_subcategory_info']);
Route::get('frontend/product/{id}', [ProductFrontController::class, 'product_description']);

//cart
Route::post('add_to_cart/{id}', [CartController::class, 'add_to_cart']);
Route::post('update_cart_quantity', [CartController::class, 'update_cart_quantity']);
Route::get('view_cart', [CartController::class, 'view_cart']);
Route::get('remove_cart/{id}', [CartController::class, 'remove_cart']);

//login
Route::get('customer_login', [CustomerFrontController::class, 'customer_login']);
Route::post('customer_login', [CustomerFrontController::class, 'customer_login']);

//registration
Route::get('customer_register', [CustomerFrontController::class, 'customer_register_form']);
Route::post('customer_register', [CustomerFrontController::class, 'customer_register']);
Route::get('customer_logout', [CustomerFrontController::class, 'logout']);

//checkout
Route::get('checkout', [CheckoutController::class, 'checkout']);
Route::post('checkout', [CheckoutController::class, 'token']);

//braintree
Route::any('/braintree_payment', [CheckoutController::class, 'token'])->name('braintree');

//stripe
Route::any('/stripe_payment', [StripeController::class, 'showPaymentForm'])->name('stripe');
Route::post('/process-payment', [StripeController::class, 'stripe'])->name('stripe.post');

//coupons
Route::get('/available_coupons', [CheckoutController::class, 'get_coupon']);
Route::post('validate_coupon', [CheckoutController::class, 'validate_coupon']);

//order
Route::get('frontend/customers_order', [CustomerFrontController::class, 'customers_order'])->name('my_orders');
Route::get('frontend/order_details/{id}', [CustomerFrontController::class, 'customers_order']);
Route::post('cancle_order/{id}', [CustomerFrontController::class, 'cancle_order'])->name('cancle_order');

//Mail
Route::get('ordre_confiremd_mail', [OrderShipped::class, 'content']);
// Route::get('email-test', function(){
//     $details['email'] = 'your_email@gmail.com';
//     dispatch(new App\Jobs\SendEmailJob($details));
//     dd('done');
//     });

Route::get('email-test', [CheckoutController::class, 'sendEmail']);


require __DIR__ . '/auth.php';
