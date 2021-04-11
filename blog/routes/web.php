<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Front End Routes

Route::get('/', 'App\Http\Controllers\FrontEndController@home')->name('website');
Route::get('/about', 'App\Http\Controllers\FrontEndController@about')->name('website.about');
Route::get('/roman', 'App\Http\Controllers\FrontEndController@roman')->name('website.roman');
Route::get('/category/{slug}', 'App\Http\Controllers\FrontEndController@category')->name('website.category');
Route::get('/tag/{slug}', 'App\Http\Controllers\FrontEndController@tag')->name('website.tag');
Route::get('/contact', 'App\Http\Controllers\FrontEndController@contact')->name('website.contact');
Route::get('/post/{slug}', 'App\Http\Controllers\FrontEndController@post')->name('website.post');

Route::post('/contact', 'App\Http\Controllers\FrontEndController@send_message')->name('website.contact');

//Admin Panel Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
  Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('tag', 'App\Http\Controllers\TagController');
    Route::resource('post', 'App\Http\Controllers\PostController');
    Route::resource('user', 'App\Http\Controllers\UserController');

    Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('user.profile');
    Route::post('/profile', 'App\Http\Controllers\UserController@profile_update')->name('user.profile.update');

      // setting
      Route::get('setting', 'App\Http\Controllers\SettingController@edit')->name('setting.index');
      Route::post('setting', 'App\Http\Controllers\SettingController@update')->name('setting.update');

      // Contact message
    Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
    Route::get('/contact/show/{id}', 'App\Http\Controllers\ContactController@show')->name('contact.show');
    Route::delete('/contact/delete/{id}', 'App\Http\Controllers\ContactController@destroy')->name('contact.destroy');

});

