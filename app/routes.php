<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function()
{
    Route::get('feed/lessons', 'FeedController@getLessonsFromFeed');

    Route::get('feed', 'FeedController@getFeed');
});
