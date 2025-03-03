<?php
$router->group(['prefix' => 'portfolio-tags'], function ($router) {
    $router->get('/', 'PortfoliotagController@index')->name('admin_portfolio_tag.index');
    $router->get('create', 'PortfoliotagController@create')->name('admin_portfolio_tag.create');
    $router->post('/create', 'PortfoliotagController@postCreate')->name('admin_portfolio_tag.create');
    $router->get('/edit/{id}', 'PortfoliotagController@edit')->name('admin_portfolio_tag.edit');
    $router->post('/edit/{id}', 'PortfoliotagController@postEdit')->name('admin_portfolio_tag.edit');
    $router->post('/delete', 'PortfoliotagController@deleteList')->name('admin_portfolio_tag.delete');
});