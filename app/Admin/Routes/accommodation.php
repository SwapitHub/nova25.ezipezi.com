<?php
$router->group(['prefix' => 'accommodations'], function ($router) {
    $router->get('/', 'AccommodationController@index')->name('admin_accommodation.index');
    $router->get('create', 'AccommodationController@create')->name('admin_accommodation.create');
    $router->post('/create', 'AccommodationController@postCreate')->name('admin_accommodation.create');
    $router->get('/edit/{id}', 'AccommodationController@edit')->name('admin_accommodation.edit');
    $router->post('/edit/{id}', 'AccommodationController@postEdit')->name('admin_accommodation.edit');
    $router->post('/delete', 'AccommodationController@deleteList')->name('admin_accommodation.delete');
    $router->post('/deleteimg', 'AccommodationController@deleteImg')->name('admin_accommodation.deleteimg');
});
