<?php
$router->group(['prefix' => 'news-types'], function ($router) {
    $router->get('/', 'NewstypeController@index')->name('admin_newstype.index');
    $router->get('create', 'NewstypeController@create')->name('admin_newstype.create');
    $router->post('/create', 'NewstypeController@postCreate')->name('admin_newstype.create');
    $router->get('/edit/{id}', 'NewstypeController@edit')->name('admin_newstype.edit');
    $router->post('/edit/{id}', 'NewstypeController@postEdit')->name('admin_newstype.edit');
    $router->post('/delete', 'NewstypeController@deleteList')->name('admin_newstype.delete');
});
