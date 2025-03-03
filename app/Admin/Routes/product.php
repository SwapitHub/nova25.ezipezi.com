<?php
$router->group(['prefix' => 'product'], function ($router) {
    $router->get('/', 'ShopProductController@index')->name('admin_product.index');
    $router->get('create', 'ShopProductController@create')->name('admin_product.create');
    $router->post('/create', 'ShopProductController@postCreate')->name('admin_product.create');
    $router->get('/edit/{id}', 'ShopProductController@edit')->name('admin_product.edit');
    $router->post('/edit/{id}', 'ShopProductController@postEdit')->name('admin_product.edit');
    $router->post('/delete', 'ShopProductController@deleteList')->name('admin_product.delete');
    $router->get('/import', 'ShopProductController@import')->name('admin_product.import');
    $router->post('/import', 'ShopProductController@postImport')->name('admin_product.import');
    $router->post('/loc', 'ShopProductController@getLoc')->name('admin_product.getloc');
    $router->post('/subloc', 'ShopProductController@getsubloc')->name('admin_product.getsubloc');
    $router->post('/getprotype', 'ShopProductController@getprotype')->name('admin_product.getprotype');
    $router->post('/deleteimg', 'ShopProductController@deleteImg')->name('admin_product.deleteimg');
});
