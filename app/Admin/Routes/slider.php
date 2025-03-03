<?php
$router->group(['prefix' => 'slider'], function ($router) {
    $router->get('/', 'SliderController@index')->name('admin_slider.index');
    $router->get('create', 'SliderController@create')->name('admin_slider.create');
    $router->post('/create', 'SliderController@postCreate')->name('admin_slider.create');
    $router->get('/edit/{id}', 'SliderController@edit')->name('admin_slider.edit');
    $router->post('/edit/{id}', 'SliderController@postEdit')->name('admin_slider.edit');
    $router->post('/delete', 'SliderController@deleteList')->name('admin_slider.delete');
});
