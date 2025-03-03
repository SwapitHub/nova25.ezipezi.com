<?php
$router->group(['prefix' => 'portfolio'], function ($router) {
    $router->get('/', 'PortfolioController@index')->name('admin_portfolio.index');
    $router->get('create', 'PortfolioController@create')->name('admin_portfolio.create');
    $router->post('/create', 'PortfolioController@postCreate')->name('admin_portfolio.create');
    $router->get('/edit/{id}', 'PortfolioController@edit')->name('admin_portfolio.edit');
    $router->post('/edit/{id}', 'PortfolioController@postEdit')->name('admin_portfolio.edit');
    $router->post('/delete', 'PortfolioController@deleteList')->name('admin_portfolio.delete');
    $router->post('/deleteimg', 'PortfolioController@deleteImg')->name('admin_portfolio.deleteimg');
});
