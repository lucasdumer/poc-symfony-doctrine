<?php

namespace App\Controller;

use App\Command\CategoryCreateCommand;
use App\Command\CategoryUpdateCommand;
use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    /**
     * @Route("/api/categories", name="category_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent());
            return $this->success($this->categoryService->create(new CategoryCreateCommand($data->name))->toArray());
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * @Route("/api/categories/{id}", name="category_find", methods={"GET"})
     */
    public function find(int $id): Response
    {
        try {
            return $this->success($this->categoryService->find($id)->toArray());
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * @Route("/api/categories/{id}", name="category_update", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        try {
            $data = json_decode($request->getContent());
            return $this->success($this->categoryService->update(new CategoryUpdateCommand($id, $data->name))->toArray());
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * @Route("/api/categories/{id}", name="category_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        try {
            return $this->success($this->categoryService->delete($id));
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * @Route("/api/categories", name="category_list", methods={"GET"})
     */
    public function list(): Response
    {
        try {
            return $this->success($this->categoryService->list());
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }
}