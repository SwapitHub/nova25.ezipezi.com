<?php
$router->group(['prefix' => 'events-tag-type'], function ($router) {
    $router->get('/', 'EventTagTypeController@index')->name('admin_event_tag_type.index');
    $router->get('create', 'EventTagTypeController@create')->name('admin_event_tag_type.create');
    $router->post('/create', 'EventTagTypeController@postCreate')->name('admin_event_tag_type.create');
    $router->get('/edit/{id}', 'EventTagTypeController@edit')->name('admin_event_tag_type.edit');
    $router->post('/edit/{id}', 'EventTagTypeController@postEdit')->name('admin_event_tag_type.edit');
    $router->post('/delete', 'EventTagTypeController@deleteList')->name('admin_event_tag_type.delete');
});
