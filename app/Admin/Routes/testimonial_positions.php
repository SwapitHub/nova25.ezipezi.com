<?php
$router->group(['prefix' => 'testimonial-positions'], function ($router) {
    $router->get('/', 'TestPosController@index')->name('admin_testimonial_position.index');
    $router->get('create', 'TestPosController@create')->name('admin_testimonial_position.create');
    $router->post('/create', 'TestPosController@postCreate')->name('admin_testimonial_position.create');
    $router->get('/edit/{id}', 'TestPosController@edit')->name('admin_testimonial_position.edit');
    $router->post('/edit/{id}', 'TestPosController@postEdit')->name('admin_testimonial_position.edit');
    $router->post('/delete', 'TestPosController@deleteList')->name('admin_testimonial_position.delete');
});
