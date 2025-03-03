<?php
$router->group(['prefix' => 'home-content'], function ($router) {
    $router->get('/', 'HomeFrontController@index')->name('admin_homecontent.index');
    $router->get('create', 'HomeFrontController@create')->name('admin_homecontent.create');
    $router->post('/create', 'HomeFrontController@postCreate')->name('admin_homecontent.create');
    $router->get('/edit/{id}', 'HomeFrontController@edit')->name('admin_homecontent.edit');
    $router->post('/edit/{id}', 'HomeFrontController@postEdit')->name('admin_homecontent.edit');
    $router->post('/delete', 'HomeFrontController@deleteList')->name('admin_homecontent.delete');
});