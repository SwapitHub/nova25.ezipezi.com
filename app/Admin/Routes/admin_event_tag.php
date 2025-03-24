<?php
$router->group(['prefix' => 'event-tags'], function ($router) {
    $router->get('/', 'EventtagController@index')->name('admin_event_tag.index');
    $router->get('create', 'EventtagController@create')->name('admin_event_tag.create');
    $router->post('/create', 'EventtagController@postCreate')->name('admin_evant_tag.create');
    $router->get('/edit/{id}', 'EventtagController@edit')->name('admin_event_tag.edit');
    $router->post('/edit/{id}', 'EventtagController@postEdit')->name('admin_event_tag.edit');
    $router->post('/delete', 'EventtagController@deleteList')->name('admin_event_tag.delete');
});