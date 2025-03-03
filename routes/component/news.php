<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'news';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allnews')->name('news.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
    $router->get('/search', 'ContentFront@newsSearch');
    $router->get('/{alias}', 'ContentFront@newsDetails');
    $router->get('/category/{alias}', 'ContentFront@newsCat');  
});