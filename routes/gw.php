<?php

Route::get('/', 'Frontend\HomeController@index')->name('frontend.home');

Route::get('/contact', 'Frontend\HomeController@contact')->name('frontend.contact');
Route::post('/contact', 'Frontend\HomeController@contact')->name('frontend.contact');

Route::get('arts', 'Frontend\ArtsController@index')->name('frontend.arts.index');
Route::get('arts/{id}', 'Frontend\ArtsController@show')->name('frontend.arts.show');

Route::get('papers', 'Frontend\PapersController@index')->name('frontend.papers.index');
Route::get('papers/{id}', 'Frontend\PapersController@show')->name('frontend.papers.show');

Route::get('rooms', 'Frontend\RoomsController@index')->name('frontend.rooms.index');
Route::get('rooms/{id}', 'Frontend\RoomsController@show')->name('frontend.rooms.show');

Route::get('sessions', 'Frontend\SessionsController@index')->name('frontend.sessions.index');
Route::get('sessions/{id}', 'Frontend\SessionsController@show')->name('frontend.sessions.show');

Route::get('/calendar', 'Admin\SystemCalendarController@index')->name('frontend.calendar'); 

Route::get('/page/{alias}', 'Frontend\ContentPagesController@show')->name('frontend.pages.show');

Route::get('/attend/', 'Frontend\AttendsController@index')->name('frontend.attend.index');
Route::get('/attend/{paper_id}', 'Frontend\AttendsController@create')->name('frontend.attend.create');
Route::get('/attend/delete/{paper_id}', 'Frontend\AttendsController@delete')->name('frontend.attend.delete');

Route::get('/lunch/confirm/{lunch_id}', function (\Illuminate\Http\Request $request) {
    if (! $request->hasValidSignature()) {
	    \gateweb\common\Presenter::message("<h4>Η προθεσμία επιβεβαίωσης παρήλθε. Επικοινωνήστε με την γραμματεία.</h3>","warning");
    }else{
	    $lunch = \App\Lunch::findOrFail($request->lunch_id);
	    $lunch->update(['confirm' => 'confirmed']);
	    \gateweb\common\Presenter::message("<h4>Η δήλωσή σας για το γεύμα επιβεβαιώθηκε ($lunch->menu)</h4>","success");
    }
    return redirect(route('frontend.home'));

})->name('frontend.lunch.confirm');


/** disable registration */
Route::any('/register', function() {
	\gateweb\common\Presenter::message(__('Registration is disabled'));
    return redirect('/');
});