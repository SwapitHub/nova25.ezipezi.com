<?php
$router->group(['prefix' => 'news-tag-types'], function ($router) {
    $router->get('/', 'NewsTagTypeController@index')->name('admin_news_tag_type.index');
    $router->get('create', 'NewsTagTypeController@create')->name('admin_news_tag_type.create');
    $router->post('/create', 'NewsTagTypeController@postCreate')->name('admin_news_tag_type.create');
    $router->get('/edit/{id}', 'NewsTagTypeController@edit')->name('admin_news_tag_type.edit');
    $router->post('/edit/{id}', 'NewsTagTypeController@postEdit')->name('admin_news_tag_type.edit');
    $router->post('/delete', 'NewsTagTypeController@deleteList')->name('admin_news_tag_type.delete');
});
