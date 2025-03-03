<?php
$prefixProduct = sc_config('PREFIX_PRODUCT')??'product';

Route::group(['prefix' => $prefixProduct], function ($router) use($suffix) {
    $router->get('/', 'ShopFront@allProducts')->name('product.all');
    $router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');
    $router->get('/{alias}'.$suffix, 'ShopFront@productDetail')
        ->name('product.detail');
    $router->post('/procats', 'ContentFront@getProcats'); 
    $router->post('/addprice', 'ShopFront@setPrice')->name('product.setprice');; 
    $router->get('/category/{alias}', 'ContentFront@productCat'); 
});