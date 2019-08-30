<?php


namespace common\clases;


use common\behance\traits\RepoTrait;

class YoutubeView
{

    use RepoTrait;

    public function view($url)
    {
        $proxy = $this->getRandomProxy();
        $command =  'python3 '.__DIR__.'/../../scripts/youtube.py '.$proxy.' '.$url;
        $result = exec($command);
        return $result == 1;
    }

    public static function run()
    {
        return new self();
    }

}