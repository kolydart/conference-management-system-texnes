<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () { return redirect('/admin/home'); })->middleware('backend');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::post('register', 'Auth\RegisterController@register')->name('auth.register');

// Admin
Route::group(['middleware' => ['backend','auth','approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/reports/fullpaper-uploads', 'Admin\ReportsController@fullpaperUploads');
    Route::get('/reports/user-registrations', 'Admin\ReportsController@userRegistrations');

    Route::get('/calendar', 'Admin\SystemCalendarController@index');

    Route::resource('sessions', 'Admin\SessionsController');
    Route::post('sessions_mass_destroy', ['uses' => 'Admin\SessionsController@massDestroy', 'as' => 'sessions.mass_destroy']);
    Route::post('sessions_restore/{id}', ['uses' => 'Admin\SessionsController@restore', 'as' => 'sessions.restore']);
    Route::delete('sessions_perma_del/{id}', ['uses' => 'Admin\SessionsController@perma_del', 'as' => 'sessions.perma_del']);
    Route::resource('rooms', 'Admin\RoomsController');
    Route::post('rooms_mass_destroy', ['uses' => 'Admin\RoomsController@massDestroy', 'as' => 'rooms.mass_destroy']);
    Route::post('rooms_restore/{id}', ['uses' => 'Admin\RoomsController@restore', 'as' => 'rooms.restore']);
    Route::delete('rooms_perma_del/{id}', ['uses' => 'Admin\RoomsController@perma_del', 'as' => 'rooms.perma_del']);
    Route::resource('papers', 'Admin\PapersController');
    Route::post('papers_mass_destroy', ['uses' => 'Admin\PapersController@massDestroy', 'as' => 'papers.mass_destroy']);
    Route::post('papers_restore/{id}', ['uses' => 'Admin\PapersController@restore', 'as' => 'papers.restore']);
    Route::delete('papers_perma_del/{id}', ['uses' => 'Admin\PapersController@perma_del', 'as' => 'papers.perma_del']);
    Route::resource('fullpapers', 'Admin\FullpapersController');
    Route::post('fullpapers_mass_destroy', ['uses' => 'Admin\FullpapersController@massDestroy', 'as' => 'fullpapers.mass_destroy']);
    Route::post('fullpapers_restore/{id}', ['uses' => 'Admin\FullpapersController@restore', 'as' => 'fullpapers.restore']);
    Route::delete('fullpapers_perma_del/{id}', ['uses' => 'Admin\FullpapersController@perma_del', 'as' => 'fullpapers.perma_del']);
    Route::resource('arts', 'Admin\ArtsController');
    Route::post('arts_mass_destroy', ['uses' => 'Admin\ArtsController@massDestroy', 'as' => 'arts.mass_destroy']);
    Route::post('arts_restore/{id}', ['uses' => 'Admin\ArtsController@restore', 'as' => 'arts.restore']);
    Route::delete('arts_perma_del/{id}', ['uses' => 'Admin\ArtsController@perma_del', 'as' => 'arts.perma_del']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('reviews', 'Admin\ReviewsController');
    Route::post('reviews_mass_destroy', ['uses' => 'Admin\ReviewsController@massDestroy', 'as' => 'reviews.mass_destroy']);
    Route::post('reviews_restore/{id}', ['uses' => 'Admin\ReviewsController@restore', 'as' => 'reviews.restore']);
    Route::delete('reviews_perma_del/{id}', ['uses' => 'Admin\ReviewsController@perma_del', 'as' => 'reviews.perma_del']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);
    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('lunches', 'Admin\LunchesController');
    Route::post('lunches_mass_destroy', ['uses' => 'Admin\LunchesController@massDestroy', 'as' => 'lunches.mass_destroy']);
    Route::post('lunches_restore/{id}', ['uses' => 'Admin\LunchesController@restore', 'as' => 'lunches.restore']);
    Route::delete('lunches_perma_del/{id}', ['uses' => 'Admin\LunchesController@perma_del', 'as' => 'lunches.perma_del']);
    Route::resource('availabilities', 'Admin\AvailabilitiesController');
    Route::post('availabilities_mass_destroy', ['uses' => 'Admin\AvailabilitiesController@massDestroy', 'as' => 'availabilities.mass_destroy']);
    Route::post('availabilities_restore/{id}', ['uses' => 'Admin\AvailabilitiesController@restore', 'as' => 'availabilities.restore']);
    Route::delete('availabilities_perma_del/{id}', ['uses' => 'Admin\AvailabilitiesController@perma_del', 'as' => 'availabilities.perma_del']);
    Route::resource('colors', 'Admin\ColorsController');
    Route::post('colors_mass_destroy', ['uses' => 'Admin\ColorsController@massDestroy', 'as' => 'colors.mass_destroy']);
    Route::post('colors_restore/{id}', ['uses' => 'Admin\ColorsController@restore', 'as' => 'colors.restore']);
    Route::delete('colors_perma_del/{id}', ['uses' => 'Admin\ColorsController@perma_del', 'as' => 'colors.perma_del']);
    Route::resource('messages', 'Admin\MessagesController');
    Route::post('messages_mass_destroy', ['uses' => 'Admin\MessagesController@massDestroy', 'as' => 'messages.mass_destroy']);
    Route::post('messages_restore/{id}', ['uses' => 'Admin\MessagesController@restore', 'as' => 'messages.restore']);
    Route::delete('messages_perma_del/{id}', ['uses' => 'Admin\MessagesController@perma_del', 'as' => 'messages.perma_del']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('activitylogs', 'Admin\ActivitylogsController');
    Route::post('activitylogs_mass_destroy', ['uses' => 'Admin\ActivitylogsController@massDestroy', 'as' => 'activitylogs.mass_destroy']);
    Route::resource('loguseragents', 'Admin\LoguseragentsController');
    Route::post('loguseragents_mass_destroy', ['uses' => 'Admin\LoguseragentsController@massDestroy', 'as' => 'loguseragents.mass_destroy']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    Route::get('/attends/delete/{paper_id}/{user_id}', 'Admin\PapersController@attendsDelete')->name('attends.delete');

    Route::get('/export/labs',
        function() {
            \Artisan::call('export:labs2file');
            return \File::get(base_path() . '/storage/export/labs.html');
        })->name('export.labs');


});


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

// Route::get('/lunch/confirm/{lunch_id}', function (\Illuminate\Http\Request $request) {
//     if (! $request->hasValidSignature()) {
// 	    \gateweb\common\Presenter::message("<h4>Η προθεσμία επιβεβαίωσης παρήλθε. Επικοινωνήστε με την γραμματεία.</h4>","warning");
//     }else{
// 	    $lunch = \App\Lunch::findOrFail($request->lunch_id);
// 	    $lunch->update(['confirm' => 'confirmed']);
// 	    \gateweb\common\Presenter::message("<h4>Η δήλωσή σας για το γεύμα επιβεβαιώθηκε ($lunch->menu)</h4>","success");
//     }
//     return redirect(route('frontend.home'));

// })->name('frontend.lunch.confirm');

/* edit lab with signed url */
Route::get('/papers/{paper}/edit', 'Frontend\PapersController@edit')->name('frontend.papers.edit');
Route::post('/frontend/spatie/media/upload', 'Frontend\SpatieMediaController@create')->name('frontend.media.upload');

/* store is protected with csrf */
Route::put('/papers/{paper}', 'Frontend\PapersController@update')->name('frontend.papers.update');
/** secure download Fullpaper using uuid */
Route::get('/fullpapers/{uuid}/download/{paper_id?}', 'Frontend\FullpapersController@download')->name('frontend.fullpapers.download');

/** proceedings */
Route::get('/admin/proceedings/papers', 'Admin\PapersController@proceedingsPapers')->name('admin.proceedings.papers')->middleware(['backend','auth','approved']);
Route::get('/admin/proceedings/labs', 'Admin\PapersController@proceedingsLabs')->name('admin.proceedings.labs')->middleware(['backend','auth','approved']);


/** disable registration */
Route::redirect('/register', '/');
