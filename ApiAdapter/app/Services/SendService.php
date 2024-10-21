<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendService
{
    public static function sendGetToExternalApi()
    {
        $token = config('dev.accessToken', '');
        $url = config('dev.externalApiUrl', '') . 'employees';

        $response = Http::withToken($token)->get($url);
        
        if (!$response->successful()) {
            return self::handleErrorResponse($response);
        }
        
        return $response->json();
    }

    public static function sendPostToExternalApi($data)
    {
        $token = config('dev.accessToken', '');
        $url = config('dev.externalApiUrl', '') . 'employees';

        $response = Http::withToken($token)->post($url, $data);

        if (!$response->successful()) {
            return self::handleErrorResponse($response);
        }

        return $response->json();
    }

    public static function sendPatchToExternalApi($data, int $id)
    {
        $token = config('dev.accessToken', '');
        $url = config('dev.externalApiUrl', '') . "employees/$id";

        $response = Http::withToken($token)->patch($url, $data);

        if (!$response->successful()) {
            return self::handleErrorResponse($response);
        }

        return $response->json();
    }

    private static function handleErrorResponse($response)
    {
        return response()->json([
            'status' => 'error',
            'message' => 'External API error',
            'details' => $response->json() ?? $response->body(),
        ], $response->status());
    }
}
