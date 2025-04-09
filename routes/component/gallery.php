<?php
$prefixnews = sc_config('PREFIX_ACCOMMODATION')??'gallery';

Route::group(['prefix' => $prefixnews], function ($router) use($suffix) {
    $router->get('/', 'ContentFront@allimages')->name('gallery.all');
    $router->get('/search', 'ContentFront@gallerySearch');
    $router->get('/{alias}', 'ContentFront@galleryDetails');
    $router->get('/category/{alias}', 'ContentFront@galleryCat');  
});