<?php
$router->group(['prefix' => 'branch'], function ($router) {
    $router->get('/', 'BranchController@index')->name('admin_branch.index');
    $router->get('create', 'BranchController@create')->name('admin_branch.create');
    $router->post('/create', 'BranchController@postCreate')->name('admin_branch.create');
    $router->get('/edit/{id}', 'BranchController@edit')->name('admin_branch.edit');
    $router->post('/edit/{id}', 'BranchController@postEdit')->name('admin_branch.edit');
    $router->post('/delete', 'BranchController@deleteList')->name('admin_branch.delete');
});
