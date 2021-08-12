<?php

namespace App\Http\Controllers\Api;

use App\Contracts\BackgroundImageService;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackgroundImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class BackgroundImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, BackgroundImageService $backgroundImage)
    {
        $numbers = ["1", "2", "3", "4", "5"];
        $key =  'background-image-' . (string)now()->format('dmy') . Arr::random($numbers);

        $photo = Cache::remember($key, config('cache.ttl'), function () use($backgroundImage) {
            return $backgroundImage->random([
                "query" => config('app.background-image.unsplash.categories'),
                "orientation" => "landscape"
            ]);
        });

        return new BackgroundImageResource($photo);
    }
}
