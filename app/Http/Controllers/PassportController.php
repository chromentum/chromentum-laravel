<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PassportController extends Controller
{
    /**
     * Handle the redirect here
     *
     * @param \Illumintate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Request $request)
    {
        $state = $request->state;
        $code_verifier = $request->code_verifier;

        $codeChallenge = strtr(rtrim(
            base64_encode(hash('sha256', $code_verifier, true))
        , '='), '+/', '-_');

        $query = http_build_query([
            'client_id' => config('app.passport.client-id'),
            'redirect_uri' => config('app.passport.redirect-uri'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        return redirect(url('/oauth/authorize?'.$query));
    }

    /**
     * Handle callback
     *
     * @param \Illumintate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function callback(Request $request)
    {
        $state = $request->state;
        $codeVerifier = $request->code_verifier;

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'authorization_code',
            'client_id' => config('app.passport.client-id'),
            'redirect_uri' => config('app.passport.redirect-uri'),
            'code_verifier' => $codeVerifier,
            'code' => $request->code,
        ]);

        return $response->json();
    }
}
