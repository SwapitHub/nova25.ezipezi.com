<?php
$router->group(['prefix' => 'portfolio-tabs'], function ($router) {
    $router->get('/', 'PortfoliotabController@index')->name('admin_portfoliotab.index');
    $router->get('create', 'PortfoliotabController@create')->name('admin_portfoliotab.create');
    $router->post('/create', 'PortfoliotabController@postCreate')->name('admin_portfoliotab.create');
    $router->get('/edit/{id}', 'PortfoliotabController@edit')->name('admin_portfoliotab.edit');
    $router->post('/edit/{id}', 'PortfoliotabController@postEdit')->name('admin_portfoliotab.edit');
    $router->post('/delete', 'PortfoliotabController@deleteList')->name('admin_portfoliotab.delete');
});
