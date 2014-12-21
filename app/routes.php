<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function()
{
    Route::get('feed/lessons', 'FeedController@getLessons');

    Route::get('feed', 'FeedController@getFeed');
});
