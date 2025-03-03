<?php
$router->group(['prefix' => 'localidad'], function ($router) {
    $router->get('/', 'LocalidadController@index')->name('admin_localidad.index');
    $router->get('create', 'LocalidadController@create')->name('admin_localidad.create');
    $router->post('/create', 'LocalidadController@postCreate')->name('admin_localidad.create');
    $router->get('/edit/{id}', 'LocalidadController@edit')->name('admin_localidad.edit');
    $router->post('/edit/{id}', 'LocalidadController@postEdit')->name('admin_localidad.edit');
    $router->post('/delete', 'LocalidadController@deleteList')->name('admin_localidad.delete');
});
