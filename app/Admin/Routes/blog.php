<?php
$router->group(['prefix' => 'blog'], function ($router) {
    $router->get('/', 'BlogController@index')->name('admin_blog.index');
    $router->get('create', 'BlogController@create')->name('admin_blog.create');
    $router->post('/create', 'BlogController@postCreate')->name('admin_blog.create');
    $router->get('/edit/{id}', 'BlogController@edit')->name('admin_blog.edit');
    $router->post('/edit/{id}', 'BlogController@postEdit')->name('admin_blog.edit');
    $router->post('/delete', 'BlogController@deleteList')->name('admin_blog.delete');
    $router->post('/deleteimg', 'BlogController@deleteImg')->name('admin_blog.deleteimg');
});
