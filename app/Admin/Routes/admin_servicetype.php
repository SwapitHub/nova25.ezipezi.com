<?php
$router->group(['prefix' => 'service-types'], function ($router) {
    $router->get('/', 'ServicetypeController@index')->name('admin_servicetype.index');
    $router->get('create', 'ServicetypeController@create')->name('admin_servicetype.create');
    $router->post('/create', 'ServicetypeController@postCreate')->name('admin_servicetype.create');
    $router->get('/edit/{id}', 'ServicetypeController@edit')->name('admin_servicetype.edit');
    $router->post('/edit/{id}', 'ServicetypeController@postEdit')->name('admin_servicetype.edit');
    $router->post('/delete', 'ServicetypeController@deleteList')->name('admin_servicetype.delete');
});
