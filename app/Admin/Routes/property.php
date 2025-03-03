<?php
$router->group(['prefix' => 'properties'], function ($router) {
    $router->get('/', 'PropertyController@index')->name('admin_property.index');
    $router->get('create', 'PropertyController@create')->name('admin_property.create');
    $router->post('/create', 'PropertyController@postCreate')->name('admin_property.create');
    $router->get('/edit/{id}', 'PropertyController@edit')->name('admin_property.edit');
    $router->post('/edit/{id}', 'PropertyController@postEdit')->name('admin_property.edit');
    $router->post('/delete', 'PropertyController@deleteList')->name('admin_property.delete');
    $router->post('/deleteimg', 'PropertyController@deleteImg')->name('admin_property.deleteimg');
});
