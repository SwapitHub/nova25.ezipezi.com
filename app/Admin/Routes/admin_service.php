<?php
$router->group(['prefix' => 'services'], function ($router) {
    $router->get('/', 'ServiceController@index')->name('admin_service.index');
    $router->get('create', 'ServiceController@create')->name('admin_service.create');
    $router->post('/create', 'ServiceController@postCreate')->name('admin_service.create');
    $router->get('/edit/{id}', 'ServiceController@edit')->name('admin_service.edit');
    $router->post('/edit/{id}', 'ServiceController@postEdit')->name('admin_service.edit');
    $router->post('/delete', 'ServiceController@deleteList')->name('admin_service.delete');
    $router->post('/deleteimg', 'ServiceController@deleteImg')->name('admin_service.deleteimg');
});
