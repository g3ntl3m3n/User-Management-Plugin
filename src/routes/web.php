<?php

Route::group(
    ['prefix' => 'management/user',
    'namespace' => 'Modul\userModul\Http\Controllers',
    'middleware' => ['web','auth']], function () {
        Route::match(['get', 'post'], '/', 'UserController@index')->name('management.user');
        Route::get('/new', 'UserController@form')->name('management.user.new');
        Route::get('/edit/{id}', 'UserController@form')->name('management.user.edit');
        Route::post('/save/{id?}', 'UserController@save')->name('management.user.save');
        Route::get('/delete/{id}', 'UserController@delete')->name('management.user.delete');


});
