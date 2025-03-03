<?php
$router->group(['prefix' => 'accommodation-types'], function ($router) {
    $router->get('/', 'AccommodationtypeController@index')->name('admin_accommodationtype.index');
    $router->get('create', 'AccommodationtypeController@create')->name('admin_accommodationtype.create');
    $router->post('/create', 'AccommodationtypeController@postCreate')->name('admin_accommodationtype.create');
    $router->get('/edit/{id}', 'AccommodationtypeController@edit')->name('admin_accommodationtype.edit');
    $router->post('/edit/{id}', 'AccommodationtypeController@postEdit')->name('admin_accommodationtype.edit');
    $router->post('/delete', 'AccommodationtypeController@deleteList')->name('admin_accommodationtype.delete');
});
