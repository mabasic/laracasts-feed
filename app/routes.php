<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function()
{
    Route::resource('feed', 'FeedController', ['only' => ['index']]);
});
