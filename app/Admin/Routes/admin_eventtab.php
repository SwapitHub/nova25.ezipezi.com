<?php
$router->group(['prefix' => 'event-tabs'], function ($router) {
    $router->get('/', 'EventtabController@index')->name('admin_eventtab.index');
    $router->get('create', 'EventtabController@create')->name('admin_eventtab.create');
    $router->post('/create', 'EventtabController@postCreate')->name('admin_eventtab.create');
    $router->get('/edit/{id}', 'EventtabController@edit')->name('admin_eventtab.edit');
    $router->post('/edit/{id}', 'EventtabController@postEdit')->name('admin_eventtab.edit');
    $router->post('/delete', 'EventtabController@deleteList')->name('admin_eventtab.delete');
});
