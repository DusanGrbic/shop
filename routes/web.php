<?php

/** 
 * Product/Home
 */
Route::get('/', 'ProductController@get_index')->name('product.index');

Route::get('/add-to-cart/{product_id}/{row_id}', 'ProductController@get_add_to_cart')->name('product.add_to_cart');

Route::get('/shopping-cart', 'ProductController@get_shopping_cart')->name('product.shopping_cart');

Route::get('/reduce/{id}', 'ProductController@get_reduce_by_one')->name('product.reduce_by_one');

Route::get('/remove/{id}', 'ProductController@get_remove_item')->name('product.remove_item');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/checkout', 'ProductController@get_checkout')->name('product.checkout');

    Route::post('/checkout', 'ProductController@post_checkout');
});


/**
 *  User 
 */
/** Guest middleware */
Route::group(['prefix' => 'user', 'middleware' => 'guest'], function (){

    Route::get('/signup', 'UserController@get_signup')->name('user.signup');

    Route::post('/signup', 'UserController@post_signup');

    Route::get('/signin', 'UserController@get_signin')->name('user.signin');

    Route::post('/signin', 'UserController@post_signin');

});

/** Auth middleware */
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (){
    
    Route::get('/profile', 'UserController@get_profile')->name('user.profile');
    
    Route::get('/logout', 'UserController@get_logout')->name('user.logout');
});

Route::get('/forget', function (){
    session()->forget('cart');
    return back();
});
