<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('papers', 'PapersController', ['except' => ['create', 'edit']]);

});
