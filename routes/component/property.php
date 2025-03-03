<?php
$prefixProperty = sc_config('PREFIX_ACCOMMODATION')??'property';

Route::group(['prefix' => $prefixProperty], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allProperty')->name('property.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
          $router->get('/search', 'ContentFront@propertySearch');
    $router->get('/{alias}', 'ContentFront@propertyDetail');
});