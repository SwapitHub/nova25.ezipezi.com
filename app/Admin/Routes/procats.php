<?php
$router->group(['prefix' => 'product-categories'], function ($router) {
    $router->get('/', 'ProcatController@index')->name('admin_procat.index');
    $router->get('create', 'ProcatController@create')->name('admin_procat.create');
    $router->post('/create', 'ProcatController@postCreate')->name('admin_procat.create');
    $router->get('/edit/{id}', 'ProcatController@edit')->name('admin_procat.edit');
    $router->post('/edit/{id}', 'ProcatController@postEdit')->name('admin_procat.edit');
    $router->post('/delete', 'ProcatController@deleteList')->name('admin_procat.delete');
});