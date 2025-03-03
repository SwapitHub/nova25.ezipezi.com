<?php
$router->group(['prefix' => 'header-menus'], function ($router) {
    $router->get('/', 'HeaderMController@index')->name('admin_headermenu.index');
    $router->get('create', 'HeaderMController@create')->name('admin_headermenu.create');
    $router->post('/create', 'HeaderMController@postCreate')->name('admin_headermenu.create');
    $router->get('/edit/{id}', 'HeaderMController@edit')->name('admin_headermenu.edit');
    $router->post('/edit/{id}', 'HeaderMController@postEdit')->name('admin_headermenu.edit');
    $router->post('/delete', 'HeaderMController@deleteList')->name('admin_headermenu.delete');
});
