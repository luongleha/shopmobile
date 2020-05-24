<?php
    Route::group([], function () {
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLoginForm');
    });
    // login-register
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::get('register', 'Auth\RegisterController@register')->name('register');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group([
        'namespace' => 'Backend',
        'prefix' => 'admin',
        'middleware' => 'auth'
    ], function (){
        // Trang dashboard - trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');

        Route::group(['prefix' => 'market-pay'], function () {
        Route::get('/list', 'MarketPayController@index')->name('market-pay.index');
        Route::get('/detail', 'MarketPayController@detail')->name('market-pay.detail');
        Route::post('/create', 'MarketPayController@create')->name('market-pay.create');
        Route::post('/update', 'MarketPayController@update')->name('market-pay.update');
        Route::post('/delete', 'MarketPayController@delete')->name('market-pay.delete');
        Route::delete('/deleteMultiple', 'MarketPayController@deleteMultiple')->name('market-pay.deleteMultiple');
        Route::get('/search', 'MarketPayController@search')->name('market-pay.search');
        Route::get('/logsearch', 'MarketPayController@logsearch')->name('market-pay.logsearch');
        Route::get('/post/{id?}', 'MarketPayController@listID')->name('market-pay.id');
        Route::post('/pay', 'MarketPayController@pay')->name('market-pay.cart.pay');
        Route::post('/add/{id}', 'MarketPayController@add2Cart')->name('market-pay.cart.add');
        Route::delete('/destroy/{rowId}', 'MarketPayController@destroy')->name('market-pay.cart.destroy');
        });

        Route::group(['prefix' => 'market-pay-online'], function () {
        Route::get('/list', 'MarketPayOnlineController@index')->name('market-pay-online.index');
        Route::get('/detail', 'MarketPayOnlineController@detail')->name('market-pay-online.detail');
        Route::post('/confirm', 'MarketPayOnlineController@confirm')->name('market-pay-online.confirm');
        Route::get('/search', 'MarketPayOnlineController@search')->name('market-pay-online.search');
        Route::get('/logsearch', 'MarketPayOnlineController@logsearch')->name('market-pay-online.logsearch');
        });

        Route::group(['prefix' => 'market-pay-detail'], function () {
        Route::get('/list', 'MarketPayDetailController@index')->name('market-pay-detail.index');
        Route::get('/detail', 'MarketPayDetailController@detail')->name('market-pay-detail.detail');
        Route::get('/search', 'MarketPayDetailController@search')->name('market-pay-detail.search');
        Route::get('/logsearch', 'MarketPayDetailController@logsearch')->name('market-pay-detail.logsearch');
        });

        Route::group(['prefix' => 'market-daily-sales'], function () {
        Route::get('/list', 'MarketDailySalesController@index')->name('market-daily-sales.index');
        Route::get('/show', 'MarketDailySalesController@show')->name('market-daily-sales.show');
        Route::post('/create', 'MarketDailySalesController@create')->name('market-daily-sales.create');
        });

        Route::group(['prefix' => 'product-market'], function () {
        Route::get('/list', 'ProductMarketController@index')->name('product.index');
        Route::get('/detail', 'ProductMarketController@detail')->name('product.detail');
        Route::post('/create', 'ProductMarketController@create')->name('product.create');
        Route::post('/update', 'ProductMarketController@update')->name('product.update');
        Route::post('/delete', 'ProductMarketController@delete')->name('product.delete');
        Route::delete('/deleteMultiple', 'ProductMarketController@deleteMultiple')->name('product.deleteMultiple');
        Route::get('/search', 'ProductMarketController@search')->name('product.search');
        Route::get('/logsearch', 'ProductMarketController@logsearch')->name('product.logsearch');
        });

        Route::group(['prefix' => 'category-market'], function () {
        Route::get('/list', 'CategoryController@index')->name('category.index');
        Route::get('/detail', 'CategoryController@detail')->name('category.detail');
        Route::post('/create', 'CategoryController@create')->name('category.create');
        Route::post('/update', 'CategoryController@update')->name('category.update');
        Route::post('/delete', 'CategoryController@delete')->name('category.delete');
        Route::delete('/deleteMultiple', 'CategoryController@deleteMultiple')->name('category.deleteMultiple');
        Route::get('/search', 'CategoryController@search')->name('category.search');
        Route::get('/logsearch', 'CategoryController@logsearch')->name('category.logsearch');
        });

        Route::group(['prefix' => 'users'], function () {
        Route::get('/list', 'UserController@index')->name('users.index');
        Route::get('/detail', 'UserController@detail')->name('users.detail');
        Route::post('/create', 'UserController@create')->name('users.create');
        Route::post('/update', 'UserController@update')->name('users.update');
        Route::post('/delete', 'UserController@delete')->name('users.delete');
        Route::delete('/deleteMultiple', 'UserController@deleteMultiple')->name('users.deleteMultiple');
        Route::get('/search', 'UserController@search')->name('users.search');
        Route::get('/logsearch', 'UserController@logsearch')->name('users.logsearch');
        Route::get('/post/{id?}', 'UserController@listID')->name('users.id');
        });
    });

    Route::get('Session/set', 'Backend\SessionController@set');
    Route::get('Session/get', 'Backend\SessionController@get');
    Route::get('Session/get2', 'Backend\SessionController@get2');

    Route::get('Cookie/set', 'Backend\CookieController@set');
    Route::get('Cookie/get', 'Backend\CookieController@get');

    Route::get('/cache', 'HomeController@index');
    Route::get('/getcache', 'HomeController@getcache');

    Route::group([
        'namespace' => 'Frontend',
        'prefix' => 'online'
    ], function (){
        Route::get('/index', 'IndexController@index')->name('frontend.index');
        Route::group(['prefix' => 'products'], function(){
           Route::get('/', 'ProductController@index')->name('frontend.products.index');
           Route::get('/show/{id?}', 'ProductController@show')->name('frontend.products.show');
           Route::post('/comment', 'ProductController@storeNews')->name('frontend.products.storeNews');
        });
        Route::group(['prefix' => 'shop'], function(){
            Route::get('/', 'ShopController@index')->name('frontend.shop.index');
            Route::get('/{id?}', 'ShopController@menu')->name('frontend.shop.menu');
        });
        //Quản lý gio hang
        Route::group(['prefix' => 'cart'], function(){
            Route::get('/', 'CartController@index')->name('frontend.cart.index');
            Route::get('/add/{id}', 'CartController@add2Cart')->name('frontend.cart.add');
            Route::delete('/destroy/{id}', 'CartController@destroy')->name('frontend.cart.destroy');
            Route::post('/pay', 'CartController@pay_bill')->name('frontend.cart.pay');
        });
        Route::group(['prefix' => 'pay'], function(){
            Route::get('/', 'CartController@pay')->name('frontend.cart.pay');
            Route::post('/create-userinfo', 'CartController@createuserinfo')->name('frontend.cart.createuserinfo');
            Route::get('/create', 'CartController@create')->name('frontend.cart.create');
            Route::post('/', 'CartController@store')->name('frontend.cart.store');
        });
        Route::group(['prefix' => 'contact'], function(){
            Route::get('/', 'ContactController@index')->name('frontend.contact.index');
        });
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
