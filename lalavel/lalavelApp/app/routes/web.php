<?php
Route::get('/', function () {
  return view('welcome');
});

Route::get('hello/{id?}', 'HelloController@index');