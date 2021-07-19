<?php
namespace App\Services;

use App\Contracts\BackgroundImageService;
use Unsplash\HttpClient;
use Unsplash\Photo;

class UnsplashService implements BackgroundImageService{

    protected $config;

    protected $instance;

    public function __construct($config)
    {
        HttpClient::init($config);
    }

    public function random($filters = [])
    {
        return Photo::random($filters);
    }
}
