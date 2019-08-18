<?php

Route::get('/', 'PagesController@index')->name('/');

/* Admin Routes */
Route::get('/admin0123rwq2/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin0123rwq2/login', 'Admin\Auth\LoginController@login')->name('admin.login');

Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin0123rwq2'], function() 
{
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('brands', 'BrandsController')->names([
        'index' => 'admin.brands.index',
        'store' => 'admin.brands.store',
        'create' => 'admin.brands.create',
        'destroy' => 'admin.brands.destroy',
        'update' => 'admin.brands.update',
        'edit' => 'admin.brands.edit'
    ])->except(['show']);

    Route::resource('categories', 'CategoriesController')->names([
        'index' => 'admin.categories.index',
        'store' => 'admin.categories.store',
        'create' => 'admin.categories.create',
        'destroy' => 'admin.categories.destroy',
        'update' => 'admin.categories.update',
        'edit' => 'admin.categories.edit'
    ])->except(['show']);

    Route::resource('motorcycles', 'MotorcyclesController')->names([
        'index' => 'admin.motorcycles.index',
        'store' => 'admin.motorcycles.store',
        'create' => 'admin.motorcycles.create',
        'destroy' => 'admin.motorcycles.destroy',
        'update' => 'admin.motorcycles.update',
        'edit' => 'admin.motorcycles.edit'
    ])->except(['show']);
    
    Route::resource('types', 'TypesController')->names([
        'index' => 'admin.types.index',
        'store' => 'admin.types.store',
        'create' => 'admin.types.create',
        'destroy' => 'admin.types.destroy',
        'update' => 'admin.types.update',
        'edit' => 'admin.types.edit'
    ])->except(['show']);

    Route::get('/attributes/motorcycle/{motorcycle}', 'AttributesController@index')->name('admin.attributes.index');
    Route::get('/attributes/{type}/create', 'AttributesController@create')->name('admin.attributes.create');
    Route::post('/attributes/{type}', 'AttributesController@store')->name('admin.attributes.store');
    Route::get('/attributes/{attribute}/edit', 'AttributesController@edit')->name('admin.attributes.edit');
    Route::patch('/attributes/{attribute}', 'AttributesController@update')->name('admin.attributes.update');
    Route::delete('/attributes/{attribute}', 'AttributesController@destroy')->name('admin.attributes.destroy');
    
    /* API */
    Route::post('/api/motorcycles/photos/{key}', 'Api\PhotosUploadController@store')->name('api.motorcycles.photos.store');
});

/* Frontend Routes */
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/motorcycles/create', 'MotorcyclesController@create')->name('motorcycles.create');
Route::post('/motorcycles', 'MotorcyclesController@store')->name('motorcycles.store');
Route::get('/motorcycles/created/{motorcycle}', 'MotorcyclesController@created')->name('motorcycles.created');

Route::get('/motorcycles', 'MotorcyclesController@index')->name('motorcycles.index');
Route::get('/motorcycles/{brand}/{motorcycle}', 'MotorcyclesController@show')->name('motorcycles.show');

/* Auth Routes */
Auth::routes();