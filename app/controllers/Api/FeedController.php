<?php namespace Api;

use Cache;
use Laracasts;
use Response;

class FeedController extends ApiController {

    CONST CACHE_DURATION = 60;//minutes

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //if (Cache::has('response')) return Cache::get('response');

        $lessons = Laracasts::lessons();

        $output = $this->generateJSONForFeed($lessons);

        $header = $this->setCORSHeaders();

        $response = Response::json($output, 200, $header);

        //Cache::put('response', $response, $this::CACHE_DURATION);

        return $response;
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

    private function detectLessonOrSeries($string)
    {
        if (strpos($string, 'episodes') !== false) return 'lesson';

        return 'serie';
    }

    public function getLessonsFromFeed()
    {
        //if (Cache::has('response')) return Cache::get('response');

        $lessons = Laracasts::lessons();

        $output = $this->generateJSONOnlyForLessons($lessons);

        $header = $this->setCORSHeaders();

        $response = Response::json($output, 200, $header);

        //Cache::put('response', $response, $this::CACHE_DURATION);

        return $response;
    }

    private function generateJSONOnlyForLessons($lessons)
    {
        $output = [
/*            [
                'title'   => "test",
                'summary' => "test x2",
                'link'    => "link",
                'type'    => "lesson",
                'date'    => "01.01.2014"
            ],
            [
                'title'   => "test 2",
                'summary' => "test x2",
                'link'    => "link",
                'type'    => "lesson",
                'date'    => "09.12.2014"
            ]*/
        ];

        foreach ($lessons as $lesson)
        {
            if ($this->detectLessonOrSeries($lesson->link) == 'serie') continue;

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

    private function getLessonDate($date)
    {
        return date('d.m.Y', strtotime($date));
    }

}
