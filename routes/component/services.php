<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'services';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allservices')->name('services.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
    $router->get('/search', 'ContentFront@serviceSearch');
    $router->get('/{alias}', 'ContentFront@serviceDetails');
    $router->get('/category/{alias}', 'ContentFront@serviceCat');  
});