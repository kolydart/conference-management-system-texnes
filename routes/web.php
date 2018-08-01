<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('papers', 'Admin\PapersController');
    Route::post('papers_mass_destroy', ['uses' => 'Admin\PapersController@massDestroy', 'as' => 'papers.mass_destroy']);
    Route::post('papers_restore/{id}', ['uses' => 'Admin\PapersController@restore', 'as' => 'papers.restore']);
    Route::delete('papers_perma_del/{id}', ['uses' => 'Admin\PapersController@perma_del', 'as' => 'papers.perma_del']);
    Route::resource('reviews', 'Admin\ReviewsController');
    Route::post('reviews_mass_destroy', ['uses' => 'Admin\ReviewsController@massDestroy', 'as' => 'reviews.mass_destroy']);
    Route::post('reviews_restore/{id}', ['uses' => 'Admin\ReviewsController@restore', 'as' => 'reviews.restore']);
    Route::delete('reviews_perma_del/{id}', ['uses' => 'Admin\ReviewsController@perma_del', 'as' => 'reviews.perma_del']);
    Route::resource('arts', 'Admin\ArtsController');
    Route::post('arts_mass_destroy', ['uses' => 'Admin\ArtsController@massDestroy', 'as' => 'arts.mass_destroy']);
    Route::post('arts_restore/{id}', ['uses' => 'Admin\ArtsController@restore', 'as' => 'arts.restore']);
    Route::delete('arts_perma_del/{id}', ['uses' => 'Admin\ArtsController@perma_del', 'as' => 'arts.perma_del']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);
    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



 
});
