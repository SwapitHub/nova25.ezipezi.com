<?php
$router->group(['prefix' => 'shipping-methods'], function ($router) {
    $router->get('/', 'ShopMethodController@index')
        ->name('admin_shipping_methods.index');
    $router->get('create', 'ShopMethodController@create')
        ->name('admin_shipping_methods.create');
    $router->post('/create', 'ShopMethodController@postCreate')
        ->name('admin_shipping_methods.create');
    $router->get('/edit/{id}', 'ShopMethodController@edit')
        ->name('admin_shipping_methods.edit');
    $router->post('/edit/{id}', 'ShopMethodController@postEdit')
        ->name('admin_shipping_methods.edit');
    $router->post('/delete', 'ShopMethodController@deleteList')
        ->name('admin_shipping_methods.delete');
});