<?php
$router->group(['prefix' => 'property-tag-types'], function ($router) {
    $router->get('/', 'PropertyTagTypeController@index')->name('admin_property_tag_type.index');
    $router->get('create', 'PropertyTagTypeController@create')->name('admin_property_tag_type.create');
    $router->post('/create', 'PropertyTagTypeController@postCreate')->name('admin_property_tag_type.create');
    $router->get('/edit/{id}', 'PropertyTagTypeController@edit')->name('admin_property_tag_type.edit');
    $router->post('/edit/{id}', 'PropertyTagTypeController@postEdit')->name('admin_property_tag_type.edit');
    $router->post('/delete', 'PropertyTagTypeController@deleteList')->name('admin_property_tag_type.delete');
});
