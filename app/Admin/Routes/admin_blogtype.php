<?php
$router->group(['prefix' => 'blog-types'], function ($router) {
    $router->get('/', 'BlogtypeController@index')->name('admin_blogtype.index');
    $router->get('create', 'BlogtypeController@create')->name('admin_blogtype.create');
    $router->post('/create', 'BlogtypeController@postCreate')->name('admin_blogtype.create');
    $router->get('/edit/{id}', 'BlogtypeController@edit')->name('admin_blogtype.edit');
    $router->post('/edit/{id}', 'BlogtypeController@postEdit')->name('admin_blogtype.edit');
    $router->post('/delete', 'BlogtypeController@deleteList')->name('admin_blogtype.delete');
});
