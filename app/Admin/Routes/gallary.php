<?php
$router->group(['prefix' => 'gallery'], function ($router) {
    $router->get('/', 'GallaryController@index')->name('gallary.index');
    $router->get('create', 'GallaryController@create')->name('gallary.create');
    $router->post('/create', 'GallaryController@postCreate')->name('gallary.create');
    $router->get('/edit/{id}', 'GallaryController@edit')->name('gallary.edit');
    $router->post('/edit/{id}', 'GallaryController@postEdit')->name('gallary.edit');
    $router->post('/delete', 'GallaryController@deleteList')->name('gallary.delete');
    $router->post('/deleteimg', 'GallaryController@deleteImg')->name('gallary.deleteimg');
});
