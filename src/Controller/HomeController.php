<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(): Response
    {
        try {
            return $this->success(["status" => "running"]);
        } catch(\Exception $e) {
            return $this->error($e);
        }
    }
}