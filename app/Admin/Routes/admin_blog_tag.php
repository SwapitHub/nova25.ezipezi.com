<?php
$router->group(['prefix' => 'blog-tags'], function ($router) {
    $router->get('/', 'BlogtagController@index')->name('admin_blog_tag.index');
    $router->get('create', 'BlogtagController@create')->name('admin_blog_tag.create');
    $router->post('/create', 'BlogtagController@postCreate')->name('admin_blog_tag.create');
    $router->get('/edit/{id}', 'BlogtagController@edit')->name('admin_blog_tag.edit');
    $router->post('/edit/{id}', 'BlogtagController@postEdit')->name('admin_blog_tag.edit');
    $router->post('/delete', 'BlogtagController@deleteList')->name('admin_blog_tag.delete');
});