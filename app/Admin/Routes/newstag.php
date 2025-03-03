<?php
$router->group(['prefix' => 'news-tags'], function ($router) {
    $router->get('/', 'NewstagcatController@index')->name('admin_news_tag.index');
    $router->get('create', 'NewstagcatController@create')->name('admin_news_tag.create');
    $router->post('/create', 'NewstagcatController@postCreate')->name('admin_news_tag.create');
    $router->get('/edit/{id}', 'NewstagcatController@edit')->name('admin_news_tag.edit');
    $router->post('/edit/{id}', 'NewstagcatController@postEdit')->name('admin_news_tag.edit');
    $router->post('/delete', 'NewstagcatController@deleteList')->name('admin_news_tag.delete');
});