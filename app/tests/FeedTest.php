<?php

use Malfaitrobin\Laracasts\Laracasts;
use Mabasic\Laracasts\Feed;

class FeedTest extends TestCase {

    /** @test */
    public function it_returns_a_feed()
    {
        $feed = new Feed(new Laracasts($this->app['cache']));

        $response = $feed->getFeed();

        $this->assertInternalType('array', $response);
    }

    /** @test */
    public function it_returns_lessons()
    {
        $feed = new Feed(new Laracasts($this->app['cache']));

        $response = $feed->getLessons();

        $this->assertInternalType('array', $response);
    }

}
