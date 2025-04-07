<?php
$router->group(['prefix' => 'video'], function ($router) {
    $router->get('/', 'VideoController@index')->name('video.index');
    $router->get('create', 'VideoController@create')->name('video.create');
    $router->post('/create', 'VideoController@postCreate')->name('video.create');
    $router->get('/edit/{id}', 'VideoController@edit')->name('video.edit');
    $router->post('/edit/{id}', 'VideoController@postEdit')->name('video.edit');
    $router->post('/delete', 'VideoController@deleteList')->name('video.delete');
    $router->post('/deleteimg', 'VideoController@deleteImg')->name('video.deleteimg');
});
