<?php
$router->group(['prefix' => 'video-types'], function ($router) {
    $router->get('/', 'VideotypeController@index')->name('video_type.index');
    $router->get('create', 'VideotypeController@create')->name('video_type.create');
    $router->post('/create', 'VideotypeController@postCreate')->name('video_type.create');
    $router->get('/edit/{id}', 'VideotypeController@edit')->name('video_type.edit');
    $router->post('/edit/{id}', 'VideotypeController@postEdit')->name('video_type.edit');
    $router->post('/delete', 'VideotypeController@deleteList')->name('video_type.delete');
});
