<?php namespace Api;

use Laracasts;
use Response;
use Illuminate\Http\Response as IlluminateResponse;

class FeedController extends ApiController {

    /**
     * Because we fetch the feed,we don't want
     * to hit Laracasts server every time.
     * The standard cache time is 1 hour!
     */
    CONST LARACASTS_CACHE_DURATION = 30; //minutes

    public function __construct()
    {
        Laracasts::setCacheTime($this::LARACASTS_CACHE_DURATION);
    }

    /**
     * Returns cached feed.
     *
     * @return Response
     */
    public function getFeed()
    {
        return Response::json(
            $this->generateJSONForFeed(Laracasts::lessons()),
            IlluminateResponse::HTTP_OK,
            $this->setCORSHeaders()
        );
    }

    /**
     * @param $lessons
     * @return array
     */
    private function generateJSONForFeed($lessons)
    {
        $output = [];

        foreach ($lessons as $lesson)
        {
            $output[] = [
                'title'   => $lesson->title,
                'summary' => $lesson->summary,
                'link'    => $lesson->link,
                'type'    => $this->detectLessonOrSeries($lesson->link)
            ];
        }

        return $output;
    }

    /**
     * Returns only cached lessons from feed.
     *
     * @return mixed
     */
    public function getLessonsFromFeed()
    {
        return Response::json(
            $this->generateJSONOnlyForLessons(Laracasts::lessons()),
            IlluminateResponse::HTTP_OK,
            $this->setCORSHeaders()
        );
    }

    /**
     * @param $lessons
     * @return array
     */
    private function generateJSONOnlyForLessons($lessons)
    {
        $output = [];

        foreach ($lessons as $lesson)
        {
            if ($this->detectLessonOrSeries($lesson->link) == 'series') continue;

            $output[] = [
                'title'   => $lesson->title,
                'summary' => $lesson->summary,
                'link'    => $lesson->link,
                'type'    => $this->detectLessonOrSeries($lesson->link),
                'date'    => $this->getLessonDate($lesson->updated)
            ];
        }

        return $output;
    }

    /**
     * Detects if the item from the feed
     * is a lesson or a series.
     *
     * @param $string
     * @return string
     */
    private function detectLessonOrSeries($string)
    {
        if (strpos($string, 'episodes') !== false || strpos($string, 'lessons') !== false)
        {
            return 'lesson';
        }

        return 'series';
    }

    /**
     * Converts timestamp from feed to date format
     * DD.MM.YYYY ex: 23.12.2014
     *
     * @param $date
     * @return bool|string
     */
    private function getLessonDate($date)
    {
        return date('d.m.Y', strtotime($date));
    }

}
