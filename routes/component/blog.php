<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'blog';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allblog')->name('blog.all');
  /*$router->post('/info', 'ShopFront@productInfo')
        ->name('product.info');*/
    $router->get('/search', 'ContentFront@blogSearch');
    $router->get('/{alias}', 'ContentFront@blogDetails');
    $router->get('/category/{alias}', 'ContentFront@blogCat');  
});