<?php
$router->group(['prefix' => 'provincia'], function ($router) {
    $router->get('/', 'ProvinciaController@index')->name('admin_provincia.index');
    $router->get('create', 'ProvinciaController@create')->name('admin_provincia.create');
    $router->post('/create', 'ProvinciaController@postCreate')->name('admin_provincia.create');
    $router->get('/edit/{id}', 'ProvinciaController@edit')->name('admin_provincia.edit');
    $router->post('/edit/{id}', 'ProvinciaController@postEdit')->name('admin_provincia.edit');
    $router->post('/delete', 'ProvinciaController@deleteList')->name('admin_provincia.delete');
});
