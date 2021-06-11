<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller extends AbstractController
{
    private function setHeaders(Response $response): Response
    {
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    protected function success(mixed $data = null, string $message = null, int $code = 200): Response
    {
        $response = new Response(json_encode([
            'status'=> 'success',
            'message' => $message,
            'data' => $data
        ]), $code);
        $response = $this->setHeaders($response);
        return $response;
    }

    protected function error(\Exception $e): Response
    {
        $response = new Response(json_encode([
            'status'=> 'error',
            'message' => $e->getMessage(),
            'data' => null
        ]), $e->getCode() ? $e->getCode() : 500);
        $response = $this->setHeaders($response);
        return $response;
    }
}