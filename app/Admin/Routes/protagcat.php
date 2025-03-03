<?php
$router->group(['prefix' => 'product-tags'], function ($router) {
    $router->get('/', 'ProtagcatController@index')->name('admin_protagcat.index');
    $router->get('create', 'ProtagcatController@create')->name('admin_protagcat.create');
    $router->post('/create', 'ProtagcatController@postCreate')->name('admin_protagcat.create');
    $router->get('/edit/{id}', 'ProtagcatController@edit')->name('admin_protagcat.edit');
    $router->post('/edit/{id}', 'ProtagcatController@postEdit')->name('admin_protagcat.edit');
    $router->post('/delete', 'ProtagcatController@deleteList')->name('admin_protagcat.delete');
});