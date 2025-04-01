<?php
$router->group(['prefix' => 'gallary-tag'], function ($router) {
    $router->get('/', 'GallarytagController@index')->name('gallary_tag.index');
    $router->get('create', 'GallarytagController@create')->name('gallary_tag.create');
    $router->post('/create', 'GallarytagController@postCreate')->name('gallary_tag.create');
    $router->get('/edit/{id}', 'GallarytagController@edit')->name('gallary_tag.edit');
    $router->post('/edit/{id}', 'GallarytagController@postEdit')->name('gallary_tag.edit');
    $router->post('/delete', 'GallarytagController@deleteList')->name('gallary_tag.delete');
    $router->post('/deleteimg', 'GallarytagController@deleteImg')->name('gallary_tag.deleteimg');
});
