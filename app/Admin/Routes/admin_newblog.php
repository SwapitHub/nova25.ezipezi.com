<?php
$router->group(['prefix' => 'new-blog'], function ($router) {
    $router->get('/', 'NewBlogController@index')->name('admin_newblog.index');
    $router->get('create', 'NewBlogController@create')->name('admin_newblog.create');
    $router->post('/create', 'NewBlogController@postCreate')->name('admin_newblog.create');
    $router->get('/edit/{id}', 'NewBlogController@edit')->name('admin_newblog.edit');
    $router->post('/edit/{id}', 'NewBlogController@postEdit')->name('admin_newblog.edit');
    $router->post('/delete', 'NewBlogController@deleteList')->name('admin_newblog.delete');
    $router->post('/deleteimg', 'NewBlogController@deleteImg')->name('admin_newblog.deleteimg');
});
