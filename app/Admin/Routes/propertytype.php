<?php
$router->group(['prefix' => 'property-types'], function ($router) {
    $router->get('/', 'PropertytypeController@index')->name('admin_propertytype.index');
    $router->get('create', 'PropertytypeController@create')->name('admin_propertytype.create');
    $router->post('/create', 'PropertytypeController@postCreate')->name('admin_propertytype.create');
    $router->get('/edit/{id}', 'PropertytypeController@edit')->name('admin_propertytype.edit');
    $router->post('/edit/{id}', 'PropertytypeController@postEdit')->name('admin_propertytype.edit');
    $router->post('/delete', 'PropertytypeController@deleteList')->name('admin_propertytype.delete');
});
