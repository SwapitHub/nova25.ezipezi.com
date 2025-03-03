<?php
$router->group(['prefix' => 'blog-tag-types'], function ($router) {
    $router->get('/', 'BlogTagTypeController@index')->name('admin_blog_tag_type.index');
    $router->get('create', 'BlogTagTypeController@create')->name('admin_blog_tag_type.create');
    $router->post('/create', 'BlogTagTypeController@postCreate')->name('admin_blog_tag_type.create');
    $router->get('/edit/{id}', 'BlogTagTypeController@edit')->name('admin_blog_tag_type.edit');
    $router->post('/edit/{id}', 'BlogTagTypeController@postEdit')->name('admin_blog_tag_type.edit');
    $router->post('/delete', 'BlogTagTypeController@deleteList')->name('admin_blog_tag_type.delete');
});
