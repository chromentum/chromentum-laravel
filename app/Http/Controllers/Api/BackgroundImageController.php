<?php

namespace App\Http\Controllers\Api;

use App\Contracts\BackgroundImageService;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackgroundImageResource;
use Illuminate\Http\Request;
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
        $key = md5($request->key);

        $photo = Cache::remember($key, config('cache.ttl'), function () use($backgroundImage) {
            return $backgroundImage->random([
                "h" => 768,
                "w" => 1024,
                "query" => "landscape"
            ]);
        });

        return new BackgroundImageResource($photo);
    }
}
