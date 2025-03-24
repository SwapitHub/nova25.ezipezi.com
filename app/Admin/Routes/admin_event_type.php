<?php
$router->group(['prefix' => 'event-types'], function ($router) {
    $router->get('/', 'EventtypeController@index')->name('admin_eventtype.index');
    $router->get('create', 'EventtypeController@create')->name('admin_eventtype.create');
    $router->post('/create', 'EventtypeController@postCreate')->name('admin_eventtype.create');
    $router->get('/edit/{id}', 'EventtypeController@edit')->name('admin_eventtype.edit');
    $router->post('/edit/{id}', 'EventtypeController@postEdit')->name('admin_eventtype.edit');
    $router->post('/delete', 'EventtypeController@deleteList')->name('admin_eventtype.delete');
});
