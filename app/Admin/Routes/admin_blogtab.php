<?php
$router->group(['prefix' => 'blog-tabs'], function ($router) {
    $router->get('/', 'BlogtabController@index')->name('admin_blogtab.index');
    $router->get('create', 'BlogtabController@create')->name('admin_blogtab.create');
    $router->post('/create', 'BlogtabController@postCreate')->name('admin_blogtab.create');
    $router->get('/edit/{id}', 'BlogtabController@edit')->name('admin_blogtab.edit');
    $router->post('/edit/{id}', 'BlogtabController@postEdit')->name('admin_blogtab.edit');
    $router->post('/delete', 'BlogtabController@deleteList')->name('admin_blogtab.delete');
});
