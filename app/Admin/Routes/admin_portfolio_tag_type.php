<?php
$router->group(['prefix' => 'portfolio-tag-types'], function ($router) {
    $router->get('/', 'PortfolioTagTypeController@index')->name('admin_portfolio_tag_type.index');
    $router->get('create', 'PortfolioTagTypeController@create')->name('admin_portfolio_tag_type.create');
    $router->post('/create', 'PortfolioTagTypeController@postCreate')->name('admin_portfolio_tag_type.create');
    $router->get('/edit/{id}', 'PortfolioTagTypeController@edit')->name('admin_portfolio_tag_type.edit');
    $router->post('/edit/{id}', 'PortfolioTagTypeController@postEdit')->name('admin_portfolio_tag_type.edit');
    $router->post('/delete', 'PortfolioTagTypeController@deleteList')->name('admin_portfolio_tag_type.delete');
});
