<?php

namespace App\Service;

use App\Command\CategoryUpdateCommand;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Command\CategoryCreateCommand;

class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function create(CategoryCreateCommand $categoryCreateCommand): Category
    {
        return $this->categoryRepository->create($categoryCreateCommand->getName());
    }

    public function find(int $id): Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function update(CategoryUpdateCommand $categoryUpdateCommand): Category
    {
        return $this->categoryRepository->update($categoryUpdateCommand->getId(), $categoryUpdateCommand->getName());
    }

    public function delete(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    public function list(): array
    {
        return $this->categoryRepository->list();
    }

}