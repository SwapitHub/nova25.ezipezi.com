<?php
$prefixAccommmodation = sc_config('PREFIX_ACCOMMODATION')??'accommodation';

Route::group(['prefix' => $prefixAccommmodation], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allAccommo')->name('accommodation.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
     $router->get('/search', 'ContentFront@accommoSearch')->name('accommodation.search');
    $router->get('/{alias}', 'ContentFront@accommoDetail');
  
});