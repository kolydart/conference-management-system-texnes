<?php

Route::group(['prefix' => '/v1', 'middleware' => ['auth:api'], 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('auth.change_password');
    Route::apiResource('rules', 'RulesController', ['only' => ['index']]);
    Route::apiResource('papers', 'PapersController');
    Route::apiResource('judgements', 'JudgementsController');
    Route::apiResource('arts', 'ArtsController');
    Route::apiResource('users', 'UsersController');
    Route::apiResource('content-pages', 'ContentPagesController');
    Route::apiResource('content-categories', 'ContentCategoriesController');
    Route::apiResource('content-tags', 'ContentTagsController');
    Route::apiResource('permissions', 'PermissionsController');
    Route::apiResource('roles', 'RolesController');
    Route::apiResource('user-actions', 'UserActionsController');
});
