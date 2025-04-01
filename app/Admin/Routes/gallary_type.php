<?php
$router->group(['prefix' => 'gallary-types'], function ($router) {
    $router->get('/', 'GallarytypeController@index')->name('gallary_type.index');
    $router->get('create', 'GallarytypeController@create')->name('gallary_type.create');
    $router->post('/create', 'GallarytypeController@postCreate')->name('gallary_type.create');
    $router->get('/edit/{id}', 'GallarytypeController@edit')->name('gallary_type.edit');
    $router->post('/edit/{id}', 'GallarytypeController@postEdit')->name('gallary_type.edit');
    $router->post('/delete', 'GallarytypeController@deleteList')->name('gallary_type.delete');
});
