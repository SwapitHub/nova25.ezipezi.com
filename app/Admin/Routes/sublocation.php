<?php
$router->group(['prefix' => 'sublocation'], function ($router) {
    $router->get('/', 'SublocationController@index')->name('admin_subloc.index');
    $router->get('create', 'SublocationController@create')->name('admin_subloc.create');
    $router->post('/create', 'SublocationController@postCreate')->name('admin_subloc.create');
    $router->get('/edit/{id}', 'SublocationController@edit')->name('admin_subloc.edit');
    $router->post('/edit/{id}', 'SublocationController@postEdit')->name('admin_subloc.edit');
    $router->post('/delete', 'SublocationController@deleteList')->name('admin_subloc.delete');
});
