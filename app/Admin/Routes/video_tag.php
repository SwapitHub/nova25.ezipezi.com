<?php
$router->group(['prefix' => 'video-tags'], function ($router) {
    $router->get('/', 'VideotagController@index')->name('video_tag.index');
    $router->get('create', 'VideotagController@create')->name('video_tag.create');
    $router->post('/create', 'VideotagController@postCreate')->name('video_tag.create');
    $router->get('/edit/{id}', 'VideotagController@edit')->name('video_tag.edit');
    $router->post('/edit/{id}', 'VideotagController@postEdit')->name('video_tag.edit');
    $router->post('/delete', 'VideotagController@deleteList')->name('video_tag.delete');
    $router->post('/deleteimg', 'VideotagController@deleteImg')->name('video_tag.deleteimg');
});
