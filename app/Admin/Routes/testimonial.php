<?php
$router->group(['prefix' => 'testimonial'], function ($router) {
    $router->get('/', 'TestimonialController@index')->name('admin_testimonial.index');
    $router->get('create', 'TestimonialController@create')->name('admin_testimonial.create');
    $router->post('/create', 'TestimonialController@postCreate')->name('admin_testimonial.create');
    $router->get('/edit/{id}', 'TestimonialController@edit')->name('admin_testimonial.edit');
    $router->post('/edit/{id}', 'TestimonialController@postEdit')->name('admin_testimonial.edit');
    $router->post('/delete', 'TestimonialController@deleteList')->name('admin_testimonial.delete');
});