<?php
$router->group(['prefix' => 'service-tags'], function ($router) {
    $router->get('/', 'ServicetagController@index')->name('admin_service_tag.index');
    $router->get('create', 'ServicetagController@create')->name('admin_service_tag.create');
    $router->post('/create', 'ServicetagController@postCreate')->name('admin_service_tag.create');
    $router->get('/edit/{id}', 'ServicetagController@edit')->name('admin_service_tag.edit');
    $router->post('/edit/{id}', 'ServicetagController@postEdit')->name('admin_service_tag.edit');
    $router->post('/delete', 'ServicetagController@deleteList')->name('admin_service_tag.delete');
});