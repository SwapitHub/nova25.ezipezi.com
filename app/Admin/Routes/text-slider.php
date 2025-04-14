<?php
$router->group(['prefix' => 'text-slider'], function ($router) {
    $router->get('/', 'TextSliderController@index')->name('text_slider.index');
    $router->get('create', 'TextSliderController@create')->name('text_slider.create');
    $router->post('/create', 'TextSliderController@postCreate')->name('text_slider.create');
    $router->get('/edit/{id}', 'TextSliderController@edit')->name('text_slider.edit');
    $router->post('/edit/{id}', 'TextSliderController@postEdit')->name('text_slider.edit');
    $router->post('/delete', 'TextSliderController@deleteList')->name('text_slider.delete');
});
