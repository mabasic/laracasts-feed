<?php namespace Mabasic\Laracasts;

use Malfaitrobin\Laracasts\Laracasts;

class Feed {

    CONST LARACASTS_CACHE_DURATION = 30; //minutes

    protected $laracasts;

    protected $items;

    public function __construct(Laracasts $laracasts)
    {
        $this->laracasts = $laracasts;

        $this->laracasts->setCacheTime($this::LARACASTS_CACHE_DURATION);

        $this->items = (array) $this->laracasts->lessons();
    }

    public function getFeed()
    {
        return array_map([$this, 'mapFeedItem'], $this->items);
    }

    public function getLessons()
    {
        return array_map([$this, 'mapFeedLesson'], $this->filterLessons());
    }

    private function filterLessons()
    {
        return array_values(array_filter($this->items, function ($item)
        {
            if ($this->detectFeedItemType($item->link) == 'lesson') return true;

            return false;
        }));
    }

    private function mapFeedItem($item)
    {
        return [
            'title'   => $item->title,
            'summary' => $item->summary,
            'link'    => $item->link,
            'type'    => $this->detectFeedItemType($item->link)
        ];
    }

    private function mapFeedLesson($item)
    {
        return [
            'title'   => $item->title,
            'summary' => $item->summary,
            'link'    => $item->link,
            'type'    => $this->detectFeedItemType($item->link),
            'date'    => $this->formatDate($item->updated)
        ];
    }

    private function detectFeedItemType($string)
    {
        if (strpos($string, 'episodes') !== false || strpos($string, 'lessons') !== false)
        {
            return 'lesson';
        }

        return 'series';
    }

    private function formatDate($date)
    {
        return date('d.m.Y', strtotime($date));
    }

}