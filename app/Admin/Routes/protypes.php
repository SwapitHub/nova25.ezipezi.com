<?php
$router->group(['prefix' => 'product-types'], function ($router) {
    $router->get('/', 'ProtypeController@index')->name('admin_protype.index');
    $router->get('create', 'ProtypeController@create')->name('admin_protype.create');
    $router->post('/create', 'ProtypeController@postCreate')->name('admin_protype.create');
    $router->get('/edit/{id}', 'ProtypeController@edit')->name('admin_protype.edit');
    $router->post('/edit/{id}', 'ProtypeController@postEdit')->name('admin_protype.edit');
    $router->post('/delete', 'ProtypeController@deleteList')->name('admin_protype.delete');
});
