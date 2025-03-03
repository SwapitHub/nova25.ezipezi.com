<?php
$router->group(['prefix' => 'testimonial-title'], function ($router) {
    $router->get('/', 'TestimTitleController@index')->name('admin_testimonial_title.index');
    $router->get('create', 'TestimTitleController@create')->name('admin_testimonial_title.create');
    $router->post('/create', 'TestimTitleController@postCreate')->name('admin_testimonial_title_title.create');
    $router->get('/edit/{id}', 'TestimTitleController@edit')->name('admin_testimonial_title.edit');
    $router->post('/edit/{id}', 'TestimTitleController@postEdit')->name('admin_testimonial_title.edit');
    $router->post('/delete', 'TestimTitleController@deleteList')->name('admin_testimonial_title.delete');
});