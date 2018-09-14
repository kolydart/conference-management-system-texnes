<?php

Route::get('/', 'Frontend\HomeController@index')->name('frontend.home');

Route::get('/contact', 'Frontend\HomeController@contact')->name('frontend.contact');

Route::get('arts', 'Frontend\ArtsController@index')->name('frontend.arts.index');
Route::get('arts/{id}', 'Frontend\ArtsController@show')->name('frontend.arts.show');

Route::get('papers', 'Frontend\PapersController@index')->name('frontend.papers.index');
Route::get('papers/{id}', 'Frontend\PapersController@show')->name('frontend.papers.show');

Route::get('rooms', 'Frontend\RoomsController@index')->name('frontend.rooms.index');
Route::get('rooms/{id}', 'Frontend\RoomsController@show')->name('frontend.rooms.show');

Route::get('sessions', 'Frontend\SessionsController@index')->name('frontend.sessions.index');
Route::get('sessions/{id}', 'Frontend\SessionsController@show')->name('frontend.sessions.show');

Route::get('/calendar', 'Frontend\SystemCalendarController@index')->name('frontend.calendar'); 

Route::get('/page/{alias}', 'Frontend\ContentPagesController@show')->name('frontend.pages.show');

