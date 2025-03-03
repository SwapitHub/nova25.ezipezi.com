<?php
$router->group(['prefix' => 'service-tag-types'], function ($router) {
    $router->get('/', 'ServiceTagTypeController@index')->name('admin_service_tag_type.index');
    $router->get('create', 'ServiceTagTypeController@create')->name('admin_service_tag_type.create');
    $router->post('/create', 'ServiceTagTypeController@postCreate')->name('admin_service_tag_type.create');
    $router->get('/edit/{id}', 'ServiceTagTypeController@edit')->name('admin_service_tag_type.edit');
    $router->post('/edit/{id}', 'ServiceTagTypeController@postEdit')->name('admin_service_tag_type.edit');
    $router->post('/delete', 'ServiceTagTypeController@deleteList')->name('admin_service_tag_type.delete');
});
