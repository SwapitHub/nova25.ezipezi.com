<?php
$router->group(['prefix' => 'accommodation-tags'], function ($router) {
    $router->get('/', 'AccommodationtagcatController@index')->name('admin_accommodation_tag.index');
    $router->get('create', 'AccommodationtagcatController@create')->name('admin_accommodation_tag.create');
    $router->post('/create', 'AccommodationtagcatController@postCreate')->name('admin_accommodation_tag.create');
    $router->get('/edit/{id}', 'AccommodationtagcatController@edit')->name('admin_accommodation_tag.edit');
    $router->post('/edit/{id}', 'AccommodationtagcatController@postEdit')->name('admin_accommodation_tag.edit');
    $router->post('/delete', 'AccommodationtagcatController@deleteList')->name('admin_accommodation_tag.delete');
});