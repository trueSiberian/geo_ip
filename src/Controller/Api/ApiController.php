<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController extends BaseController
{
    protected function success($response = []): Response
    {
        return new Response(
            json_encode($response, JSON_UNESCAPED_UNICODE),
            200,
            [
                'Content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
            ]
        );
    }

    protected function fail(string $message, $status = 500): Response
    {
        $response = [
            'error' => $message,
        ];

        return new Response(
            json_encode($response, JSON_UNESCAPED_UNICODE),
            $status,
            [
                'Content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
            ]
        );
    }
}
