<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'portfolio';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allportfolio')->name('portfolio.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
    $router->get('/search', 'ContentFront@portfolioSearch');
    $router->get('/{alias}', 'ContentFront@portfolioDetails');
    $router->get('/category/{alias}', 'ContentFront@portfolioCat');  
});