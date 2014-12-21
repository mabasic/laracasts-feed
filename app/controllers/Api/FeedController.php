<?php namespace Api;

use Mabasic\Laracasts\Feed;

class FeedController extends ApiController {

    protected $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function getFeed()
    {
        return $this->respondWithCORS($this->feed->getFeed());
    }

    public function getLessons()
    {
        return $this->respondWithCORS($this->feed->getLessons());
    }
}
