<?php


namespace App\Http\Clients\Youtube;


use Google_Service_YouTube_Thumbnail;

class YoutubeChannelLogo
{
    public string $url;
    public int $width;
    public int $height;

    public function __construct(Google_Service_YouTube_Thumbnail $thumbnail)
    {
        $this->url = $thumbnail->getUrl();
        $this->width = $thumbnail->getWidth();
        $this->height = $thumbnail->getHeight();
    }
}
