<?php
$router->group(['prefix' => 'property-tags'], function ($router) {
    $router->get('/', 'PropertytagController@index')->name('admin_property_tag.index');
    $router->get('create', 'PropertytagController@create')->name('admin_property_tag.create');
    $router->post('/create', 'PropertytagController@postCreate')->name('admin_property_tag.create');
    $router->get('/edit/{id}', 'PropertytagController@edit')->name('admin_property_tag.edit');
    $router->post('/edit/{id}', 'PropertytagController@postEdit')->name('admin_property_tag.edit');
    $router->post('/delete', 'PropertytagController@deleteList')->name('admin_property_tag.delete');
});