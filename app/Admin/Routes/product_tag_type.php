<?php
$router->group(['prefix' => 'product-tag-types'], function ($router) {
    $router->get('/', 'ProTagTypeController@index')->name('admin_product_tag_type.index');
    $router->get('create', 'ProTagTypeController@create')->name('admin_product_tag_type.create');
    $router->post('/create', 'ProTagTypeController@postCreate')->name('admin_product_tag_type.create');
    $router->get('/edit/{id}', 'ProTagTypeController@edit')->name('admin_product_tag_type.edit');
    $router->post('/edit/{id}', 'ProTagTypeController@postEdit')->name('admin_product_tag_type.edit');
    $router->post('/delete', 'ProTagTypeController@deleteList')->name('admin_product_tag_type.delete');
});
