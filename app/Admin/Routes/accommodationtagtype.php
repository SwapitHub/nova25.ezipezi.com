<?php
$router->group(['prefix' => 'accommodation-tag-types'], function ($router) {
    $router->get('/', 'AccommodationTagTypeController@index')->name('admin_accommodation_tag_type.index');
    $router->get('create', 'AccommodationTagTypeController@create')->name('admin_accommodation_tag_type.create');
    $router->post('/create', 'AccommodationTagTypeController@postCreate')->name('admin_accommodation_tag_type.create');
    $router->get('/edit/{id}', 'AccommodationTagTypeController@edit')->name('admin_accommodation_tag_type.edit');
    $router->post('/edit/{id}', 'AccommodationTagTypeController@postEdit')->name('admin_accommodation_tag_type.edit');
    $router->post('/delete', 'AccommodationTagTypeController@deleteList')->name('admin_accommodation_tag_type.delete');
});
