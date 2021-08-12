<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
        $key =  'quote-' . (string)now()->format('dmy') . Arr::random($numbers);

        $quote = Cache::remember($key, config('cache.ttl'), function () {
            return Quote::inRandomOrder()->first();
        });

        return new QuoteResource($quote);
    }
}
