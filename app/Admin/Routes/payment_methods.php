<?php
$router->group(['prefix' => 'payment-method'], function ($router) {
    $router->get('/', 'PaymentMethodController@index')->name('admin_payment_method.index');
    $router->get('create', 'PaymentMethodController@create')->name('admin_payment_method.create');
    $router->post('/create', 'PaymentMethodController@postCreate')->name('admin_payment_method.create');
    $router->get('/edit/{id}', 'PaymentMethodController@edit')->name('admin_payment_method.edit');
    $router->post('/edit/{id}', 'PaymentMethodController@postEdit')->name('admin_payment_method.edit');
    $router->post('/delete', 'PaymentMethodController@deleteList')->name('admin_payment_method.delete');
});
