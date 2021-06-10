<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CategoryService;

class HomeController extends Controller
{
    public function __construct(
        CategoryService $categoryService
    ) {}

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