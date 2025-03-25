<?php
$router->group(['prefix' => 'event'], function ($router) {
    $router->get('/', 'EventController@index')->name('admin_event.index');
    $router->get('create', 'EventController@create')->name('admin_event.create');
    $router->post('/create', 'EventController@postCreate')->name('admin_event.create');
    $router->get('/edit/{id}', 'EventController@edit')->name('admin_event.edit');
    $router->post('/edit/{id}', 'EventController@postEdit')->name('admin_event.edit');
    $router->post('/delete', 'EventController@deleteList')->name('admin_event.delete');
    $router->post('/deleteimg', 'EventController@deleteImg')->name('admin_event.deleteimg');
});
