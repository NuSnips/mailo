<?php

namespace Domain\Shared\Traits;

use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait ForceJsonResponse
{
    public function forceJsonResponse($response, $status = 200)
    {
        if ($response instanceof JsonResponse) {
            return $response;
        }
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
