<?php

use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Period;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChacheController;
use App\Http\Controllers\VideoTutorialController;


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


Route::get('/',[FrontEndController::class,'frontPage'])->name('front.page');
Route::get('/view-products',[App\Http\Controllers\FrontEndController::class,'allProducts'])->name('view.all.products');
Route::get('view-single-product/{slug}',[FrontEndController::class,'singleProduct'])->name('single.product');
Route::get('view-cate-products/{id}',[FrontEndController::class,'cateProducts'])->name('cate.products');
Route::post('/submit-search',[FrontEndController::class,'submitSearch'])->name('submit.search');
Route::get('/video-tutorials',[App\Http\Controllers\FrontEndController::class,'videoTutorials'])->name('video.tutorials');
Route::get('/picture-tutorials',[App\Http\Controllers\FrontEndController::class,'pictureTutorials'])->name('picture.tutorials');
Route::get('/submite-your-own-craft',[App\Http\Controllers\FrontEndController::class,'submitYourCraft']);
Route::post('submit-your-craft',[App\Http\Controllers\FrontEndController::class,'submitCraft']);
Route::get('/search-product-list',[App\Http\Controllers\FrontEndController::class,'searchProduct']);
Route::post('submit-search',[App\Http\Controllers\FrontEndController::class,'submitSearch'])->name('search');
Route::post('/add-to-cart',[App\Http\Controllers\CartController::class,'addToCart'])->name('add.to.cart');
Route::post('/buy-now',[App\Http\Controllers\CartController::class,'buyNow'])->name('buy.now');
Route::put('/update-cart',[App\Http\Controllers\CartController::class,'updateCart'])->name('update.cart');
Route::get('/load-cart-item',[App\Http\Controllers\CartController::class,'loadCart'])->name('load.cart');
Route::get('/view-cart',[App\Http\Controllers\CartController::class,'viewCart'])->name('view.cart');
Route::get('delete_cart_item/{id}',[App\Http\Controllers\CartController::class,'deleteCartItem'])->name('delete.cart.item');
Route::get('/checkout-page',[App\Http\Controllers\CheckoutController::class,'checkoutPage'])->name('view.checkout');
Route::post('/place-order',[App\Http\Controllers\CheckoutController::class,'placeOrder'])->name('place.order');
Route::post('/check-coupon-code',[App\Http\Controllers\CheckoutController::class,'checkCoupon'])->name('check.coupon');
Route::get('/terms-and-condition',[App\Http\Controllers\FrontEndController::class,'termsAndCondition'])->name('terms.condition');
Route::get('/privacy-policy',[App\Http\Controllers\FrontEndController::class,'privacyPolicy'])->name('privacy.policy');
Route::get('/return-policy',[App\Http\Controllers\FrontEndController::class,'returnPolicy'])->name('return.policy');
Route::get('/customers-feedback','App\Http\Controllers\FrontEndController@customersFeedback')->name('customers.feedback');
Route::post('/submit-review','App\Http\Controllers\FrontEndController@submitReview')->name('submit.feedback');

// Blogs.........

Route::get('view-blog/{id}',[App\Http\Controllers\BlogController::class,'picturalTutorial']);

// Login & Dashboard Routes.......................................
Route::group(['middleware'=>'alreadyLoggedIn'],function(){
 Route::get('/admin/login',[App\Http\Controllers\LoginController::class,'LoginPage'])->name('login.page');
});

Route::post('admin/login',[App\Http\Controllers\LoginController::class,'adminLogin'])->name('admin.login');
Route::group(['middleware'=>'isLoggedIn'],function(){
Route::get('/dashboard',[App\Http\Controllers\BackEndController::class,'dashboard'])->name('admin.dashboard');
Route::get('/logout',[App\Http\Controllers\LoginController::class,'adminLogout'])->name('admin.logout');
// Products Routes.......................................
Route::get('/product-lists',[App\Http\Controllers\BackEndController::class,'productList'])->name('view.products');
Route::post('/add-product',[App\Http\Controllers\BackEndController::class,'addProduct'])->name('add.product');
Route::get('edit-product/{id}',[App\Http\Controllers\BackEndController::class,'editProduct'])->name('edit.product');
Route::put('update-product/{id}',[App\Http\Controllers\BackEndController::class,'updateProduct'])->name('update.product');
Route::delete('delete/{id}',[App\Http\Controllers\BackEndController::class,'deleteProduct'])->name('delete.product');
Route::delete('deleteimage/{id}',[App\Http\Controllers\BackEndController::class,'deleteImage'])->name('delete.images');
// Category Routes.......................................
Route::get('/category-list',[App\Http\Controllers\BackEndController::class,'viewCategory'])->name('view.category');
Route::post('/add-new-category',[App\Http\Controllers\BackEndController::class,'addCategory'])->name('add.category');
Route::get('edit_category/{id}',[App\Http\Controllers\BackEndController::class,'editCategory'])->name('edit.category');
Route::put('update-category',[App\Http\Controllers\BackEndController::class,'updateCategory'])->name('update.category');
Route::get('edit_category-delete/{id}',[App\Http\Controllers\BackEndController::class,'editCateDelete'])->name('edit.delete.category');
Route::put('/delete-category',[App\Http\Controllers\BackEndController::class,'deleteCategory'])->name('delete.category');

// Product Attributs Route.................................................

Route::get('/attribute-list',[App\Http\Controllers\BackEndController::class,'productAttributs'])->name('product.attributes');
Route::post('/add-attribute',[App\Http\Controllers\BackEndController::class,'addAttribute'])->name('add.attribute');
Route::get('attribute-value/{id}',[App\Http\Controllers\BackEndController::class,'attributeValues'])->name('value.attribute');

// Orders routes.............................................
Route::get('/orders-list',[App\Http\Controllers\BackEndController::class,'orderList'])->name('view.orders');
Route::get('edit_order/{id}',[App\Http\Controllers\BackEndController::class,'editOrder'])->name('edit.order');
Route::put('update-order',[App\Http\Controllers\BackEndController::class,'updateOrder'])->name('update.order');
Route::get('view-single-order/{id}',[App\Http\Controllers\BackEndController::class,'viewSingleOrder'])->name('view.single.order');
Route::get('edit_delete_order/{id}',[App\Http\Controllers\BackEndController::class,'editDeleteOrder'])->name('edit.delete.order');
Route::put('delete-order',[App\Http\Controllers\BackEndController::class,'DeleteOrder'])->name('delete.order');

// Blogs Routes......................

Route::get('/manage-blogs',[App\Http\Controllers\BlogController::class,'viewBlogLists']);
Route::get('/add-blog',[App\Http\Controllers\BlogController::class,'createBlog']);
Route::post('/add-new-blog-step1','App\Http\Controllers\BlogController@addBlogStep1');
Route::get('/blog-id',[App\Http\Controllers\BlogController::class,'getBlogId']);
Route::post('add-blog-content',[App\Http\Controllers\BlogController::class,'addBlogContent']);
Route::put('delete-blog/{id}',[App\Http\Controllers\BlogController::class,'deleteBlog']);
Route::get('/manage-video-tutorials',[App\Http\Controllers\VideoTutorialController::class,'videoTutorials']);
Route::post('/add-new-video','App\Http\Controllers\VideoTutorialController@addVideo');
Route::get('edit-video/{id}',[App\Http\Controllers\VideoTutorialController::class,'editVideoTutorial']);
Route::put('update-video-tutorial',[App\Http\Controllers\VideoTutorialController::class,'updateVideoTutorial']);
Route::delete('delete-video-tutorial/{id}',[App\Http\Controllers\VideoTutorialController::class,'deleteVideoTutorial']);

// Product Attributs Route.............................................................................
Route::get('/google-analytics-report',[App\Http\Controllers\AnalyticsController::class,'gAreport']);

});

// Chaches Routes.........................................................................
Route::get('/optimize','App\Http\Controllers\ChacheController@Optimize');
Route::get('/config-chache','App\Http\Controllers\ChacheController@ConfigChached');
Route::get('/route-chache','App\Http\Controllers\ChacheController@RouteChached');
Route::get('/cache-clear','App\Http\Controllers\ChacheController@onlyCacheCleare');
Route::get('/route-clear','App\Http\Controllers\ChacheController@RouteClear');
Route::get('/config-clear','App\Http\Controllers\ChacheController@ConfigClear');
Route::get('/view-cache','App\Http\Controllers\ChacheController@viewCache');
Route::get('/view-clear','App\Http\Controllers\ChacheController@viewCleare');

// Route::get('/post-api-orders','App\Http\Controllers\ProductController@testOrders');




