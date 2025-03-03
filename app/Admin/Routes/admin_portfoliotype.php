<?php
$router->group(['prefix' => 'portfolio-types'], function ($router) {
    $router->get('/', 'PortfoliotypeController@index')->name('admin_portfoliotype.index');
    $router->get('create', 'PortfoliotypeController@create')->name('admin_portfoliotype.create');
    $router->post('/create', 'PortfoliotypeController@postCreate')->name('admin_portfoliotype.create');
    $router->get('/edit/{id}', 'PortfoliotypeController@edit')->name('admin_portfoliotype.edit');
    $router->post('/edit/{id}', 'PortfoliotypeController@postEdit')->name('admin_portfoliotype.edit');
    $router->post('/delete', 'PortfoliotypeController@deleteList')->name('admin_portfoliotype.delete');
});
