<?php
$router->group(['prefix' => 'gallery-tag-type'], function ($router) {
    $router->get('/', 'ImageGallaryTagTypeController@index')->name('gallary_tag_type.index');
    $router->get('create', 'ImageGallaryTagTypeController@create')->name('gallary_tag_type.create');
    $router->post('/create', 'ImageGallaryTagTypeController@postCreate')->name('gallary_tag_type.create');
    $router->get('/edit/{id}', 'ImageGallaryTagTypeController@edit')->name('gallary_tag_type.edit');
    $router->post('/edit/{id}', 'ImageGallaryTagTypeController@postEdit')->name('gallary_tag_type.edit');
    $router->post('/delete', 'ImageGallaryTagTypeController@deleteList')->name('gallary_tag_type.delete');
    $router->post('/deleteimg', 'ImageGallaryTagTypeController@deleteImg')->name('gallary_tag_type.deleteimg');
});
