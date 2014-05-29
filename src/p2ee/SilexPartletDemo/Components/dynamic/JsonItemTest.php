<?php
namespace p2ee\SilexPartletDemo\Components\dynamic;

use p2ee\SilexPartletDemo\Requirement\JsonFileRequirement;
use p2ee\SilexPartletDemo\SilexPartlet;

class JsonItemTest extends SilexPartlet
{

    protected $article;

    public function collect()
    {
        yield [
            new JsonFileRequirement('article' , __DIR__ . '/item.json', 'article1'),
        ];
    }

    public function getData()
    {

        return [
            'title' => $this->article['title'],
            'text'  => $this->article['text'],
        ];
    }
    
} 