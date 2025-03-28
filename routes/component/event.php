<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'event';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allevents')->name('event.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
    $router->get('/search', 'ContentFront@eventSearch');
    $router->get('/{alias}', 'ContentFront@eventDetails');
    $router->get('/category/{alias}', 'ContentFront@eventCat');  
});