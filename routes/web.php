<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/check_hotel/{id}', 'App\Http\Controllers\RuleController@checkHotel')->name('check_hotel');
Route::get('/agencies', 'App\Http\Controllers\AgencyController@showAll')->name('agencies');
Route::get('/agency/{id}', 'App\Http\Controllers\AgencyController@getRules')->name('agency');
Route::get('/rule/create', 'App\Http\Controllers\RuleController@create')->name('rule.create');
Route::post('/rule/store', 'App\Http\Controllers\RuleController@store')->name('rule.store');
Route::get('/rule/{id}', 'App\Http\Controllers\RuleController@edit')->name('rule.edit');
Route::post('/rule/update/{id}', 'App\Http\Controllers\RuleController@update')->name('rule.update');
Route::get('/rule/delete/{id}', 'App\Http\Controllers\RuleController@destroy')->name('rule.delete');
