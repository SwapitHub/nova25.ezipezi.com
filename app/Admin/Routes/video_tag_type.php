<?php
$router->group(['prefix' => 'video-tag-type'], function ($router) {
    $router->get('/', 'VideoTagTypeController@index')->name('video_tag_type.index');
    $router->get('create', 'VideoTagTypeController@create')->name('video_tag_type.create');
    $router->post('/create', 'VideoTagTypeController@postCreate')->name('video_tag_type.create');
    $router->get('/edit/{id}', 'VideoTagTypeController@edit')->name('video_tag_type.edit');
    $router->post('/edit/{id}', 'VideoTagTypeController@postEdit')->name('video_tag_type.edit');
    $router->post('/delete', 'VideoTagTypeController@deleteList')->name('video_tag_type.delete');
    $router->post('/deleteimg', 'VideoTagTypeController@deleteImg')->name('video_tag_type.deleteimg');
});
