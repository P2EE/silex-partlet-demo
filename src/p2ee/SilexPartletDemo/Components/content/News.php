<?php
namespace p2ee\SilexPartletDemo\Components\content;

use p2ee\Partlets\PartletRequirement;
use p2ee\SilexPartletDemo\SilexPartlet;

class News extends SilexPartlet {

    protected $newsItems = [];

    public function collect() {
        yield [
            new PartletRequirement(
                'newsItems',
                NewsItem::class,
                [
                    'title' => 'News 1',
                    'text' => 'Lorem ipsum',
                ]
            ),
            new PartletRequirement(
                'newsItems',
                NewsItem::class,
                [
                'title' => 'News 2',
                'text' => 'dolor sit amet',
                ]
            ),
            new PartletRequirement(
                'newsItems',
                NewsItem::class,
                [
                'title' => 'News third',
                'text' => 'consectetur adipiscing elit',
                ]
            ),
        ];
    }

    public function getData() {
        return [
            'newslist' => $this->newsItems
        ];
    }
}