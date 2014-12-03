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
        if (Cache::has('response')) return Cache::get('response');

        $lessons = Laracasts::lessons();

        $output = $this->generateJSONForLessons($lessons);

        $header = $this->setCORSHeaders();

        Cache::put('response', $response = Response::json($output, 200, $header), $this::CACHE_DURATION);

        return $response;
    }

    /**
     * @param $lessons
     * @return array
     */
    private function generateJSONForLessons($lessons)
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
        if(strpos($string, 'episodes') !== false) return 'lesson';

        return 'serie';
    }

}
