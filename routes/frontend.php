<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Frontend\Controllers\CouponController;

use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\SslCommerzPaymentController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::get('/shop', [ShopController::class, 'index'])->name('frontend.shop.index');

Route::get('/shop/category/{id}', [ShopController::class, 'categoryProduct'])->name('frontend.shop.category');

Route::get('/shop/cart/{slug}', [ShopController::class, 'singleProduct'])->name('frontend.shop.cart');

Route::get('/select/color/wise/size', [ShopController::class, 'colorWiseSize'])->name('frontend.select.color.wise.size');

Route::get('/select/color/wise/size/inventory', [ShopController::class, 'colorSizeWiseInventory'])->name('frontend.select.color.wise.size.inventory');



/// Cart page Route

Route::middleware('auth')->name('frontend.')->group(function () {

  Route::get('/product/cart/details',[CartController::class,'index'])->name('product.cart.list');

  Route::post('/product/cart/',[CartController::class,'store'])->name('product.cart');


  Route::get('/product/cart/delete/{id}',[CartController::class,'destroy'])->name('product.cart.destroy');

  Route::get('/product/cart/quantity/update',[CartController::class,'quantityUpdate'])->name('product.cart.quantityUpdate');

  Route::post('/product/cart/apply/coupon', [CartController::class, 'applyCoupon'])->name('product.cart.applyCoupon');

  Route::get('/product/cart/getShipping/Charbge', [CartController::class, 'getShippingCharbge'])->name('product.cart.shppingCharge');

  // checkout

  Route::get('/product/order/checkout', [CheckoutController::class, 'checkOut'])->name('product.order.checkOut');


  // SSLCOMMERZ Start
 
  Route::post('/pay', [CheckoutController::class, 'order'])->name('pay.order');
  Route::post('/success', [CheckoutController::class, 'success']);
  Route::post('/fail', [CheckoutController::class, 'fail']);
  Route::post('/cancel', [CheckoutController::class, 'cancel']);
  Route::post('/ipn', [CheckoutController::class, 'ipn']);
  
//SSLCOMMERZ 

  

});